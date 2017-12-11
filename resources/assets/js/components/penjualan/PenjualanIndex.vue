<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li class="active">Penjualan</li>
		</ul>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="panel-heading">
							<div class="table-responsive">
								<div class="nav">
									<a class="nav-link" href="#">Minuman</a>
									<a class="nav-link" href="#">Makanan</a>
									<a class="nav-link" href="#">Cemilan</a>
									<a class="nav-link" href="#">Gorengan</a>
									<a class="nav-link" href="#">Semua</a>
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