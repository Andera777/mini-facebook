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
                            <ul class="list-group" id="lista-amici">
                                <li class="list-group-item title">
                                    Amici
                                </li>
                                <!-- Lista dinamica delle richieste di amicizia sarà caricata qui -->
                            </ul>
					    
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
			
			var emailUtenteLoggato = "<?php echo $emailUtenteLoggato; ?>";
            
			$.ajax({
                type: 'GET',
                url: '/facebook/backend/ottieni-amici.php',
                success: function (data) {
                    // Manipola i dati ottenuti dalla chiamata AJAX e visualizzali nella pagina
                    if (data.length > 0) {
                        var richiesteHtml = '';
                        for (var i = 0; i < data.length; i++) {
                            richiesteHtml += '<li class="list-group-item text-left">';
							if (data[i].mittente == emailUtenteLoggato) {
								richiesteHtml += '<label>' + data[i].destinatario + '<br></label>';
							} else {
								richiesteHtml += '<label>' + data[i].mittente + '<br></label>';
							}
                            richiesteHtml += '<label class="pull-right">';
							richiesteHtml += '</label>';
                            richiesteHtml += '<div class="break"></div>';
                            richiesteHtml += '</li>';
                        }

                        // Aggiungi gli elementi alla lista delle richieste di amicizia
                        $('#lista-amici').html(richiesteHtml);
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