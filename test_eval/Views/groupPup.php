<?php
    if(!empty($res))
    {
?>
        Veulliez sélectionner les groupes auxquels affecter la personne sélectionnée :<br>
        <form method="POST">
            <?php
                for($i=0;$i<count($res);$i++)
                {
                    ?>
                        <input type="checkbox" name="grpTo[]" value="<?php echo $res[$i]['id'];?>" id="grpTo<?php echo $i; ?>"
                        >
                        <span id="<?php echo $i; ?>" onclick="check(this.id)" style="cursor:pointer"><?php echo $res[$i]['name'];?></span><br>
                    <?php
                }
            ?>
            <button type="submit" class="btn btn-secondary" name="grpPupTo" value="go">Affecter la personne à ces groupes</button>
        </form>
<?php
    } 
    else{
        echo "<h6>Aucun groupe disponible pour affectation, la personne est déjà inscrite dans tous les groupes possibles";
    }
?>
</body>
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