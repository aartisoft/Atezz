
			<!--TITULO DE DESTAQUE -->

			<section class="sell-banner parallax">

				<div class="container">

					<div class="row">

						<div class="col-md-12 sell-banner-cont">

								<h2>Mostre a todos o que você sabe </br> fazer de melhor. </h2>	

								<h2 class="center-cont">Comece agora!</h2>	

								<div class="create-gig">		


								<?php if(empty($verify_user_premium)){ ?> 								 

									<a href="javascript:;"  data-toggle="modal" data-target="#login-popup">
										<button type="button" id="create_gig_btn" class="btn btn-yellow">Cadastre a sua Ong</button>
									</a>

								<?php } else {?>	

									<a href="javascript:;"  data-toggle="modal" data-target="#register-popup_provider">
										<button type="button" id="create_gig_btn" class="btn btn-yellow">Cadastre a sua Ong</button>
									</a>

								<?php }?>	

								</div>	

						</div>

					</div>

				</div>

			</section>			
			<section class="profile-section">

				<div class="container">

					<div class="row">	

						<div class="col-md-12">

							<ol class="breadcrumb menu-breadcrumb">

								<li><a href="<?php echo base_url(); ?>">Home</a> <i class="fa fa fa-chevron-right"></i></li>

								<li class="active"><?php echo ucfirst($search_value); ?></li>        

							</ol>

						</div>

					</div>

					<div class="row">	

						<div class="col-md-12">

							<h3 class="header-title"> <?php echo ucfirst($search_value); ?> 

                              </h3>

						</div>

					</div>

				</div>

			</section>

			<section class="container">

							<div class="col-md-12" style="margin:40px 0px 40px 0px;" align="center">
								<h3><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tellus tincidunt nunc aliquam, at imperdiet sapien dapibus. Nullam suscipit, sapien id porttitor mollis, ex mauris dictum est, eget tempus sapien sem sit amet arcu. </p></h3>
							</div>	


				<div class="row" align="center" >

							<div class="col-md-6" align="left">
								<div class="col-md-6" style=" margin: 20px 0px 20px 0px; width: 100%; height: 350px; background-color: red;">
								</div> <br/>

									<h3><b>Lorem ipsum dolor sit amet, consectetur.</b></h3>

							</div>

							<div class="col-md-6" align="left">
								<h1><b>Como posso ajudar</b></h1> <br/>
								<h3><b> Lorem ipsum dolor sit amet </b> </h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tellus tincidunt nunc aliquam, at imperdiet sapien dapibus. Nullam suscipit</p> <br/>

								<h3><b> Lorem ipsum dolor sit amet </b> </h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi molestie tellus tincidunt nunc aliquam, at imperdiet sapien dapibus. Nullam suscipit</p>								
								
							</div>

				</div>	
				<div class="row" align="center"style="margin:40px 0px 40px 0px;" >
					<h1><b>Causas Recentes</b></h1><br/>
					<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi placerat, pellentesque augue leo. Orci nullam, nonummy nam sed, sapien temporibus ac ac, velit ante volutpat enim we help 22,4780 pepole</p>

				</div>	
				<div class="row" align="cente" style="text-align: center;">

						<div class="col-md-4" style="margin: 0px 20px 40px 10px; width: 300px; height: 450px; border: 1px solid black;">
							<div style="background-color: blue; width: 299px; height: 200px; margin-left: -15px;"></div><br/>
							<h3><b>Leve água para crianças</b></h3><br/>
							<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec</p>	<br/>


							<?php if(empty($verify_user_premium)){ ?> 								 

								<a href="javascript:;"  data-toggle="modal" data-target="#login-popup">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php } else {?>	

								<a href="javascript:;"  data-toggle="modal" data-target="#register-popup_provider">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php }?>

						</div>

						<div class="col-md-4" style="margin: 0px 20px 40px 10px; width: 300px; height: 450px; border: 1px solid black;">
							<div style="background-color: blue; width: 299px; height: 200px; margin-left: -15px;"></div><br/>
							<h3><b>Leve água para crianças</b></h3><br/>
							<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec</p>	<br/>

							<?php if(empty($verify_user_premium)){ ?> 								 

								<a href="javascript:;"  data-toggle="modal" data-target="#login-popup">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php } else {?>	

								<a href="javascript:;"  data-toggle="modal" data-target="#register-popup_provider">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php }?>

						</div>

						<div class="col-md-4" style="margin: 0px 20px 40px 10px; width: 300px; height: 450px; border: 1px solid black;">
							<div style="background-color: blue; width: 299px; height: 200px; margin-left: -15px;"></div><br/>
							<h3><b>Leve água para crianças</b></h3><br/>
							<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec</p>	<br/>

							<?php if(empty($verify_user_premium)){ ?> 								 

								<a href="javascript:;"  data-toggle="modal" data-target="#login-popup">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php } else {?>	

								<a href="javascript:;"  data-toggle="modal" data-target="#register-popup_provider">
									<button type="button" class="btn btn-success btn-lg">Quero Contribuir</button>
								</a>

							<?php }?>


						</div>

				</div>

			</section>
			<div class="col-lg-12" style="width: 100%; height: 400px; background-color: green; margin-bottom: 40px;">
				<div class="col-md-5" style=" height: 400px; background-color: black; float: left;"></div>
				<div class="col-md-7" style=" height: 400px;  float: left;">
					<h1><b>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque.</b></h1><br/>
					<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi placerat, pellentesque augue leo. Orci nullam, nonummy nam sed, sapien temporibus ac ac, velit ante volutpat enim we help 22,4780 pepole. </p><br/>
						<br>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque.</b></h1><br/>
					<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi placerat, pellentesque augue leo. Orci nullam, nonummy nam sed, sapien temporibus ac ac, velit ante volutpat enim we help 22,4780 pepole.</p><br/>
					<br>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque.</b></h1><br/>
					<p>Lorem ipsum dolor sit amet, vitae mattis vehicula scelerisque suscipit donec, tortor duis phasellus vivamus wisi placerat, pellentesque augue leo. Orci nullam, nonummy nam sed, sapien temporibus ac ac, velit ante volutpat enim we help 22,4780 pepole.</p>
				</div>
			</div>
			<div class="row" style="margin: 40px 40px 40px 40px;"></div>
								
			<script type="text/javascript">
				
					function checkbox(child) {
					    var parent = child.parentElement || child.parentNode;
					    var id_plano = parent.getAttribute('id');
					    
					    if(id_plano == "plano-1")
					    {
					    	document.getElementById("txtP").innerHTML=  "MENSAL";
					    }
					    else if(id_plano == "plano-2")
					   	{
					   		document.getElementById("txtP").innerHTML=  "TRIMESTRAL";
						}
					    else
					    {
					    	document.getElementById("txtP").innerHTML=  "SEMESTRAL";
					    }
					}

			</script>


		<!-- POP-UP REGISTER PROVIDER -->
        <?php if(!$this->session->userdata('SESSION_USER_ID')) {} else { ?>
		<div id="register-popup_provider" class="modal fade custom-popup" role="dialog" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog">
				<div class="modal-content">
					<button type="button" id="remove_popuptop_provider" class="close" data-dismiss="modal">&times;</button>
					<div class="modal-header text-center">
					</div>
					<div class="modal-body">
						<div id="register_errtext"></div>
						<form id="provider_register" class="form-horizontal">
							<span id="register_success_provider"> </span>

							<div class="col-lg-12" align="center" style="margin: 0px 0px 20px 0px;">

								<h2><b>Conta Premium Atezz</b></h2> 
							    <p class="member-text">Seja um prestador Atezz e conquiste ainda mais clientes. </p>	<br/>
								<p class="member-text">O seu plano escolhido: <h4><b id="txtP"></b></h4></p><br/>							    						
							</div>

							<div class="form-group">
								<label class="col-lg-4">Instituição que apoiarei </label>
								<div class="col-lg-8">
									<select name="instituicoes" id="instituicoes" style="width:240px; height: 35px;">
										<option 		 >Selecionar..</option>
										<option value="0">Lar dos Idosos - Maria de Fátima</option>
										<option value="1"> Sopão da madrugada</option>
										<option value="2">Resgate amigo - Pets</option>
										<option value="3">Orfanato Joãozinho</option>
										<option value="4">AACD São Paulo</option>

									</select>

								</div>
							</div>	

							<div class="form-group">
								<label class="col-lg-4">Porcentagem que será doado </label>
								<div class="col-lg-8">
									<select name="porcentagem" id="porcentagem" style="width:240px; height: 35px;">
										<option value="5">5%</option>
										<option value="10">10%</option>
										<option value="15">15%</option>
										<option value="20">20%</option>
										<option value="30">30% ou mais..</option>

									</select>

								</div>
							</div>								

							<div class="form-group">
								<label class="col-lg-4">Forma de Pagamento </label>
								<div class="col-lg-8">
									<section id="meio_pagamento">
										<input type="radio" class="check_pay" name="meio_pagamento" id="boleto" value="boleto" checked > Boleto <br/>
										<input type="radio" class="check_pay" name="meio_pagamento" id="ccredito" value="ccredito" > Cartão de Crédito<br/>
										<input type="radio" class="check_pay" name="meio_pagamento" id="debt_automatico" value="debt_automatico" > Débito Automático<br/>	
									</section> 

								</div>
							</div>	

							<div class="form-group">
								<label class="col-lg-4">Cupom de Desconto </label>
								<div class="col-lg-8">
									<input type="email" value=""  placeholder="" id="cupom_desconto" name='cupom_desconto' class="form-control">
								</div>
							</div>																										
																			

							<div class="form-group">
								<div class="col-lg-12">
									<div class="terms-text text-center">
										Leia o <a href="<?php echo base_url().'terms';?>" target="_blank"> Termos e condições ATezz</a>.    <br/>           
									</div>		
								</div>										
							</div>
							<div class="form-group">								
								<div class="col-lg-12 text-center"><button type="submit" class="btn btn-primary logon-btn" id="registers_provider">Confirmar</button></div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- END POP-UP REGISTER PROVIDER -->


		<?php } ?>



			<!-- <div class="tab-content buy-section">

				<div class="container">

					<div class="row">

                        <input type="text" name="country_name" id="full_country_name" style="display: none" >

						<div class="col-md-12">                                                    

							<div class="top-pagination">

                                <?php echo $links; ?>

							</div>	

						</div>	

					</div>

				<div class="row">

                 <?php 

					  if(($this->session->userdata('SESSION_USER_ID')))

						{

							$user_id = $this->session->userdata('SESSION_USER_ID'); 

							$favorites_list=array();

							foreach ($user_favorites as $value){

								$favorites_list[]=$value['gig_id'];

							}

							//print_r($favorites_list);

						} 

							

						

									if(!empty($list))

									{

									foreach($list as $gigs ) 

                                    { 
										$currency_option = (!empty($gigs['currency_type']))?$gigs['currency_type']:'USD';
										$rate_symbol = currency_sign($currency_option);											
										 

														//$rate = $gig_price;

														$rate = $gigs['gig_price'];

														$extra_gig_price =  $extra_gig_price;

														 

														

										   $username = $gigs['username'];

											$name = $gigs['username'];

											if(!empty($gigs['fullname']))

											{

												$name = $gigs['fullname'];

											}

				 							$image = "assets/images/2.jpg";

											if(!empty($gigs['gig_image'])) {

											$image = base_url().$gigs['gig_image']; }  

											

											$user_img = base_url()."assets/images/avatar2.jpg";

											if(!empty($gigs['user_thumb_image']))

											{

											$user_img = base_url().$gigs['user_thumb_image'];    

											}

                                            $gig_rating=0;

											$gig_rating1=0;

											if(!empty($gigs['gig_rating']))

											{

											$gig_rating1 = round($gigs['gig_rating']);  

											$gig_rating  = $gig_rating1 *2;  

											}                           

                                        	$gig_usercount=0;

											if(!empty($gigs['gig_usercount']))

											{

												$gig_usercount  = $gigs['gig_usercount'];  

											}   

                                        	$gig_idone=$gigs['id']; 

                                        ?>

                                    <div class="col-md-3 col-sm-6 product-cols">                                        

										<div class="product">  

										<div class="product-img">  

                                            <a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><img width="240" height="250" alt="<?php echo $gigs['title']; ?>" src="<?php echo $image; ?>"></a>

											<?php if(($this->session->userdata('SESSION_USER_ID'))) {

												$user_id = $this->session->userdata('SESSION_USER_ID'); 

													if($gigs['user_id'] != $user_id) 

                                            		{  

													if (in_array($gig_idone, $favorites_list)) {?>

                                                    <div id="favourite_area_list"><a href="javascript:;" class="favourite favourited" title="Remove Favourite" onclick="remove_favourites_list('<?php echo $gig_idone; ?>','<?php echo $user_id; ?>', this)"><i class="fa fa-heart"></i></a></div>

                                              		<?php } else {?>

						                           	<div id="favourite_area_list"><a href="javascript:;" class="favourite" title="Add Favourite" onclick="add_favourites_list('<?php echo $gig_idone; ?>','<?php echo $user_id; ?>', this)"><i class="fa fa-heart"></i></a></div>

                                            <?php }  } }?>

										</div>

										<div class="product-detail">

                                                                                    <div class="product-name"><a href="<?php echo base_url().'gig-preview/'.$gigs['title']; ?>"><?php echo ucfirst(str_replace("-"," ",$gigs['title'])); ?></a></div>

											<div class="author">

												<span class="author-img">

													<a href="<?php echo base_url()."user-profile/".$username; ?>"><img src="<?php echo $user_img;?>" title="<?php echo $gigs['fullname']; ?>" alt="" width="50" height="50"></a>

													<a class="author-name" href="<?php echo base_url()."user-profile/".$username; ?>"><?php echo ucfirst($name); ?></a>

												</span>

												<div class="ratings">

													<span class="stars-block star-<?php echo $gig_rating;?>"></span><span class="ratings-count">(<?php echo $gig_usercount;?>)</span>

												</div>

											</div>											 

											<div class="price-box2">

												<div class="price-inner">

													<div class="rectangle">

														<h2><?php echo $rate_symbol.$rate; ?></h2>

													</div>

													<div class="triangle"></div>

												</div>

											</div>

											<div class="product-det">

                                                <div class="user-country text-ellipsis"><?php echo ucfirst($gigs['state_name']);?><?php if($gigs['state_name']!=''){ echo ', ';}?><?php echo ucfirst($gigs['country']); ?></div>	 

												<div class="product-currency">												 

												</div>	

											</div>

										</div>

									</div>	

                                    </div>

                                    <?php } } else { ?>   

										<div class="col-md-12"><p> Sorry ! No Gigs Found </p></div>

									<?php } ?>

                                </div>

					<div class="row">

						<div class="col-md-12">

							<div class="bottom-pagination">

								<ul class="pagination pagination-sm">

									<li><?php echo $links; ?></li>  

								</ul>

							</div>	

						</div>	

					</div>

				</div>

			</div> -->