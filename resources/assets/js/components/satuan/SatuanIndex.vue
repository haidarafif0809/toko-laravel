<template>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="breadcrumb">
					<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
					<li class="active">Satuan</li>
				</ul>


				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Satuan</h2>
					</div>

					<p> <router-link :to="{name: 'createSatuan'}" class="btn btn-primary">Tambah Satuan</router-link></p>
					<input type="text" name="search" v-model="pencarian">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<th>Nama</th>
								<th>Aksi</th>
							</thead>
							<tbody v-if="satuans.length" class="data-ada">
								<tr v-for="satuan ,index in satuans">
									<td>{{satuan.nama_satuan}}</td>
									<td>
										<router-link :to="{name: 'editSatuan', params: {id: satuan.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + satuan.id" >
											Edit 
										</router-link> 
										<a href="#"
										class="btn btn-xs btn-danger" 
										v-on:click="deleteEntry(satuan.id, index,satuan.nama_satuan)">Delete</a>
									</td>
								</tr>
							</tbody>
							<tbody class="data-tidak-ada" v-else>
								<tr><td colspan="4" class="text-center">Tidak Ada Data</td></tr>
							</tbody>
						</table>
						<vue-simple-spinner v-if="loading"></vue-simple-spinner>

						<div align="right"><pagination :data="satuansData" v-on:pagination-change-page="getItems" :limit="3"></pagination></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	data: function () {
		return {
			satuans: [],
			satuansData: [],
			pencarian:'',
			url : window.location.origin+(window.location.pathname).replace("home", "satuan"),
			loading : true

		}
	},
	mounted() {
		var app = this;
		app.loading = true
		app.getItems();
	},

	watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	this.getHasilPencarian()  
        }
    },

    methods: {
    	getItems(page) {
    		var app = this;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/view?page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.satuans = resp.data.data;
    			app.satuansData = resp.data;

    		})
    		.catch(function (resp) {
    			alert('Could not load Satuan');
    		});
    	},

    	deleteEntry(id, index,nama_satuan) {
    		if (confirm("Yakin Ingin Menghapus Satuan "+nama_satuan+" ?")) {
    			var app = this;
    			axios.delete(app.url+'/' + id)
    			.then(function (resp) {
    				app.getItems();
    				app.alert(nama_satuan)
    			})
    			.catch(function (resp) {
    				alert("Could not delete Satuan");
    			});
    		}
    	},

    	alert(nama_satuan) {
    		this.$swal({
    			title: "Berhasil!",
    			text: "Berhasil Menghapus Satuan "+ nama_satuan,
    			icon: "success",
    		});
    	},

    	getHasilPencarian(page){
    		var app = this;
    		app.loading = true;
    		if (typeof page === 'undefined') {
    			page = 1;
    		}
    		axios.get(app.url+'/pencarian?search='+app.pencarian+'&page='+page)
    		.then(function (resp) {
    			app.loading = false
    			app.satuans = resp.data.data;
    			app.satuansData = resp.data;
    		})
    		.catch(function (resp) {
    			console.log(resp);
    			app.loading = false
    			alert("Could not load satuans");
    		});
    	},
    }

}
</script>


