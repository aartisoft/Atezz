<div class="content-page">
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h4 class="page-title m-b-20 m-t-0">Adicionar Categoria</h4>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="card-box">
						<form id="admin_add_cat" action="<?php echo base_url().'admin/category/add_category'; ?>" method="post"  enctype="multipart/form-data"  >
							<div class="form-group">
								<label for="parent_category">Categoria Pai</label>
								<select  class="form-control" name="parent_category">
									<option value="0">None</option>
									<?php foreach ($parent_category as $parent_cat) { ?>
									<option value="<?php echo $parent_cat['CATID'];?>"><?php  echo $parent_cat['name']; ?></option>    
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
								<div class="text-center text-error" id="error-exist"></div>
								<label for="category_name">Nome da Categoria</label>
								<input type="text" name="category_name"  placeholder="Digite o nome da Categoria.. " class="form-control" id="category_name" required>
							</div>
							<div class="form-group m-b-0 m-t-30">
								<button class="btn btn-primary" name="form_submit" value="submit" type="submit">Enviar</button>
							</div>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>