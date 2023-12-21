<!DOCTYPE html>
<html lang="en">
<?php include '../commons/header.php'; 
$errore = array();
if (isset($_GET["status"]))
{ 
  if ($_GET["status"]=="ko"){
    $errore = unserialize($_GET["errore"]);
    $dati = unserialize($_GET["dati"]);
  }
  print_r($dati);
}
?>
    
<body>
    <div class="wrapper">
        <div class="box">
            <div class="row row-offcanvas row-offcanvas-left">
                
                <!-- main right col -->
                <div class="column col-sm-12" id="main">
                    <!--static nav -->
                    <?php include '../commons/navbarstatic.php'; ?>
                    <!-- /static nav -->
                    
                    <div class="padding">
                        <div class="full col-sm-9">
                            
                            <!-- content -->                      
                            <div class="row">
                                <!-- main col left -->
                                <div class="col-sm-6 col-sm-offset-3">                           
                                    <div class="well"> 
                                        <form action="../backend/registrazione-exe.php" method="POST">
                                            
                                            <div class="input-group text-center">
                                                <h6 class="mt-3 mb-2 text-primary" style="text-align: center">INFORMAZIONI DI ACCESSO</h6>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="email" type="email" style="border-radius: 10px;" id="email" name="email" value = <?php if(isset($_GET["status"])) echo $dati["email"]; ?>>
                                                </div>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="Password" type="password" id="pwd" style="border-radius: 10px;" name="pwd" value = <?php if(isset($_GET["status"])) echo $dati["pwd"]; ?>>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer; position: absolute; top: 16.5%; right: 25px; transform: translateY(-50%);">
                                                            <i class="fas fa-eye"></i> 

                                                        </span>
                                                        <?php 
                                                            if (isset($errore["passFormat"])) {
                                                                echo "<span class = 'errore '>".$errore["passFormat"]."</span>";
                                                            }
                                                     ?>
                                                        
                                                    </div>
                                                </div>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="Conferma Password" type="password" id="confirmPwd" style="border-radius: 10px;" name="confirmPwd" value = <?php if(isset($_GET["status"])) echo $dati["confirmPwd"]; ?>>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="toggleConfirmPassword" style="cursor: pointer; position: absolute; top: 26%; right: 25px; transform: translateY(-50%);">
                                                            <i class="fas fa-eye"></i>
                                                        </span>
                                                        <?php
                                                        if (isset($errore["passNotSame"])) {
                                                            echo "<span class = 'errore'>".$errore["passNotSame"]."</span>";
                                                        }
                                                     ?>
                                                    </div>
                                                </div>
                                                <h6 class="mt-3 mb-2 text-primary" style="text-align: center">INFORMAZIONI ANAGRAFICHE</h6>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="Nome" type="text" style="border-radius: 10px;" id="nome" name="nome" value = <?php if(isset($_GET["status"])) echo $dati["nome"]; ?>>
                                                </div>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="Cognome" type="text" style="border-radius: 10px;" id="cognome" name="cognome" value = <?php if(isset($_GET["status"])) echo $dati["cognome"]; ?>>
                                                </div>
                                                <div style="padding: 10px;">
                                                    <input class="form-control input-lg" placeholder="Data di Nascita" type="date" style="border-radius: 10px;" id="dataN" name="dataN" value = <?php if(isset($_GET["status"])) echo $dati["dataN"]; ?>>
                                                </div>
                                                <div class="form-group" style="padding: 10px;">
                                                    <label for="nomecitta">Città di residenza</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="cittaR" placeholder="Città" name="cittaR" value = <?php if(isset($_GET["status"])) echo $dati["cittaR"]; ?>>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="provinciaR" placeholder="Provincia" name="provinciaR" value = <?php if(isset($_GET["status"])) echo $dati["provinciaR"]; ?>>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="statoR" placeholder="Stato" name="statoR" value = <?php if(isset($_GET["status"])) echo $dati["statoR"]; ?>>
                                                        </div>
                                                        <?php
                                                        if (isset($errore["validCittaR"])) {
                                                            echo "<span class = 'errore'>".$errore["validCittaR"]."</span>";
                                                        }
                                                     ?>
                                                    </div>
                                                </div>
												<div class="form-group" style="padding: 10px;">
                                                    <label for="nomecitta">Città di nascita</label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="cittaN" placeholder="Città" name="cittaN" value = <?php if(isset($_GET["status"])) echo $dati["cittaN"]; ?>>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="provinciaN" placeholder="Provincia" name="provinciaN" value = <?php if(isset($_GET["status"])) echo $dati["provinciaN"]; ?>>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="text" class="form-control" id="statoN" placeholder="Stato" name="statoN" value = <?php if(isset($_GET["status"])) echo $dati["statoN"]; ?>>
                                                        </div>
                                                        <?php
                                                        if (isset($errore["validCittaN"])) {
                                                            echo "<span class = 'errore'>".$errore["validCittaN"]."</span>";
                                                        }
                                                     ?>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="padding: 10px;">
                                                    <?php
                                                        if (isset($errore["emptyFields"])) {
                                                            echo "<span class = 'errore'>".$errore["emptyFields"]."</span>";
                                                        }
                                                     ?>
                                                </div>

                                                <div class="input-group text-center col-sm-4 col-sm-offset-4">
                                                    <ul class="list-inline d-block">
                                                        <li class="input-btn" style="padding: 10px;">
                                                            <input type="submit" class="btn btn-lg btn-primary" name="signup" value = "INVIA">
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!--/row-->
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
                                </div>
                            </div>
                            
                            <div class="row" id="footer">    
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6">
                                    <p>
                                        <a href="#" class="pull-right">© Copyright 2013</a>
                                    </p>
                                </div>
                            </div>
                            
                        </div><!-- /col-9 -->
                    </div><!-- /padding -->
                </div>
                <!-- /main -->
            </div>
        </div>
    </div>

    <!--post modal-->
    <?php include '../commons/postmodal.php'; ?>
</body>
</html>
