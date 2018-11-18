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

    function linkPupToGroup($db,$query,$peep,$grp)
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
            $check = false;
        }
        return $check; 
    }
?>