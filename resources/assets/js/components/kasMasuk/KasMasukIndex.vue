<template>  
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Kas Masuk</li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-heading">Kas Masuk</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="tambah">
                        <p> <router-link :to="{name: 'createKasMasuk'}" class="btn btn-primary">Tambah Kas Masuk</router-link></p>        
                    </div>
                    <div class="pencarian">
                        <input type="text" class="form-control" name="pencarian" placeholder="Pencarian"  v-model="pencarian" >
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <th>No TRQ</th>
                            <th>type</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Waktu</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody v-if="kasMasuks.length > 0 && loading == false" class="data-ada">
                            <tr v-for = "kasMasuk, index in kasMasuks">
                                <td>{{kasMasuk.kas_masuk_id}}</td>
                                <td>
                                    <span v-if="kasMasuk.type == 1">Kas Masuk</span>
                                    <span v-else> Kas Keluar</span>
                                </td>
                                <td>{{kasMasuk.jumlah}}</td>
                                <td>{{kasMasuk.keterangan}}</td>
                                <td>{{kasMasuk.created_at}}</td>
                                <td>
                                    <router-link :to="{name: 'editKasMasuk', params: {id: kasMasuk.kas_masuk_id}}" class="btn btn-xs btn-default" v-bind:id="'edit-' + kasMasuk.kas_masuk_id" >
                                    Edit  </router-link> 
                                    <a href="#"
                                    class="btn btn-xs btn-danger" 
                                    v-on:click="deleteKasMasuk(kasMasuk.kas_masuk_id, index,kasMasuk.type)">Hapus</a>
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
      // kas: [],
      // kategori_transaksis: [],
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
    // app.getDataKas();
    // app.getDataTransaksi();
},
watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
        	var app = this;
        	app.searchData()
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
        console.log(resp.data.data);
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
        deleteKasMasuk(id, index,type) {
           swal({
            title: "Konfirmasi Hapus",
            text : "Anda Yakin Ingin Menghapus "+type+" ?",
            icon : "warning",
            buttons: true,
            dangerMode: true,
        })
           .then((willDelete) => {
            if (willDelete) {
              var app = this;
              axios.delete(app.url+'/' + id)
              .then(function (resp) {
                app.getKasMasuks();
                swal("Berhasil Dihapus!  ", {
                  icon: "success",
              });
            })
              .catch(function (resp) {
                app.$router.replace('/kategori-transaksi/');
                swal("Gagal Menghapus!", {
                  icon: "warning",
              });
            });
          }
          this.$router.replace('/kasMasuk/');
      });
       },
       alert(type) {
           this.$swal({
              title: "Berhasil!",
              text: 'Sukses : Berhasil menghapus Kas Masuk '+ type,
              icon: "success",
          });
       }
   }

}
</script>