<?php require_once("../commons/funzioni.php")?>

<div id="postModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                Update Status
            </div>
            <form class="form center-block" method="POST" action="../backend/post-exe.php">
                <div class="modal-body">
                    <div class="form-group">
                        <textarea class="form-control input-lg" autofocus="" placeholder="What do you want to share?" name="testo"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <input class="btn btn-primary btn-sm" type="submit" value="POST">
                        <ul class="pull-left list-inline">
                            <li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li>
                            <li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li>
                            <li><a href="#cittaModal" data-toggle="modal"><i class='glyphicon glyphicon-map-marker'></i></a></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal per l'inserimento della localizzazione -->
<div id="cittaModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">	
		<form class="form center-block" method = "POST">		  
				<div class="modal-body">
				    <div class="form-group text-center" style="padding: 10px;">
                        <label for="nomecitta">Seleziona una città</label>
                        <div class="row">
                        	<div class="col-md-4">
                            	<input type="text" class="form-control" id="citta" placeholder="Città" name="citta">
                            </div>
                        	<div class="col-md-4">
                	            <input type="text" class="form-control" id="prov" placeholder="Provincia" name="prov">
                            </div>
                          	<div class="col-md-4">
                                <input type="text" class="form-control" id="stato" placeholder="Stato" name="stato">
                            </div>
                        </div>
										
                    </div>
				</div>
				<div class = "modal-footer">
					<div class = "col-sm-2 col-sm-offset-5">
						<button class="btn btn-primary btn-sm" type="submit" id = "inviaCitta" name = "invia">SELEZIONA</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>

<script type="text/javascript" src="../assets/js/jquery.js"></script>
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('[data-toggle=offcanvas]').click(function () {
            $(this).toggleClass('visible-xs text-center');
            $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
            $('.row-offcanvas').toggleClass('active');
            $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
            $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
            $('#btnShow').toggle();
        });

        $('[data-target="#cittaModal"]').click(function () {
            $.ajax({
                url: '../commons/cittamodal.php',
                type: 'GET',
                success: function (data) {
                    $('#cittaModal').html(data);
                    $('#cittaModal').modal('show');
                },
                error: function () {
                    alert('Errore durante il recupero del contenuto della modale della città.');
                }
            });
        });


    // Variabili per memorizzare i valori della città, provincia e stato
    var savedCitta = "";
    var savedProv = "";
    var savedStato = "";

    // Gestisci l'invio della modalità città
    $('#inviaCitta').click(function (e) {
        e.preventDefault();

        var citta = $('#citta').val();
        var prov = $('#prov').val();
        var stato = $('#stato').val();

        // Salva i valori della città, provincia e stato
        savedCitta = citta;
        savedProv = prov;
        savedStato = stato;

        // Chiudi la modalità città
        $('#cittaModal').modal('hide');

        // Puoi anche pulire i campi del modulo città se necessario
        $('#citta').val('');
        $('#prov').val('');
        $('#stato').val('');



        // Continua a mostrare la modalità post
        $('#postModal').modal('show');
    });

    // Quando si apre la modalità città, popola i campi con i valori salvati
    $('#cittaModal').on('show.bs.modal', function () {
        $('#citta').val(savedCitta);
        $('#prov').val(savedProv);
        $('#stato').val(savedStato);
    });

    // Funzione per cambiare il colore del marker
    function changeMarkerColor(citta, prov, stato) {
        var markerIcon = $('.glyphicon-map-marker');
        if (citta) {
            markerIcon.css('color', 'green');
        } else {
            markerIcon.css('color', ''); // Reimposta il colore predefinito o rimuovi l'attributo 'style'
        }
    }
});
</script>
</script>
