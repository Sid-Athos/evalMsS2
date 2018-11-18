<?php
    if(!empty($res) && !empty($res0))
    {
?>
        <form method="POST">
        <select name="pupToP">
            <?php
                for($i = 0;$i < count($res);$i++)
                {
            ?>
                    <option value="<?php echo $res[$i]['id']; ?>">
                    <?php echo $res[$i]['ln']." ".$res[$i]['fn']; ?>
                    </option>
            <?php
                }
            ?>
        </select>

        <select name="groupGetM">
        <?php
                for($i = 0;$i < count($res0);$i++)
                {
            ?>
                    <option value="<?php echo $res0[$i]['id']; ?>">
                    <?php echo $res0[$i]['name']; ?>
                    </option>
            <?php
                }
            ?>
        </select>
        <button type="submit" class="btn btn-secondary" name="promote" value="y">
        Donner le statut de responsable
        </button>
        </form>
<?php
    }
?>