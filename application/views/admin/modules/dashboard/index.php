<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-t-0 m-b-20">Painel de controle</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6"> 
					<a href="<?php echo base_url().'admin/gigs'; ?>">
						<div class="dash-widget">
							<i class="mdi mdi-account-box text-custom"></i>
							<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_gigs']; ?></h2>
							<div class="text-muted m-t-5">Total Serviços</div>
						</div>
					</a>    
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="<?php echo base_url().'admin/user'; ?>">
						<div class="dash-widget">
							<i class="mdi mdi-account-box text-custom"></i>
							<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_user']; ?></h2>
							<div class="text-muted m-t-5">Total Usuários</div>
						</div>
					</a>     
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="<?php echo base_url().'admin/orders'; ?>">
						<div class="dash-widget">
							<i class="mdi mdi-store text-custom"></i>
							<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['total_orders']; ?></h2>
							<div class="text-muted m-t-5">Total Pedidos</div>
						</div>
					</a>    
				</div>
				<div class="col-lg-3 col-sm-6">
					<a href="<?php echo base_url().'admin/completed_orders'; ?>">
						<div class="dash-widget">
							<i class="mdi mdi-cart text-custom"></i>  
							<h2 class="m-0 text-dark counter font-600"><?php echo $dashboard_details['completed_orders']; ?></h2>
							<div class="text-muted m-t-5">Pedidos Finalizados</div>
						</div>
					</a>    
				</div>
			</div>
			<div class="row">
				<div class="col-lg-6">
					<div class="card-box">
						<a href="<?php echo base_url()."admin/orders"; ?>" class="pull-right btn btn-default btn-sm">Ver mais</a>
						<h4 class="text-dark header-title m-t-0 m-b-20">Pedidos Recentes</h4>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Serviço</th>
										<th>Data</th>
										<th>ID Pedido</th>
										<th>Valor</th>                                                   
									</tr>
								</thead>
								<tbody>
								<?php 		 
								 if(!empty($recent_orders))
								 {
								foreach($recent_orders as $recent) {							
								$case = $recent['currency_type'];
								 switch ($case) {
								 		case 'USD':
								 			$rate_symbol = "R$";	
								 			break;
								 		case 'EUR':
								 			$rate_symbol = "€";	
								 			break;
								 		case 'GBP':
								 			$rate_symbol = "£";	
								 			break;
								 		
								 		default:
								 			$rate_symbol = "$";	
								 			break;
								 	}	
								
								$rate = $recent['item_amount'];		
								$price = $rate_symbol.$rate;

							/* 	if($country_name!="IN")
								{
								$rate_symbol = "$ ";
								$rate = $recent['item_amount'] / $this->session->userdata('dollar_rate');
								$rate = number_format((float)$rate, 2, '.', '');		
								$price = $rate_symbol.$rate;
								} */

								 $image = base_url().'assets/images/gig-small.jpg';
								 if(!empty($recent['gig_image_thumb']))
								 {
								 $image = base_url().$recent['gig_image_thumb'];
								 }
								 ?>                                        
									<tr>
										<td><img src="<?php echo $image; ?>" class="gig-img" alt=""> </td>
										<td><?php echo date('d M Y', strtotime(str_replace('-','/', $recent['created_at'])));  ?></td>
										<td><?php echo $recent['paypal_uid']; ?></td>
										<td><?php echo $price ; ?></td>
									</tr>
									<?php }
									}else{ ?>
									<td colspan="4"><p class="text-danger text-center m-b-0">No Records Found</p></td>
									<?php }?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="card-box">
						<a href="<?php echo base_url()."admin/gigs"; ?>" class="pull-right btn btn-default btn-sm">Ver mais</a>
						<h4 class="text-dark header-title m-t-0 m-b-20"> Mais Solicitados</h4>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Produto</th>
										<th>Data</th>
										<th>Views</th>
										<th>Valor</th>                                                    
									</tr>
								</thead>
								<tbody>
									<?php 
									if(!empty($popular_orders)){
									foreach($popular_orders as $popular_order) { 
										
									$case = $popular_order['currency_type'];
								 switch ($case) {
								 		case 'USD':
								 			$rate_symbol = "R$";	
								 			break;
								 		case 'EUR':
								 			$rate_symbol = "€";	
								 			break;
								 		case 'GBP':
								 			$rate_symbol = "£";	
								 			break;
								 		
								 		default:
								 			$rate_symbol = "$";	
								 			break;
								 	}	
	
									//$rate = $price_of_gig['value'] ; // Fixed Price 
									$rate = $popular_order['gig_price'] ; // Dynamic Price 

									$price = $rate_symbol.$rate;
									$image = base_url().'assets/images/gig-small.jpg';
									if(!empty($popular_order['gig_image']))
									{
									$image = base_url().$popular_order['gig_image'];
									}
									?>         
									<tr>
										<td><img src="<?php echo $image ; ?>" class="gig-img" alt="<?php echo str_replace('-', ' ', $popular_order['title']); ?>"> </td>
										<td><?php echo date('d M Y', strtotime(str_replace('-','/', $popular_order['created_date'])));  ?></td>
										<td><b><?php echo $popular_order['total_views']; ?></b></td>
										<td><?php echo $price ; ?></td>       
									</tr>
									<?php } 
									}else{ ?>
									<td colspan="4"><p class="text-danger text-center m-b-0">No Records Found</p></td>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>