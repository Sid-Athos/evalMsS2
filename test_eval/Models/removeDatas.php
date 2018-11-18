<?php
    function rmvFromGrp($db,$query,$id,$peep)
    {
        $querySettings =
        array(
            ":peep" => $peep,
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
    function rmvFromGrps($db,$query,$peep)
    {
        $querySettings =
        array(
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

    function nothingRemains($db,$peep)
    {
        $query[0] =
        "DELETE
        FROM APPARTIENT
        WHERE personneID = :peep";

        $query[1] = 
        "DELETE
        FROM PERSONNES
        WHERE id = :peep";
        for($i = 0;$i < count($query);$i++)
        {
            try {
                $stmt = $db->prepare($query[$i]);
                $stmt->execute(array(":peep" => $peep));
                $check = true;
            }catch(PDOException $ex){   
                $check = false;
                echo $ex;
            }

        }
        return $check; 
    }
?>