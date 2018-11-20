<?php
    function addStud($db,$query,$ln,$fn,$birth,$role)
    {
        $querySettings = 
        array(
            ":ln" => $ln,
            ":fn" => $fn,
            ":birth" => $birth,
            ":roleID" => $role
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
            $check = true;
        }catch(PDOException $ex){   
            die("Failed to run query: " . $ex->getMessage());
            $check = false;
        }
        return $check;  
    }

    function addRole($db,$query,$name)
    {

        $querySettings =
        array(
            ":nm" => $name
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
    function addGroup($db,$query,$name)
    {
        $querySettings =
        array(
            ":nm" => $name
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

    
    function linkPupToGroups($db,$query,$peep,$grp)
    {
        echo "$peep      dsqd    $grp";
        $query0 =
        "SELECT manager
        FROM APPARTIENT WHERE groupeID = :grp";
        $querySettings0 =
        array(
            ":grp" => $grp
        );
        try {
            $stmt = $db->prepare($query0);
            $stmt->execute($querySettings0);
        }catch(PDOException $ex){  
        }
        
        $res = $stmt -> fetchAll();
        var_dump($res);
        if(!empty($res) || $res === NULL)
        {
            $querySettings =
            array(
                ":peep" => $peep,
                ":grp" => $grp,
                ":persID" => $res[0]['manager']
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
        else {
            {
                unset($query);
                $query =
                "INSERT INTO APPARTIENT(id, personneID, groupeID, manager)
                VALUES(NULL, :peep, :grp,:persID)";

                linkPupToGroup($db,$query,$peep,$grp);
            }
        }
    }
    /** */ function linkPupToGroup($db,$query,$peep,$grp)
     {
         $querySettings =
         array(
             ":peep" => $peep,
             ":grp" => $grp,
             ":persID" => $peep
         );
 
         try {
             $stmt = $db->prepare($query);
             $stmt->execute($querySettings);
             $check = true;
         }catch(PDOException $ex){ 
             echo $ex;  
             $check = false;
         }
         return $check; 
     }
?>