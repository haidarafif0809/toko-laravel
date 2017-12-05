<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
</style>

<template>  
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Kategori Produk</li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-heading">Kategori Produk</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="tambah">
                        <p> <router-link :to="{name: 'createKategoriProduk'}" class="btn btn-primary">Create Kategori Produk</router-link></p>        
                    </div>
                    <div class="pencarian">
                        <input type="text" class="form-control" name="pencarian"placeholder="Pencarian"  v-model="pencarian" >
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>Nama Kategori Produk</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="kategoriProduks.length > 0 && loading == false" class="data-ada">
                            <tr v-for="kategoriProduk , index in kategoriProduks" >
                                <td>{{kategoriProduk.nama_kategori_produk}}</td>
                                <td>
                                    <router-link :to="{name: 'editKategoriProduk', params: {id: kategoriProduk.id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + kategoriProduk.id" >
                                    Edit  </router-link> 
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteKategoriProduk(kategoriProduk.id, index,kategoriProduk.nama_kategori_produk)">Delete</a>
                                </td>
                            </tr>
                        </tbody>

                        <tbody v-else-if="loading == true" class="data-ada" >
                            <tr >
                                <td colspan="4"  class="text-center">
                                    Sedang Memuat Data
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else class="tidak-ada-data">
                            <tr>
                                <td colspan="4"  class="text-center">
                                    Tidak Ada Data
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <vue-simple-spinner v-if="loading"></vue-simple-spinner>

                <div align="right">
                 <pagination :data="kategoriProduksData" v-on:pagination-change-page="getKategoriProduks"></pagination>
             </div>
         </div>
     </div>
 </div>
</template>


<script>
export default {
    data: function () {
      return {
      // buat nampilin data dlm bentuk array
      kategoriProduks: [],
      // buat paginations
      kategoriProduksData: {},
      pencarian: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
      loading : true
  }
},
mounted() {
	var app = this;
	app.getKategoriProduks();
},
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	var irul = this;
        	irul.searchData()
        }
    },
    methods: {
        // method getkategoriProduk
        getKategoriProduks(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.kategoriProduks = resp.data.data;
        		app.kategoriProduksData = resp.data;
        		app.loading = false;
        // buat cek ddi console
        console.log(app.kategoriProduks)
    })
        	.catch(function (resp) {
        		alert("Could not load kategoriProduks");
        		app.loading = false
        	});
        },
        searchData(page) {
        	var app = this;
        	app.loading == true;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/search?pencarian='+app.pencarian+'&page='+page)
        	.then(function(resp) {
        		app.kategoriProduks = resp.data.data;
        		app.kategoriProduksData = resp.data;
        		app.loading = false;

        	})
        	.catch(function(resp) {
        		alert("data tidak ditemukan");
        		app.loading = false
        	});
        },
        deleteKategoriProduk(id, index,nama_kategori_produk) {
            if (confirm("Yakin Ingin Menghapus Satuan "+nama_kategori_produk+" ?")) {
                var app = this;
                axios.delete(app.url+'/' + id)
                .then(function (resp) {
                    app.getKategoriProduks();
                    app.alert(nama_kategori_produk)
                })
                .catch(function (resp) {
                    alert("Could not delete Satuan");
                });
            }
        },
        alert(nama_kategori_produk) {
        	this.$swal({
        		title: "Berhasil!",
        		text: 'Sukses : Berhasil menghapus kategori Produk '+ nama_kategori_produk,
        		icon: "success",
        	});
        }
    }
}
</script>