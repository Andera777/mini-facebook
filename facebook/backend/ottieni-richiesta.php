<?php
// ottieni-richiesta.php

// Include il file di connessione al database
include '../commons/connection.php';

// Verifica se l'utente è loggato
session_start();
$emailUtenteLoggato = isset($_SESSION['utente']) ? $_SESSION['utente'] : null;

// Esempio di query per ottenere richieste di amicizia
$query = "SELECT DISTINCT * FROM richiestediamicizia WHERE destinatario = ? AND statoRichiesta = 'in attesa di accettazione'";
$stmt = $cid->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $emailUtenteLoggato);
    $stmt->execute();

    $result = $stmt->get_result();

    $richieste = [];

    while ($row = $result->fetch_assoc()) {
        $richieste[] = $row;
    }

    $stmt->close();

    // Restituisci i dati come JSON
    header('Content-Type: application/json');
    echo json_encode($richieste);
} else {
    // Errore nella preparazione della query
    die("Errore nella preparazione della query: " . $cid->error);
}

// Chiudi la connessione al database
$cid->close();
?>