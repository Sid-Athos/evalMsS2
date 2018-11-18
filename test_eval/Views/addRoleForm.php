<br>
<h4>Liste des rôles existants : </h4><br>
<select style="width:300px">
    <?php
    if(!empty($res))
    {
        for($i = 0; $i < count($res);$i++)
        {
            ?>
                <option name="dshjqg" value="<?php echo $res[$i]['id'].'-'.$res[$i]['name'];?>">
                <?php echo $res[$i]['name'];?>
            </option>
            <?php
        }
    }
    ?>
</select>
<form method="POST">
    Veuillez saisir le nouveau rôle à ajouter : <br>
    <input type="text" name="roleName" placeholder="Nom du rôle"
    pattern="^[a-zA-Z]+$"><br>
    <button class="btn btn-secondary" type="submit" name ="newRole" value="y">Ajouter un rôle</button><br>
</form>

    