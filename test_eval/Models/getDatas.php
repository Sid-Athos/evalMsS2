<?php
    /* Juste pour le fun */
    function actualDate($db)
    {
        $query = 
            "SELECT 
            DAYNAME(CURRENT_TIMESTAMP()), 
            DAY(CURRENT_TIMESTAMP()), 
            MONTHNAME(CURRENT_TIMESTAMP()), 
            YEAR(CURRENT_TIMESTAMP())";

            try {
                $stmt = $db->prepare($query);
                $stmt->execute(Null);
            }catch(PDOException $ex){   
                die("Failed to run query: " . $ex->getMessage());
            }

            $row = $stmt -> fetchAll();
            /* Pregu REPLACUUUUUUUUUUUUUUUUUUUU */
            function pregu_replacu_date_frog_sama_way($row)
            {
                $pattern = array(array("/^l/","/^j/","/^f/","/^m/","/^a/","/^s/","/^o/","/^n/","/^d/","/^v/"),array("L","J","F","M","A","S","O","N","D","V"));
                $row[0]['MONTHNAME(CURRENT_TIMESTAMP())'] = preg_replace($pattern[0],$pattern[1],$row[0]['MONTHNAME(CURRENT_TIMESTAMP())']);
                $row[0]['DAYNAME(CURRENT_TIMESTAMP())'] =  preg_replace($pattern[0], $pattern[1], $row[0]['DAYNAME(CURRENT_TIMESTAMP())']); 
                return $row;
            }
            $row = pregu_replacu_date_frog_sama_way($row);
            $actual_date = implode(" ",$row[0]);
            unset($row,$pattern,$stmt,$db);
            return $actual_date;
    }

    function fetchStud($db,$ln,$fn,$birth)
    {
        $query =
        "SELECT CURRENT_TIMESTAMP()
        FROM PERSONNES
        WHERE ln LIKE :ln
        AND fn LIKE :fn";

        $querySettings = 
        array(
            ":ln" => $ln,
            ":fn" => $fn
        );

        try {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }catch(PDOException $ex){   
            die("Failed to run query: " . $ex->getMessage());
        }

        $res = $stmt -> fetchAll();
        return $res;
    }
    function getRoles($db)
    {
        $query =
        "SELECT *
        FROM ROLES
        ORDER BY name = 'Pupil' DESC";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
        }catch(PDOException $ex){   
            die("Failed to run query: " . $ex->getMessage());
        }

        $res = $stmt -> fetchAll();
        return $res;
    }
    function getGroups($db)
    {
        $query =
        "SELECT *
        FROM GROUPES";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
        }catch(PDOException $ex){   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }
    function getPupils($db)
    {
        $query =
        "SELECT *
        FROM PERSONNES";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute(NULL);
        }catch(PDOException $ex){   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }

    function fetchUnlinkedGroups($db,$query,$peep)
    {
        $querySettings =
        array(
            ":id" => $peep
        );

        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }

    function selectGroupMember($db,$query,$peep)
    {
        $querySettings =
        array(
            ":id" => $peep,
            ":grp" => $peep
        );
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }

    function fetchGroupInfos($db,$query,$grp)
    {
        $querySettings =
        array(
            ":id" => $grp
        );
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }

    function fetchPersonInfos($db,$query,$peep)
    {
        $querySettings =
        array(
            ":id" => $peep
        );
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }
    function fetchPersonGroups($db,$query,$peep)
    {
        $querySettings =
        array(
            ":id" => $peep
        );
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }

    function fetchUnassignedRoles($db,$query,$peep)
    {
        $querySettings =
        array(
            ":peep" => $peep
        );
        
        try 
        {
            $stmt = $db->prepare($query);
            $stmt->execute($querySettings);
        }
        catch(PDOException $ex)
        {   
            die("Failed to run query: " . $ex->getMessage());
        }
        $res = $stmt -> fetchAll();
        return $res;
    }
?>