        <form method="POST" id="post">
            Nom : <br>
            <input type="text" name="ln" placeholder="Le nom de l'élève" required minlegth="2" 
            title="Maximum 25 caractères, aucun caractère spécial autorisé" pattern="^[a-zA-Z-]+$"><br>
            Prénom : <br>
            <input type="text" name="fn" placeholder="Le prénom de l'élève" required minlegth="2" 
            title="Maximum 25 caractères, aucun caractère spécial autorisé" pattern="^[a-zA-Z-]+$"><br>
            Date de naissance : <br>
            <input type="date" style="width:175px" placeholder="JJ/MM/AAAA" id="datepicker" onclick="datepicker()" 
            required name="birth"/><br>
            <br>
            <h4>Rôle à affecter : </h4><br>
            <?php
            if(!empty($res))
            {
            ?>
            <select name="role" required style="width:300px">
            <?php
                    for($i = 0; $i < count($res);$i++)
                    {
                        ?>
                            <option value="<?php echo $res[$i]['id']?>">
                            <?php echo $res[$i]['name'];?>
                        </option>
                        <?php
                    }
                    ?>
            </select><br>
            <?php
            }
            ?>
            <button id="pic" class="btn btn-secondary" style="z-index:99" enctype="multipart/form-data">
                Sélectionner une photo de profil...
                </button>
                <input type = "FILE" id="file" style="border:none;opacity:0;position:absolute;z-index:1;left:0" 
                name ="img_up" onchange="readURL(this)">
                <input type="checkbox" name="add_pic" value="yes"> Ajouter une photo </input>
            <br>
                            <img id="blah" style="width:300px;height:300px;border-radius:50%;opacity: 0.75;filter: alpha(opacity=50)" 
                            alt="Preview">
                    </div>
                <br>
            
            <button type="submit" style="width:600px" name="newStud" class="btn btn-secondary" value="y">Enregistrer</button>
        </form>
    </div>
</div>
</body>
<script>
function readURL(input) {
    /* Là on regarde si il y a un fichier dans un input type file */
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            /* On récupère la preview une fois que c'est préupload mamène */
            $('#blah')
                .attr('src', e.target.result);
        };
        /* Le petit outil qui permet de lire l'image sans reload */
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script>
    $("#pic").click(function(event){
        event.preventDefault();
        $("#file").click();
    });
</script>
<script>
 /* Quite obvious, ma date de naissance n'est pas dans le futur */

    function datepicker() {
        
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        dd = checktime(dd);
        mm = checktime(mm);
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datepicker").setAttribute("max", today);
    }

    function checktime(i){
        if(i < 10) {
            i = "0" + i;
        }
        return i;
}
</script>