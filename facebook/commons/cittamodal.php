<div id="cittaModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">			  
			<div class="modal-body">
				<form class="form center-block" method = "POST">
				    <div class="form-group" style="padding: 10px;">
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
						<div class = "modal-footer">
							<input class="btn btn-primary btn-sm" type="submit" id = "inviaCitta" value="SELEZIONA">
						</div>						
                    </div>
				</form>
			</div>
		</div>
	</div>
</div>
        
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle=offcanvas]').click(function() {
            $(this).toggleClass('visible-xs text-center');
            $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
            $('.row-offcanvas').toggleClass('active');
            $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
            $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
            $('#btnShow').toggle();
        });

        // Gestisci il clic sul pulsante di invio del modulo della città
        $('#inviaCitta').click(function() {
            // Recupera i dati dal modulo
            var citta = $('#citta').val();
            var prov = $('#prov').val();
            var stato = $('#stato').val();

            // Effettua una richiesta AJAX per inviare i dati a post-exe.php
            $.ajax({
                url: '../backend/post-exe.php', 
                type: 'POST',
                data: {
                    citta: citta,
                    prov: prov,
                    stato: stato
                },
                success: function(response) {
                    // Gestisci la risposta dal server se necessario
                    console.log(response);
                    // Chiudi la modale della città
                    $('#cittaModal').modal('hide');
                },
                error: function() {
                    // Gestisci gli errori della richiesta AJAX
                    alert('Errore durante l\'invio dei dati del modulo.');
                }
            });
        });
    });
</script>