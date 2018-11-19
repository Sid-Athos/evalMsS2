<center>Recherche rapide : <br>
<input type="text" id="search" placeholder="Nom du groupe..."></center>

<?php
    if(!empty($res)){
?>
        <form method="POST" style="text-align:center">
            Veuilliez sélectionner un groupe à modifier : <br>
        <select name="chooseGroup" id="lol">
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
Recherche rapide : <br>
<input type="text" id="search" placeholder="Nom du groupe...">
<script>
    // Best JS user in S2 
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