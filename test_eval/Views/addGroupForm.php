<input type="text" name="groups" id="search">
<?php
    if(!empty($res))
    {
        ?>
        Liste des groupes existants : <br>
        <select id="lol">
        <?php
            for($i = 0;$i < count($res);$i++)
            {
                ?>
                    <option class="check"
                    value="<?php echo $res[$i]['id']; ?>" 
                    id="datas<?php echo $i;?>">
                    <?php echo $res[$i]['name']; ?></option>
                <?php
            }
            ?>
            </select>
         
            <?php
    } 
    else
    {
        echo "<center><h6>Aucun groupe existant, veuillez en créer un.</h6></center>";
    }
?>
<br>
<form method="POST">
    Nom du groupe : <br>
    <input type="text" name="gNem" placeholder="Nom du nouveau groupe"
    pattern="^[a-zA-Z ]+$"><br>
    <?php
    if(!empty($res0))
    {
        ?>
        <br>Sélectionnez un responsable : <br>
        <select name="manForG" required>
                <?php
                for($i = 0;$i < count($res0);$i++)
                {
                    ?>
                        <option value="<?php echo $res0[$i]['id']; ?>">
                        <?php echo $res0[$i]['ln']." ".$res0[$i]['fn']; ?>
                    </option>
                    <?php
                }
                ?>
                </select>
                <?php

    }
    ?>
    <br>
    <input type="submit" value="Ajouter le groupe">
</form>
<script>
    $('#search').keyup(function(event){
            var content = $('#search').val();
            var liste = document.querySelector("#lol");
            var options = liste.options;
            for (var i = 0; i < options.length; i++) {
                var option = options[i]; 
                optionText = option.innerText.toLowerCase();
                if (optionText.indexOf(content) === 0) {
                    option.selected = true;
                    return;
                }
        }
    });
</script>