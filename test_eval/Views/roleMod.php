
<?php
    if(!empty($res)){
?>
        <form method="POST" style="text-align:center">
            Ici vous pouvez modifier les rôles, seuls les rôles non affectés seront supprimés: <br>
        <?php
                for($i = 0;$i < count($res);$i++)
                {
            ?>
                    <input type="text" readonly name="role[]" value="<?php echo $res[$i]['id']; ?>" 
                    style="width:40px">
                    <input type="text" name="setRoNa[]" min-length="5"
                    title="Taille minimale, 5  caractères. Aucun caractère spécial autorisé" value="<?php echo $res[$i]['name']; ?>">
                    <input type="checkbox" name="killR[]" value="<?php echo $res[$i]['id']; ?>"
                    id="grpTo<?php echo $i; ?>">
                    <span id="<?php echo $i; ?>" onclick="check(this.id)" style="cursor:pointer">
                    Supprimer le role</span><br>
            <?php
                }
            ?>
            <br>
            <button type="submit" class="btn btn-secondary" 
            name="mR" value="go">
            Modifier ce rôle</button>
            </form>
            <?php
    }
    else
    {
        echo "<h4>Aucun rôleà afficher, veuillez en créer un auparavant!<h4>";
    }
?>
<script>
    function check(id){
        var id = document.getElementById("grpTo" + id);
        if(id.checked === false)
        {
            id.checked = true;
        } 
        else 
        {
            id.checked = false;
        }
    }
</script>