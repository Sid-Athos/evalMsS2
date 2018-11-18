<?php
    if(!empty($res)){
?>
        <form method="POST" style="text-align:center">
            Veuilliez sélectionner un groupe à modifier : <br>
        <select name="chooseGroup">
        <?php
                for($i = 0;$i < count($res);$i++)
                {
            ?>
                    <option value="<?php echo $res[$i]['id']; ?>">
                    <?php echo $res[$i]['name']; ?>
                    </option>
            <?php
                }
            ?>
            </select>
            <br>
            <button type="submit" class="btn btn-secondary" 
            name="cG" value="go">
            Modifier ce groupe</button>
            </form>
            <?php
    }
    else
    {
        echo "<h4>Aucun groupe à afficher, veuillez en créer un auparavant!<h4>";
    }
?>