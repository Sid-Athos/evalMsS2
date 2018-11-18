
        <form method="POST" id="post"  enctype="multipart/form-data">
            <span style="color:#333333">
            <h4>
            Ici, vous pouvez modifiez vos informations personnelles
            </h4>
            </span>
            Nom: <br>
                <input  class="form-control" type="text" style="width:200px" 
                pattern="^[a-zA-Z-]+$"
                required minlenth="3"
                name="newLn" value="<?php echo $res[0]['ln'];?>">
            
                <input type="checkbox"name="mod_ps" value="yes"> Modifier lenom<br>
                
            
                Prénom : 
                <br>
                <input type="text"  class="form-control" style="width:200px" 
                pattern="^[a-zA-Z-]+$"
                required minlength="3"
                name="newFn" value="<?php echo $res[0]['fn'];?>">
            
                    <input type="checkbox" name="mod_mail" 
                    style="border-radius:3px;border:none" value="yes"> 
                    Modifier le prénom <br>
                
                <select name="newRole">
                    <option value="<?php echo $res[0]['roleID']; ?>">
                        <?php echo $res[0]['name']; ?>
                    </option>
                    <?php
                        for($i = 0;$i < count($res2);$i++)
                        {
                    ?>
                            <option value="<?php echo $res2[$i]['id']; ?>">
                            <?php echo $res2[$i]['name']; ?>
                    <?php
                        }
                    ?>
                </select>
            <br>
            <h4 style="color:#66666">
            Avatar
            
            </h4> 
            <br>
        
                <button id="pic" class="btn btn-secondary" style="z-index:99">
                Sélectionner une photo de profil...
                </button>
                <input type = "FILE" id="file" 
                style="border:none;opacity:0;position:absolute;z-index:1;left:0" 
                name ="img_up" onchange="readURL(this)">
                <input type="checkbox" name="add_pic" value="yes"> 
                Ajouter une photo <br>
             <?php
                if(!empty($res1))
                {?>
                    <br>
                    Veulliez choisir un groupe à quitter : <br>
                    <?php
                            for($i=0;$i<count($res1);$i++)
                            {
                        ?>
                                <input type="checkbox" name="ungrpTo[]" 
                                class="quit" value="<?php echo $res1[$i]['groupeID'];?>">
                                <?php echo $res1[$i]['GroupName'];?><br>
                                <?php
                            }
                            ?>
                            <input type="checkbox" name="quitAll" id="quit" 
                            onclick="quitAllGrp()" value="y">Quitter tous les groupes<br>
                            <?php
                }
            ?>
            <br>
                    
                            <img id="blah" 
                            style="width:100px;height:100px;border-radius:50%;
                            opacity: 0.75;filter: alpha(opacity=50)" alt="Preview">
                        
                    </div>
                <br>
                <input type="checkbox" name="quitGame"  value="y">
                <span style="color:#daa125;font-weight:700">Suppression du profil</span><br>
            <button type="submit" style="width:200px" 
            name="modAccount" class="btn btn-secondary" value="submit">Modifier</button>
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
        event.preventDefaul<center>
        $("#file").click();
    });
</script>
<script>
        function quitAllGrp()
        {
            var list = document.getElementsByClassName('quit');
            for(let i = 0;i < list.length; i++)
            {
                if(list[i].checked === true)
                {
                    list[i].checked = false;
                }
                else 
                {
                    list[i].checked = true
                }
            }
        }
</script>