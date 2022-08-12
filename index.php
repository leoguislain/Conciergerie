<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conciergerie</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Conciergerie</h1>
    <a href="./logout.php" class="logout">Se déconnecter</a>
    <section class="addtask">
        <h2>Ajouter une tache</h2>
        <form action="" method="get">
            <input type="text" name="task" class="task" placeholder="Ecrivez une tache" required>
            <input type="date" name="date" required>
            <input type="number" name="etage" class="etages" placeholder="Etage" min="-2" max="7" required>
            <input type="submit" name="send" class="send">
        </form>
    </section>
<?php
    include 'connect.php';
    if(isset($_GET['send']) & isset($_GET['task']) & !empty($_GET['task']) & isset($_GET['date']) & !empty($_GET['date']) & isset($_GET['etage']) & !empty($_GET['etage'])) {
        echo 'C bon';
            $findUser = connect()->prepare('INSERT INTO `agenda` (`task_name`, `date`, `etage`) VALUES (:task_name, :date, :etage)');
            $findUser->bindParam(':task_name', $_GET['task'], PDO::PARAM_STR);
            $findUser->bindParam(':date', $_GET['date'], PDO::PARAM_STR);
            $findUser->bindParam(':etage', $_GET['etage'], PDO::PARAM_INT);
            $findUser->execute();
            $user = $findUser->fetch();
            // header('Location: ./index.php');
    }
    else {
        echo 'c pas bon';
    }
?>
    <section class="contenantagenda">
        <h2>AGENDA</h2>
        <div class="agenda">
            <div class="etage">
                <p>
                    ETAGE<br>
                </p>
                    <?php
                        for ($i=0; $i < count($etage); $i++) {
                            $index = strval($i);
                            echo '<p>'.$etage[$index]['etage'].'</p><br>';
                        }
                    ?>
            </div>
            <div class="tache">
                <p>
                    TACHE<br>
                </p>
                <?php
                        for ($i=0; $i < count($task); $i++) {
                            $index = strval($i);
                            echo '<p>'.$task[$index]['task_name'].'</p><br>';
                        }
                    ?>
            </div>
            <div class="date">
                <p>
                    DATE<br>
                </p>
                <?php
                        for ($i=0; $i < count($date); $i++) {
                            $index = strval($i);
                            echo '<p>'.date('d/m/Y',strtotime($date[$index]['date'])).'</p><br>';
                        }
                    ?>
            </div>
            <div class="suppr">
                <p>SUPPR</p>
            </div>
        </div>
    </section>
<?php 
    if(!isset($_SESSION['nom_user'])){
        header('Location: ./login.php');
    }
?>
</body>

</html>