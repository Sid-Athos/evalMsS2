<?php
    if(!empty($res)){
?>
        <form method="POST" style="text-align:center">
        Nom du groupe :<br>
        <input type="text" name="grpName" style="text-align:center" 
        value="<?php echo $res0[0]['name'];?>"
        minlength="3" pattern="^[a-zA-Z -]+$"
        required><br>
        <ul>
        <?php
            for($i = 0;$i< count($res);$i++)
            {
        ?>
                <li>
                    <span> <?php echo $res[$i]['ln']." ".$res[$i]['fn']; ?> </span>
                    Rôle : <?php echo $res[$i]['statut']; ?>
                    <input type="checkbox" name="unlinkToGrp[]" id="grpTo<?php echo $i; ?>"
                    value=
                    "<?php echo $res[$i]['personneID']; ?>"> 
                    <span id="<?php echo $i; ?>" onclick="check(this.id)" style="cursor:pointer">Supprimer du groupe</span>
                </li>
        <?php
            }
        ?>
            <br>
            <div class="custom-control custom-checkbox">
            <input type="checkbox" name="killGroup" value="yes">Supprimer le groupe<br>
            </div>
            <button type="submit" class="btn btn-secondary" name="rmvFromGrp">
                Modifier le groupe
            </button>
        <?php
    }
    else
    {
        echo "Ce groupe est vide, veuillez ajouter des personnes afin de pouvoir le modifier.";
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