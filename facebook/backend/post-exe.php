<?php 
include_once("../commons/connection.php");
include_once("../commons/funzioni.php");
session_start();
$ris = inserisciPost($cid,$_SESSION['utente'],$_POST['testo'],$_POST['citta'],$_POST['prov'],$_POST['stato'], $_POST['tipo'], $_POST['nomeFile'], $_POST['percorsoFile']);
$msg = $ris['msg'];
if (($ris["status"]=='ok')) {
    $location="../frontend/home-page";
    header("location:$location.php?status=ok&!errore=".serialize($msg)); 
}
else{	        
    $_SESSION["status"] = "ko";
    $location="../frontend/home-page";
    header("location:$location.php?status=ko&errore=".serialize($msg)); 
}

?>