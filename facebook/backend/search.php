<?php
include '../commons/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchTerm = $_GET["srch-term"];
    $logged_user = $_SESSION["utente"];
    
    // stringa vuota
    if (!empty($searchTerm)) {
        // ricerca email
        $emailSearchQuery = "SELECT DISTINCT email, nome, cognome FROM utente WHERE email != ? AND email LIKE ?";
        $stmtEmailSearch = $cid->prepare($emailSearchQuery);
        $stmtEmailSearch->bind_param("ss", $logged_user, $searchTerm);
        $stmtEmailSearch->execute();
        $emailResult = $stmtEmailSearch->get_result();

        // ricerca nome e cognome
        $nameSearchQuery = "SELECT DISTINCT email, nome, cognome FROM utente WHERE CONCAT(nome, ' ',cognome) LIKE ? AND email != ?";
        $stmtNameSearch = $cid->prepare($nameSearchQuery);
        $searchTermWithWildcard = "%" . $searchTerm . "%";
        $stmtNameSearch->bind_param("ss", $searchTermWithWildcard, $logged_user);
        $stmtNameSearch->execute();
        $nameResult = $stmtNameSearch->get_result();

        $results = [];

        while ($row = $emailResult->fetch_assoc()) {
            $results[] = $row;
        }

        while ($row = $nameResult->fetch_assoc()) {
            $results[] = $row;
        }
    } else {
        // caso stringa vuota
        $results = [];
    }

    // Encode the results as JSON and echo
    echo json_encode($results);
}
?>
