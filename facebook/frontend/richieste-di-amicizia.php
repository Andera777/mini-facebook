<!-- quessta funzione ottiene l'email dell'utente loggato -->
<?php
session_start();
$emailUtenteLoggato = isset($_SESSION['utente']) ? $_SESSION['utente'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<?php include '../commons/header.php'; ?>
<?php include '../assets/js/richiesta-amicizia.js'; ?>


<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                <!-- main right col -->
                <div class="column col-sm-12" id="main">
                    <!-- top nav -->
                    <?php include '../commons/navbar.php'; ?>
                    <!-- /top nav -->

                    <div class="padding">
                        <div class="jumbotron list-content">
                            <ul class="list-group" id="lista-richieste-amicizia">
                                <li class="list-group-item title">
                                    Richieste d'amicizia in sospeso
                                </li>
                                <!-- Lista dinamica delle richieste di amicizia sarà caricata qui -->
                            </ul>
					    <div id="messaggioRichiestaAccettata" style="display: none;" class="alert alert-success">
												Richiesta accettata con successo!
						</div>
						<div id="messaggioRichiestaRifiutata" style="display: none;" class="alert alert-success">
												Richiesta rifutata con successo!
						</div>
                        </div>
                    </div><!-- /padding -->
                </div>
                <!-- /main -->
            </div>
        </div>
    </div>

    <!--post modal-->
    <?php include '../commons/postmodal.php'; ?>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Chiamata AJAX per ottenere le richieste di amicizia
            $.ajax({
                type: 'GET',
                url: '/facebook/backend/ottieni-richiesta.php',
                success: function (data) {
                    // Manipola i dati ottenuti dalla chiamata AJAX e visualizzali nella pagina
                    if (data.length > 0) {
                        var richiesteHtml = '';
                        for (var i = 0; i < data.length; i++) {
                            richiesteHtml += '<li class="list-group-item text-left">';
                            richiesteHtml += '<label>' + data[i].mittente + '<br></label>';
                            richiesteHtml += '<label class="pull-right">';
                            richiesteHtml += '<a class="btn btn-primary" onclick="accettaRichiesta(\'' + data[i].mittente + '\')" href="#" title="Accetta">Accetta</a>';
                            richiesteHtml += '<a class="btn btn-primary" onclick="rifiutaRichiesta(\'' + data[i].mittente + '\')"href="#" title="Rifiuta">Rifiuta</a>';
                            richiesteHtml += '</label>';
                            richiesteHtml += '<div class="break"></div>';
                            richiesteHtml += '</li>';
                        }

                        // Aggiungi gli elementi alla lista delle richieste di amicizia
                        $('#lista-richieste-amicizia').html(richiesteHtml);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Errore durante la chiamata AJAX:', status, error);
                }
            });
        });
    </script>
</body>

</html>