<template>  
	<div class="container">
		<ol class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
			<li><router-link :to="{name: 'indexPelanggan'}" >Pelanggan</router-link></li>
			<li class="active" >Detail</li>    
		</ol>
		<div class="panel panel-default">
			<div class="panel-heading">Detail Pelanggan <b>"{{pelanggan.nama_pelanggan}}"</b></div>

			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<tbody>	
							<tr>
								<td>
									Tanggal Lahir:
								</td>
								<td>{{ pelanggan.tanggal_lahir }}</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>{{ pelanggan.email }}</td>
							</tr>
							<tr>
								<td>Kota:</td>
								<td>{{ pelanggan.kota }}</td>
							</tr>
							<tr>
								<td>Alamat:</td>
								<td>{{ pelanggan.alamat }}</td>						
							</tr>
							<tr>
								<td>Kode Pos:</td>
								<td>{{ pelanggan.kode_pos }}</td>
							</tr>
							<tr>
								<td>Catatan:</td>
								<td>{{ pelanggan.catatan }}</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			pelanggan: [],
			pelangganId: null,
			url : window.location.origin + (window.location.pathname).replace("home", "pelanggan"),
		} 
	},
	mounted(){
		var app = this;
		app.getDataPelanggan();
	},
	methods: {
		alert(pesan) {
			this.$swal({
				title: "Berhasil!",
				text: pesan,
				icon: "success",
			});
		},
		getDataPelanggan(){
			let app = this;
			let id = app.$route.params.id;
			app.pelangganId = id;

			axios.get(app.url+'/detail/' + id)
			.then(function (resp) {
				app.pelanggan = resp.data;
				// console.log(app.pelanggan);
			})
			.catch(function () {
				alert("Could not load your pelanggan");
			});
		},
	}
}
</script>