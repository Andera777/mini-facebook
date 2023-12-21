<!DOCTYPE html>
<html lang="en">
<?php include '../commons/header.php'; ?>
    
    <body>
        
        <div class="wrapper">
			<div class="box">
				<div class="row row-offcanvas row-offcanvas-left">
					

				  
					<!-- main right col -->
					<div class="column col-sm-12" id="main">

					  <!--static nav -->
						<?php include '../commons/navbar.php'; ?>
						<!-- /static nav -->
						
						<div class="padding">
							<div class="full col-sm-9">
							  
								<!-- content -->                      
								<div class="row">
								  
							
													   
										<div class="well"> 
										   <form class="form">
											  <div class="row">
												 <!-- Colonna 1: Informazioni di anagrafiche -->
												 <div class="col-md-4 bg-light">
												<h6 class="mt-3 mb-2 text-primary text-center">INFORMAZIONI ANAGRAFICHE</h6>

												<div class="form-group">
													<input class="form-control input-lg" placeholder="Nome" type="text" id="Nome" style="border-radius: 10px;">
												</div>

												<div class="form-group">
													<input class="form-control input-lg" placeholder="Cognome" type="text" id="Cognome" style="border-radius: 10px;">
												</div>

												<div class="form-group">
													<label for="dataN">Data di nascita</label>
													<input type="date" class="form-control" id="dataN" style="width: 100%; border-radius: 10px; height: 43px;">
												</div>

												<div class="form-group">
													<label for="genere">Identità di genere</label>
													<select class="form-control" name="genere" id="genere" style="width: 100%; border-radius: 10px; height: 43px;">
														<option value="uomo">uomo</option>
														<option value="donna">donna</option>
														<option value="non-binary">non-binary</option>
														<option value="altro">altro</option>
													</select>
												</div>

												<div class="form-group">
													<label for="nomecitta">Città di residenza</label>
													<div class="row">
														<div class="col-md-4">
															<input type="text" class="form-control" id="cittaR" placeholder="Città">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" id="provR" placeholder="Provincia">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" id="statoR" placeholder="Stato">
														</div>
													</div>
												</div>

												<div class="form-group">
													<label for="nomecitta">Città di nascita</label>
													<div class="row">
														<div class="col-md-4">
															<input type="text" class="form-control" id="cittaN" placeholder="Città">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" id="provN" placeholder="Provincia">
														</div>
														<div class="col-md-4">
															<input type="text" class="form-control" id="statoN" placeholder="Stato">
														</div>
													</div>
												</div>
											</div>
											<!-- Colonna 2: Informazioni Anagrafiche -->
											<div class="col-md-4 bg-light">
													<h6 class="mt-3 mb-2 text-primary text-center">INFORMAZIONI DI ACCESSO</h6>
													<div class="form-group">
													   <input class="form-control input-lg" placeholder="Nome Utente" type="text" style="border-radius: 10px;">
													</div>
													<div class="form-group">
													   <input class="form-control input-lg" placeholder="Cambia Password" type="password" id="passwordInput" style="border-radius: 10px;">
													   <div class="input-group-append">
														  <span class="input-group-text" id="togglePassword" style="cursor: pointer; position: absolute; top: 72.5%; right: 30px; transform: translateY(-50%);">
															 <i class="fas fa-eye"></i>
														  </span>
													   </div>
													</div>
												 </div>

												
											
												 <!-- Colonna 3: Altro -->
												<div class="col-md-4 bg-light">
													<h6 class="mt-3 mb-2 text-primary text-center">ALTRO</h6>

													<div class="form-group">
														<input class="form-control input-lg" placeholder="Orientamento sessuale" type="text" style="border-radius: 10px;">
													</div>

													<div class="form-group">
														<input class="form-control input-lg" placeholder="Hobby" type="text" style="border-radius: 10px;">
													</div>

													<div class="form-group text-center">
														<button type="button" id="submit" name="submit" class="btn btn-primary">Aggiungi</button>
													</div>
												</div>
											  </div>
										   </form>
										   
										   <div class="row">
											<div class="col-md-12 text-center">
												<button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
												<button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
											</div>
										</div>
										</div>
																	  
																			  
																	   </div><!--/row-->
																	  
																		<div class="row">
																		  <div class="col-sm-6">
																			<a href="#">Twitter</a> <small class="text-muted">|</small> <a href="#">Facebook</a> <small class="text-muted">|</small> <a href="#">Google+</a>
																		  </div>
																		</div>
																	  
																		<div class="row" id="footer">    
																		  <div class="col-sm-6">
																			
																		  </div>
																		  <div class="col-sm-6">
																			<p>
																			<a href="#" class="pull-right">�Copyright 2013</a>
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
</body></html>