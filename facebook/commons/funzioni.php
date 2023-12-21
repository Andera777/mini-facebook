<?php
function isUser($cid,$login,$pwd)
{
	$risultato= array("msg"=>"","status"=>"ok");

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

   /* inserire controlli dell'input */
   $sql = "SELECT * FROM utente where email = '$login' and password = '$pwd'";
   
   $res = $cid->query($sql);
   	if ($res==null) 
	{
	        $msg = "Si sono verificati i seguenti errori:<br/>" 
     		. $cid->error;
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;			
	}elseif($res->num_rows==0 || $res->num_rows>1)
	{
			$msg = "Login o password sbagliate";
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;		
	}elseif($res->num_rows==1)
	{
	    $msg = "Login effettuato con successo";
		$risultato["status"]="ok";
		$risultato["msg"]=$msg;		
	}
    return $risultato;
}
function verificaPwd($pwd) {
    // Definisci un pattern regex che corrisponda a una maiuscola, un numero e un carattere speciale
    $pattern = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$@$!%*#?&])[A-Za-z\d$@$!%*#?&]{8,}$/';

    // Verifica se la stringa soddisfa il pattern
    return (bool)preg_match($pattern, $pwd);
}

function isCity($cid,$citta,$provincia,$stato){
	

	$sql = "SELECT * FROM citta where 	nomeCittà = '$citta' and provincia = '$provincia' and stato = '$stato'";
	$res = $cid->query($sql);
   	if ($res==null) 
	{
	        return false; 		
	}elseif($res->num_rows==0 || $res->num_rows>1)
	{
			return false; 	
	}elseif($res->num_rows==1)
	{
		return true;	
	}


}

function inserisciUtente($cid,$email,$password,$confirmPwd,$nome,$cognome,$dataN,$cittaN,$provinciaN,$statoN,$cittaR,$provinciaR,$statoR)
{	
	$risultato = array("status"=>"ok","tipoErrore"=>"", "contenuto"=>"");
	
	$errore=false;
	if($_SERVER["REQUEST_METHOD"] == "POST") {

	$nome = trim($nome);
    $cognome = trim($cognome);
	$cittaN = trim($cittaN);
	$provinciaN = trim($provinciaN);
	$statoN = trim($statoN);
	$cittaR = trim($cittaR);
	$provinciaR= trim($provinciaR);
	$statoR = trim($statoR);
	}
	$dati = array("email"=>$email,"pwd"=>$password,"confirmPwd"=>$confirmPwd,
			      "nome"=>$nome,"cognome"=>$cognome,"dataN"=>$dataN,
				  "cittaN"=>$cittaN,"provinciaN"=>$provinciaN,"statoN"=>$statoN,
				  "cittaR"=>$cittaR,"provinciaR"=>$provinciaR,"statoR"=>$statoR);

	$risultato["contenuto"]=$dati;

	$tipoErrore= array(
		"emptyFields",
		"passFormat","passNotSame", "validCittaN","validCittaR"
	);

    if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

	if  (empty($email)|| empty($password) || empty($confirmPwd) || empty($nome) || empty($cognome) ||  empty($dataN) || empty($cittaN) || empty($provinciaN) || empty($statoN)|| empty($cittaR) || empty($provinciaR) || empty($statoR))
	{
		$errore = true;
	 	$tipoErrore["emptyFields"]="riempire tutti i campi";
	}
	
	if (strlen($password)<8 || !verificaPwd($password))
	{
		$errore = true;
		$tipoErrore["passFormat"]="La password deve essere di  almeno 8 caratteri, tra cui almeno una lettera maiuscola, un carattere speciale e un numero <br/>";

	}
	if ($password != $confirmPwd){
		$errore = true;
		$tipoErrore["passNotSame"] ="le due password non corrispondono";
	}
	if (!isCity($cid,$cittaN,$provinciaN,$statoN)){
		$tipoErrore["validCittaN"] = "inserire una città valida";
	}
	if (!isCity($cid,$cittaR,$provinciaR,$statoR)){
		$tipoErrore["validCittaR"] = "inserire una città valida";
	}
	$risultato["tipoErrore"]=$tipoErrore;
	if (!$errore)
	{
	   $sql = "INSERT INTO utente(email, password, nome,cognome,dataNascita,cittaN,provinciaN,statoN,cittaR,provinciaR,statoR) 
                    VALUES ('$email', '$password', '$nome','$cognome','$dataN','$cittaN','$provinciaN','$statoN','$cittaR','$provinciaR','$statoR');"; 
       $res=$cid->query($sql);
	    // stampa la query in un file di log nella cartella backend!!!
		error_log("SQL Query: $sql", 3, "./sql_query.log");
	   if ($res==true){
			$risultato["status"] = "ok";

	   }
	   else
	   {
		   $risultato["status"]="ko";

	   }
	}
	else
	{
		$risultato["status"]="ko";
	}	
	return $risultato;
}

