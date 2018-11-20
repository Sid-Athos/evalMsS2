<?php
    include('Models/dbConnect.php');
    require_once('Models/getDatas.php');
    require_once('Models/addDatas.php');
    require_once('Models/update.php');
    require_once('Models/removeDatas.php');
    $actualDate = actualDate($db);
    include('Views/menu.html');
    echo $actualDate;

    switch(isset($_POST)):
        case(isset($_POST['choice'])):
                switch($_POST['choice']):
                    case 'addStud':
                            $res = getRoles($db);
                            include('Views/addStudForm.php');
                        break;
                    case 'addRole':
                            $res = getRoles($db);
                            include('Views/addRoleForm.php');
                        break;
                    case 'roleMod':
                            $res = getRoles($db);
                            include('Views/roleMod.php');
                        break; 
                    case 'addGroup':
                            $res = getGroups($db);
                            $res0 = getPupils($db);
                            include('Views/addGroupForm.php');
                        break;
                    case 'linkS':
                            $res = getPupils($db);
                            include('Views/selectPupil.php');
                        break;
                    case 'LinkR':
                            $res = getPupils($db);
                            $res0 = getGroups($db);
                            include('Views/promote.php');
                        break;
                    case 'groupMod';
                            $res = getGroups($db);
                            include('Views/selectGroupForm.php');
                        break;
                    case 'studmod':
                            $res = getPupils($db);
                            include('Views/selectPupilToMod.php');
                        break;
                    case 'showS':
                            $res = getPersInfos($db);
                            include('Views/showPerson.php');
                        break;
                    default:
                endswitch;
            break;
        case(isset($_POST['ln'])):
                $pattern = "/^[a-zA-Z-]+$/";
                if(preg_match($pattern,$_POST['ln']) && preg_match($pattern,$_POST['fn']))
                {
                    $ln = $_POST['ln'];
                    $fn = $_POST['fn'];
                    $birth = $_POST['birth'];
                    $role = intval($_POST['role']);
                    $check = fetchStud($db,$ln,$fn,$birth);
                    if(empty($check))
                    {   
                        unset($check);
                        $query = 
                        "INSERT INTO PERSONNES(id, ln, fn, birth, roleID)
                        VALUES(NULL, :ln, :fn, :birth, :roleID)";
                        $check = addStud($db,$query,$ln,$fn,$birth,$role);
                        echo "<h1>Personne enregistrée</h1>";
                    } else {
                        echo "<h1>La personne est déjà enregistrée!</h1>";
                    }
                }
            break;
        case(isset($_POST['roleName'])):
                if(preg_match("/^[a-zA-Z]+$/",$_POST['roleName']))
                {
                    $name = $_POST['roleName'];
                    $query =
                    "INSERT INTO ROLES(id, name)
                    VALUES(NULL, :nm)";
                    $check = addRole($db,$query,$name);
                    if($check === false)
                    {
                        echo "<br><h4>Le rôle existe déjà</h4>";
                    }
                    else 
                    {
                        echo "<br><h4>Rôle ajouté</h4>";
                    }
                }
            break;
        case(isset($_POST['gNem'])):
                if(preg_match("/^[a-zA-Z ]+$/",$_POST['gNem']))
                {
                    $name = $_POST['gNem'];
                    $query = 
                    "INSERT INTO GROUPES(id, name) VALUES(NULL,:nm)";
                    $check = addGroup($db,$query,$name);
                    $id = $db->lastInsertId();
                    $grp = $id; unset($id);
                    $peep = $_POST['manForG'];
                    $query =
                    "INSERT INTO APPARTIENT(id, personneID, groupeID, manager)
                    VALUES(NULL, :peep, :grp,:persID)";
                    echo "dhusjqgdhjsqdgfsqh";
                    linkPupToGroup($db,$query,$peep,$grp);

                    if($check === false)
                    {
                        echo "<br><h4>Le groupe existe déjà</h4>";
                    }
                    else 
                    {
                        echo "<br><h4>Groupe et responsable ajouté</h4>";
                    }
                }
            break;
        case(isset($_POST['affect'])):
                $peep = htmlspecialchars($_POST['pup']);
                $_SESSION['peep'] = $peep;
                $query = 
                "SELECT * 
                FROM GROUPES 
                WHERE id != ALL(
                    SELECT groupeID 
                    FROM APPARTIENT 
                    WHERE personneID = :id
                    )";

                $res = fetchUnlinkedGroups($db,$query,$peep);
                include('Views/groupPup.php');
            break;
        case(isset($_POST['grpPupTo'])):
                    if(isset($_SESSION['peep']) && isset($_POST['grpTo']))
                    {
                        $peep = $_SESSION['peep'];
                        unset($_SESSION['peep']);
                        $query = 
                        "INSERT INTO APPARTIENT(id, personneID, groupeID, manager)
                        VALUES(NULL,:peep,:grp,:persID)";

                        for($i = 0; $i < count($_POST['grpTo']);$i++)
                        {
                            $grp = $_POST['grpTo'][$i];
                            $check = linkPupToGroups($db,$query,$peep,$grp);
                        }
                        if($check === true)
                        {
                            echo "<br>GG";
                        }
                        else
                        {
                            echo "<br>Pas GG";
                        }
                    }
            break;
        case(isset($_POST['promote'])):
                    $peep = $_POST['pupToP'];
                    $grp = $_POST['groupGetM'];
                    $query =
                    "SELECT * 
                    FROM APPARTIENT 
                    WHERE personneID = :id
                    AND groupeID = :grp";
                    $res = selectGroupMember($db,$query,$peep,$grp);
                    if(empty($res))
                    {
                        $query =
                        "INSERT INTO APPARTIENT(id, personneID, groupeID, manager)
                        VALUES(NULL,:peep,:grp,:persID)";
                        $check = linkPupToGroup($db,$query,$peep,$grp);
                        unset($query);
                        $query =
                        "UPDATE APPARTIENT
                        SET manager = :peep
                        WHERE groupeID = :id";

                        $check = setManager($db,$query,$peep,$grp);
                        echo "<br><h1>GG</h1>";
                    } else{
                        $query =
                        "UPDATE APPARTIENT
                        SET manager = :peep
                        WHERE groupeID = :id";

                        $check = setManager($db,$query,$peep,$grp);
                        echo "<br><h1>GG</h1>";
                    }
                break;
            case(isset($_POST['chooseGroup'])):
                    $grp = $_POST['chooseGroup'];
                    $query = 
                    "SELECT name
                    FROM GROUPES
                    WHERE id = :id";

                    $res0 = fetchName($db,$query,$grp);

                    $query = 
                    "SELECT GROUPES.name as GroupeName, groupeID, manager, personneID, ln, fn, ROLES.name AS statut
                    FROM GROUPES 
                    JOIN APPARTIENT 
                    ON APPARTIENT.groupeID = GROUPES.id 
                    JOIN PERSONNES ON APPARTIENT.personneID = PERSONNES.id 
                    JOIN ROLES ON PERSONNES.roleID = ROLES.id
                    WHERE groupeID = :id";

                    $res = fetchGroupInfos($db,$query,$grp);
                    include('Views/manageGroup.php');
                    $_SESSION['grp'] = $grp;

                break;
            case(isset($_POST['rmvFromGrp'])):
                    $grp = $_SESSION['grp'];
                    $newName = htmlspecialchars($_POST['grpName']);
                    if(preg_match("/^[a-zA-Z -]+$/",$newName))
                    {
                        $query =
                        "UPDATE GROUPES
                        SET name = :nm
                        WHERE id = :id";
                        setGroupName($db,$query,$newName,$grp);
                        unset($query);
                    }
                    $query = 
                    "DELETE 
                    FROM APPARTIENT
                    WHERE groupeID = :id
                    AND personneID = :peep";
                    if(isset($_POST['unlinkToGrp']))
                    {
                        for($i = 0;$i < count($_POST['unlinkToGrp']);$i++)
                        {
                            $peep = $_POST['unlinkToGrp'][$i];
                            $check = rmvFromGrp($db,$query,$grp,$peep);
                        }
                        unset($query,$_SESSION['grp']);
                    }
                    if(isset($_POST['killGroup']))
                    {
                        unset($query);
                        $query[0] =
                        "DELETE
                        FROM APPARTIENT
                        WHERE groupeID = :id";

                        $query[1] = 
                        "DELETE
                        FROM GROUPES
                        WHERE id = :id";
                        for($i = 0;$i < count($query);$i++)
                        {
                            $check = killGroup($db,$query[$i],$grp);
                        }
                        echo "GG";
                    }
                    foreach($_SESSION as $key => $value)
                    {
                        unset($_SESSION[$key]);
                    }
                break;
            case(isset($_POST['searchPeep'])):
                    $peep = $_POST['peepToFetch'];
                    $_SESSION['peep'] = $peep;

                    $query[0] = 
                    "SELECT *
                    FROM PERSONNES
                    JOIN ROLES ON ROLES.id = PERSONNES.roleID
                    WHERE PERSONNES.id = :id";
                    
                    $query[1] =
                    "SELECT GROUPES.name as GroupName, groupeID
                    FROM GROUPES 
                    JOIN APPARTIENT 
                    ON APPARTIENT.groupeID = GROUPES.id 
                    WHERE personneID = :id";

                    $query[2] = 
                    "SELECT *
                    FROM ROLES
                    WHERE id != ANY(
                        SELECT roleID
                        FROM PERSONNES
                        WHERE id = :peep)";


                    $res = fetchPersonInfos($db,$query[0],$peep);
                    $res1 = fetchPersonGroups($db,$query[1],$peep);
                    $res2 = fetchUnassignedRoles($db,$query[2],$peep);
                    unset($query);

                    include('Views/modPerson.php');
                break;
            case(isset($_POST['modAccount'])):
                    $peep = $_SESSION['peep'];
                    $role = $_POST['newRole'];
                    $query = 
                    "UPDATE PERSONNES
                    SET roleID = :newRole
                    WHERE id = :peep";

                    $res = setRole($db,$query,$role,$peep);
                    if(isset($_POST['mod_ps']))
                    {
                        $ln = $_POST['newLn'];
                        $query =
                        "UPDATE PERSONNES
                        SET ln = :ln
                        WHERE id = :peep";

                        $res = setLn($db,$query,$ln,$peep);
                    }
                    if(isset($_POST['mod_mail']))
                    {
                        $fn = $_POST['newFn'];
                        $query =
                        "UPDATE PERSONNES
                        SET fn = :fn
                        WHERE id = :peep";
                        $res = setFn($db,$query,$fn,$peep);
                    }
                    
                    if(isset($_POST['quitAll']))
                    {
                        unset($_POST['ungrpTo']);
                        $query =
                        "DELETE
                        FROM APPARTIENT 
                        WHERE personneID = :peep";

                        $res = rmvFromGrps($db,$query,$peep);
                    }
                    if(isset($_POST['ungrpTo']))
                    {
                        $id = implode(",",$_POST['ungrpTo']);
                        if(preg_match("/^[0-9\,]+$/",$id)){
                            /** Je n'ai trouvé aucun autre moyen de faire
                             *  fonctionner le IN. Désolé pour la 
                             *  concaténation
                             */
                            $query = 
                            "DELETE
                            FROM APPARTIENT 
                            WHERE personneID = :peep
                            AND groupeID IN($id)";

                            $res = rmvFromGrps($db,$query,$peep);
                        }
                    }
                    if(isset($_POST['quitGame']))
                    {
                        nothingRemains($db,$peep);
                        echo "Profil Supprimé avec succès";
                    }
                break;
            case(isset($_POST['mR'])):
                    $query = 
                    "UPDATE ROLES
                    SET name = :name
                    WHERE id = :id";

                    for($i = 0; $i < count($_POST['role']);$i++)
                    {
                        $id = $_POST['role'][$i];
                        $name = htmlspecialchars($_POST['setRoNa'][$i]);
                        $pattern = "/^[a-zA-Z-]+$/";
                        if(preg_match($pattern,$name))
                        {

                            $check = setRoleName($db,$query,$name,$id);
                            echo "GG set";
                        }
                        if(isset($_POST['killR'][$i]))
                        {
                            unset($query,$id);
                            $id = $_POST['killR'][$i];
                            $query = 
                            "DELETE 
                            FROM ROLES 
                            WHERE id != ALL(SELECT roleID FROM PERSONNES)
                            AND id = :id";

                            $check = killGroup($db,$query,$id);
                        }
                    }

                break;
        default:
    endswitch;
?>

