<?php 
session_start();
function connect(){
    try {
        $db = new PDO('mysql:host=localhost;dbname=conciergerie', 'root');
        return $db;
        }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function login(){
    $findUser = connect()->prepare('SELECT * FROM `login` WHERE `name` = :login_user');
    $findUser->bindParam(':login_user', $_POST['username'], PDO::PARAM_STR);
    $findUser->execute();
    $user = $findUser->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['nom_user'] = $user['name'];
        header('Location: ./index.php');  
        
    } else {
        echo 'Invalid username or password';
    }
}

if(isset($_POST['action']) && !empty($_POST['username'])  && !empty($_POST['password'])  && $_POST['action']=="login"){
    login();
}



$findEtage = connect()->prepare('SELECT `etage` FROM `agenda` ORDER BY `date`');
$findEtage->execute();
$etage = $findEtage->fetchAll();

$findTask = connect()->prepare('SELECT `task_name` FROM `agenda` ORDER BY `date`');
$findTask->execute();
$task = $findTask->fetchAll();

$findDate = connect()->prepare('SELECT `date` FROM `agenda` ORDER BY `date`');
$findDate->execute();
$date = $findDate->fetchAll();


?>