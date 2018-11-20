
<div class="row">
    <div class="col-xs-12" style="position:relative;margin:auto;margin-top:100px">
    Recherche rapide :<br>
    <form>
    <input type="text" id="search" placeholder="Recherche rapide" autofocus>
    </form>
    <center><h4 style="color:#decba4">Liste des élèves</h4></center>
        <?php
            if(!empty($res)){
        ?>
            <table class="table" style="width:650px;border:0.5px solid #decba4;background-color:#FFFFFF;border-radius:5px">
            <thead style="border-radius:5px;background-color:#333333;color:#FFFFFF">
                <tr style="border-radius:5px">
                <th style="width:250px">Nom</th>
                <th>Prénom</th>
                <th>Date de naissance</th>
                <th>Role</th>
                <th style="border-radius:5px">Photo</th>
                </tr>
            </thead>
            <tbody style="border-radius:5px">
        <?php
            for($i = 0;$i < count($res);$i++){
                ?>
                    <tr>
                    <td><?php echo $res[$i]['ln']; ?></td>
                    <td><?php echo $res[$i]['fn']; ?></td>
                    <td><?php 
                    $date = explode("-",$res[$i]['birth']);
                    echo "$date[2]-$date[1]-$date[0]"; ?></td>
                    <td><?php echo $res[$i]['name']; ?></td>
                    <td style="border-radius:5px"><?php echo $res[$i]['id']; ?></td>
                    </tr>
            <?php
            }?>
            </tbody>
            </table>
            <?php
        } else {
            echo "Vous n'avez pas encore passer de qcm!";
        }
        ?>
    </div>
</div>
<script>
$('#search').keyup(function(event){
    event.preventDefault();
    var lets = document.getElementsByTagName('tr');
    for(let j = 1; j < lets.length; j++)
    {
        content = lets[j].textContent.toLowerCase();
        val = document.getElementById('search').value;
        if(content.indexOf(val)>=0)
        {
            lets[j].style.display = "";
        }
        else{
            lets[j].style.display="none";
        }
    }
});
</script>