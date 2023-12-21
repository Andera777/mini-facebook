<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!--funzione java per richiamare il backend richiesta amicizia e blocca utente-->
	<script>
        // Usa la variabile emailUtenteLoggato nel tuo codice JavaScript
        var mittente= "<?php echo $emailUtenteLoggato; ?>";

		function inviaRichiesta(destinatario) {
			console.log("Mittente:", mittente);
			console.log("Destinatario:", destinatario);

			$.ajax({
				type: "POST",
				url: "/facebook/backend/richiesta-amicizia.php",
				data: { mittente: mittente, destinatario: destinatario },
				success: function (response) {
					console.log(response);
					// Mostra il messaggio di successo
					$("#messaggioRichiestaInviata").fadeIn();

					// Puoi nascondere il messaggio dopo un certo periodo di tempo
					setTimeout(function () {
						$("#messaggioRichiestaInviata").fadeOut();
					}, 3000); // 3000 millisecondi = 3 secondi
				},
				error: function (error) {
					console.error(error);
					// Gestisci gli errori, se necessario
				}
			});
		}
		
		function accettaRichiesta(destinatario) {
			console.log("Mittente:", mittente);
			console.log("Destinatario:", destinatario);

			$.ajax({
				type: "POST",
				url: "/facebook/backend/accetta-richiesta.php",
				data: { mittente: mittente, destinatario: destinatario },
				success: function (response) {
					console.log(response);
					// Mostra il messaggio di successo
					$("#messaggioRichiestaAccettata").fadeIn();

					// Puoi nascondere il messaggio dopo un certo periodo di tempo
					setTimeout(function () {
						$("#messaggioRichiestaAccettata").fadeOut();
					}, 3000); // 3000 millisecondi = 3 secondi
				},
				error: function (error) {
					console.error(error);
					// Gestisci gli errori, se necessario
				}
			});
		}
		
		function rifiutaRichiesta(destinatario) {
			console.log("Mittente:", mittente);
			console.log("Destinatario:", destinatario);

			$.ajax({
				type: "POST",
				url: "/facebook/backend/rifiuta-richiesta.php",
				data: { mittente: mittente, destinatario: destinatario },
				success: function (response) {
					console.log(response);
					// Mostra il messaggio di successo
					$("#messaggioRichiestaRifiutata").fadeIn();

					// Puoi nascondere il messaggio dopo un certo periodo di tempo
					setTimeout(function () {
						$("#messaggioRichiestaRifiutata").fadeOut();
					}, 3000); // 3000 millisecondi = 3 secondi
				},
				error: function (error) {
					console.error(error);
					// Gestisci gli errori, se necessario
				}
			});
		}
		
		function ottieniRichiesteDiAmicizia() {
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
						richiesteHtml += '<a class="btn btn-primary" href="#" title="Accetta">Accetta</a>';
						richiesteHtml += '<a class="btn btn-primary" href="#" title="Rifiuta">Rifiuta</a>';
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
	}
    </script>