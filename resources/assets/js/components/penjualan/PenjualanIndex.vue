<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Penjualan</li>
		</ul>

		<div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">List Produk</div>
					<div class="panel-body">
						<div class="row">

							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="Pencarian...">
								<br />
								<div class="row">
									<div class="col-md-4">
										<div class="thumbnail" @click="">
											<div class="caption">
												<h4></h4>
												<p></p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</template>
