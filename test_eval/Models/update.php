<?php
    function setManager($db,$query,$peep,$grp)
    {
        $querySettings =
        array(
            ":peep" => $peep,
            ":id" => $grp
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
            echo $ex;
        }
        return $check; 
    }

    function setGroupName($db,$query,$newName,$grp)
    {
        $querySettings =
        array(
            ":id" => $grp,
            ":nm" => $newName
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
        }
        return $check; 
    }

    function setLn($db,$query,$ln,$peep)
    {
        $querySettings =
        array(
            ":ln" => $ln,
            ":peep" => $peep
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
        }
        return $check; 
    }

    function setFn($db,$query,$fn,$peep)
    {
        $querySettings =
        array(
            ":fn" => $fn,
            ":peep" => $peep
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
        }
        return $check; 
    }

    function setRole($db,$query,$role,$peep)
    {
        $querySettings =
        array(
            ":newRole" => $role,
            ":peep" => $peep
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
        }
        return $check; 
    }
    
    function setRoleName($db,$query,$name,$id)
    {
        $querySettings = 
        array(
            ":name" => $name,
            ":id" => $id
        );
        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            $check = false;
        }
        return $check; 

    }
?>