function inviaRichiestaAmicizia($cid, $mittente, $destinatario) {
    $risultato = array("status" => "ok", "tipoErrore" => "", "contenuto" => "");

    $errore = false;
    

    $dati = array(
    "mittente" => $mittente,
    "destinatario" => $destinatario );
    $risultato["contenuto"] = $dati;

    $tipoErrore = array(
        "emptyFields"
    );

    if ($cid == null || $cid->connect_errno) {
        $risultato["status"] = "ko";
        if (!is_null($cid))
            $risultato["msg"] = "Errore nella connessione al db " . $cid->connect_error;
        else $risultato["msg"] = "Errore nella connessione al db ";
        return $risultato;
    }
	
    if (empty($mittente) || empty($destinatario)) {
        $errore = true;
        $tipoErrore["emptyFields"] = "Qualcosa è andato storto";
    }

    $risultato["tipoErrore"] = $tipoErrore;

    if (!$errore) {
        $sql = "INSERT INTO richiestediamicizia(mittente, destinatario) 
                VALUES ('$mittente', '$destinatario');";

        $res = $cid->query($sql);
		//error_log("SQL Query: $sql", 3, "./log/sql_query_richiestediamicizia.log")
        if ($res == true) {
            $risultato["status"] = "ok";
            $risultato["msg"] = "Operazione di invio richiesta di amicizia conclusa con successo";
        } else {
            $risultato["status"] = "ko";
            $risultato["msg"] = "Operazione di invio richiesta di amicizia fallita";
        }
    }

    return $risultato;
}

function accettaRichiestaAmicizia($cid, $mittente, $destinatario) {
    $risultato = array("status" => "ok", "tipoErrore" => "", "contenuto" => "");

    $errore = false;
    

    $dati = array(
    "mittente" => $mittente,
    "destinatario" => $destinatario );
    $risultato["contenuto"] = $dati;

    $tipoErrore = array(
        "emptyFields"
    );

    if ($cid == null || $cid->connect_errno) {
        $risultato["status"] = "ko";
        if (!is_null($cid))
            $risultato["msg"] = "Errore nella connessione al db " . $cid->connect_error;
        else $risultato["msg"] = "Errore nella connessione al db ";
        return $risultato;
    }
	
    if (empty($mittente) || empty($destinatario)) {
        $errore = true;
        $tipoErrore["emptyFields"] = "Qualcosa è andato storto";
    }

    $risultato["tipoErrore"] = $tipoErrore;

    if (!$errore) {
        $sql = "UPDATE richiestediamicizia SET statoRichiesta = 'accettato' , timestampRisposta = NOW()
                WHERE mittente = '$destinatario' AND destinatario = '$mittente';";

        $res = $cid->query($sql);
		//error_log("SQL Query: $sql", 3, "./sql_query_richiestediamicizia.log");
        if ($res == true) {
            $risultato["status"] = "ok";
            $risultato["msg"] = "Operazione di accettazione richiesta di amicizia conclusa con successo";
        } else {
            $risultato["status"] = "ko";
            $risultato["msg"] = "Operazione di accettazione richiesta di amicizia fallita";
        }
    }

    return $risultato;
}

function rifiutaRichiestaAmicizia($cid, $mittente, $destinatario) {
    $risultato = array("status" => "ok", "tipoErrore" => "", "contenuto" => "");

    $errore = false;
    

    $dati = array(
    "mittente" => $mittente,
    "destinatario" => $destinatario );
    $risultato["contenuto"] = $dati;

    $tipoErrore = array(
        "emptyFields"
    );

    if ($cid == null || $cid->connect_errno) {
        $risultato["status"] = "ko";
        if (!is_null($cid))
            $risultato["msg"] = "Errore nella connessione al db " . $cid->connect_error;
        else $risultato["msg"] = "Errore nella connessione al db ";
        return $risultato;
    }
	
    if (empty($mittente) || empty($destinatario)) {
        $errore = true;
        $tipoErrore["emptyFields"] = "Qualcosa è andato storto";
    }

    $risultato["tipoErrore"] = $tipoErrore;

    if (!$errore) {
        $sql = "UPDATE richiestediamicizia SET statoRichiesta = 'rifiutato' , timestampRisposta = NOW()
                WHERE mittente = '$destinatario' AND destinatario = '$mittente';";

        $res = $cid->query($sql);
		//error_log("SQL Query: $sql", 3, "./log/sql_query_richiestediamicizia.log")
        if ($res == 1) {
            $risultato["status"] = "ok";
            $risultato["msg"] = "Operazione di rifiuto richiesta di amicizia conclusa con successo";
        } else {
            $risultato["status"] = "ko";
            $risultato["msg"] = "Operazione di rifiuto richiesta di amicizia fallita";
        }
    }

    return $risultato;
}

function inserisciPost($cid, $user,$testo,$citta,$prov,$stato, $tipo, $nomeFile, $percorsoFile){

    $risultato= array("msg"=>"","status"=>"ok");

	if ($cid == null || $cid->connect_errno) {
		$risultato["status"]="ko";
		if (!is_null($cid))
		     $risultato["msg"]="errore nella connessione al db " . $cid->connect_error;
		else $risultato["msg"]="errore nella connessione al db ";
		return $risultato;
	}

   /* inserire controlli dell'input */
   $sql =" INSERT INTO post(timestampPubblicazione,email,tipo,nomeFile,percorsoFile,testo,citta,provincia,stato) 
   VALUES (NOW(), '$user', '$tipo','$nomeFile','$percorsoFile','$testo','$citta','$prov','$stato');";
   
   $res = $cid->query($sql);
   	if ($res==null) 
	{
	        $msg = "Si sono verificati i seguenti errori:<br/>" 
     		. $cid->error;
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;			
	}elseif($res->num_rows==0 || $res->num_rows>1)
	{
			$msg = "caricamento non riuscito";
			$risultato["status"]="ko";
			$risultato["msg"]=$msg;		
	}elseif($res->num_rows==1)
	{
	    $msg = "post caricato correttamente";
		$risultato["status"]="ok";
		$risultato["msg"]=$msg;		
	}
    return $risultato;

}


?>

