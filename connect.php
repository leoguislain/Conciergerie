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
?>