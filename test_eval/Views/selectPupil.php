<?php
    if(!empty($res))
    {
?>
<form method="POST">
    <select name="pup">
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
    <button type="submit" class="btn btn-secondary" name="affect" value="y">
        Affecter à un ou plusieurs groupes
    </button>
</form>
<?php
    }
?>