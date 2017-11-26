<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
</style>

<template>  
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Kas Masuk</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="tambah-user">
                        <p> <router-link :to="{name: 'createKasMasuk'}" class="btn btn-primary">Create Kas Masuk</router-link></p>        
                    </div>
                    <div class="pencarian">
                        <input type="text" class="form-control" name="pencarian"placeholder="Pencarian"  v-model="pencarian" >
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>No Faktur</th>
                            <th>Kas</th>
                            <th>Kategori</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="kasMasuks.length > 0 && loading == false" class="data-ada">
                            <tr v-for="kasMasuk , index in kasMasuks" >
                                <td>{{kasMasuk.id}}</td>
                                <td>{{kasMasuk.kas_id}}</td>
                                <td>{{kasMasuk.kategori_id}}</td>
                                <td>{{kasMasuk.jumlah}}</td>
                                <td>{{kasMasuk.keterangan}}</td>
                                <td>{{kasMasuk.created_at}}</td>
                                <td>
                                    <router-link :to="{name: 'editKasMasuk', params: {kas_id: kasMasuk.kas_id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + kasMasuk.kas_id" >
                                    Edit  </router-link> 
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteKasMasuk(kasMasuk.id, index,kasMasuk.kas_id)">Delete</a>
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
                 <pagination :data="kasMasuksData" v-on:pagination-change-page="getKasMasuks"></pagination>
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
      kasMasuks: [],
      // buat paginations
      kasMasuksData: {},
      pencarian: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "kasMasuk"),
      loading : true
  }
},
mounted() {
	var app = this;
	app.getKasMasuks();
},
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	var irul = this;
        	irul.searchData()
        }
    },
    methods: {
        getKasMasuks(page) {
        	var app = this;
        	if (typeof page === 'undefined') {
        		page = 1;
        	}
        	axios.get(app.url+'/view?page='+page)
        	.then(function (resp) {
        		app.kasMasuks = resp.data.data;
        		app.kasMasuksData = resp.data;
        		app.loading = false;
        // buat cek ddi console
        console.log(app.kasMasuks)
    })
        	.catch(function (resp) {
        		alert("Could not load KasMasuks");
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
        		app.kasMasuks = resp.data.data;
        		app.kasMasuksData = resp.data;
        		app.loading = false;

        	})
        	.catch(function(resp) {
        		alert("data tidak ditemukan");
        		app.loading = false
        	});
        },
        deleteKasMasuk(id, index,kas_id) {
            if (confirm("Yakin Ingin Menghapus Satuan "+kas_id+" ?")) {
                var app = this;
                axios.delete(app.url+'/' + kas_id)
                .then(function (resp) {
                    app.getKasMasuks();
                    app.alert(kas_id)
                })
                .catch(function (resp) {
                    alert("Could not delete Satuan");
                });
            }
        },
        alert(kas_id) {
        	this.$swal({
        		title: "Berhasil!",
        		text: 'Sukses : Berhasil menghapus Kas Masuk '+ kas_id,
        		icon: "success",
        	});
        }
    }
}
</script>