<template>
	<div class="container">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexGerai'}">Gerai</router-link></li>
		</ul>

		<div class="panel panel-default">
			<div class="panel-heading">Gerai</div>
			<div class="panel-body">
				<div class="tambah">
					<p>
						<router-link :to="{name: 'createGerai'}" class="btn btn-primary">Tambah Gerai</router-link>
					</p>
				</div>

				<div class="pencarian">
					<input type="text" class="form-control" placeholder="Cari gerai.." >
				</div>
				
				<table class="table table-striped">
					<thead>
						<th>Nama</th>
						<th>Kota</th>
						<th>Aksi</th>
					</thead>
					<tbody>
						<tr>
							<td>Toko Athacom 1</td>
							<td></td>
							<td>
								<button type="button" class="btn btn-primary">Edit</button>
								<button type="button" class="btn btn-danger">Hapus</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</template>
