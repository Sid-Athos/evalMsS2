<?php
    if(!empty($res))
    {
?>
<form method="POST">
    Sélectionnez une personne à rechercher : <br>
    <select name="peepToFetch">
        <?php
            for($i = 0;$i<count($res);$i++)
            {
        ?>
                <option value="<?php echo $res[$i]['id']; ?>">
                <?php echo $res[$i]['ln']." ".$res[$i]['fn']; ?>
                </option>
        <?php
            }
        ?>
    </select>
    <br>
    <button type="submit" class="btn btn-secondary" name="searchPeep" value="y">
        Afficher les informations
    </button>
</form>
<?php
    }
?>