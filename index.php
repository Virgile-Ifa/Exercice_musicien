<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<link rel="stylesheet" href="style/style.css">
<link rel="icon" type="image/png" href="./ico/music_ico.png" />
<title>Dropdown/groupe musique</title>
</head>
<body>
    <?php
        try{
            include('fonction/connection.php');
            $req = $bdd->query("SELECT * FROM groupe")

        
    ?>
    <div id="dropdownSelect">
        <div class="dropdown">
            <button  type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Selection groupe :
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <?php
                
                    while ($donnees = $req->fetch()){
                        $id = $donnees['id_groupe'];
                        echo "<a class='dropdown-item' href='index.php?groupe=".$id."'>Groupe ".$id."</a>";
                    }
                
                ?>
            </div>
        </div>
    </div>

    <div id="info_groupe">
        <?php
            if(isset($_GET['groupe'])){
                $id_groupe = ['id' => (int)$_GET['groupe']];
                $req = $bdd->prepare("SELECT * FROM groupe WHERE id_groupe=:id");
                $req->execute($id_groupe);
                while($donnees = $req->fetch()){
                    echo "
                        <div id='container'>
                            <h5>Nom du groupe</h5>
                            <p>".$donnees['nom_groupe']."</p>
                            <h5>Date de création</h5>
                            <p>".$donnees['date_creation']."</p>
                    ";
                    
                    $req = $bdd->prepare("SELECT * FROM musicien INNER JOIN groupe_musicien ON musicien.id_musicien = groupe_musicien.id_musicien WHERE id_groupe = :id");
                    $req->execute($id_groupe);
                    echo" <table>
                        <tr>
                            <th>Musicien</th>
                            
                        </tr>
                    ";
                    while ($donnees = $req->fetch()){
                        echo"
                            <tr>
                                <td>".$donnees['nom']."</td>
                            </tr>
                            
                        ";
                    }
                    echo"
                        </table>
                    ";
                }
            }
            
        ?> 
    </div>

    <?php
        }catch (Exception $e){
            echo "Error : "." ".$e->getMessage(); 
        }
    ?>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>