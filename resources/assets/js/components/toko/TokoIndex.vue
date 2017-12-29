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
      <li class="active">Toko</li>
    </ul>

    <div class="panel panel-default">
      <div class="panel-heading">Toko</div>
      <div class="panel-body">
        <div class="table-responsive">
          <div class="pencarian">
            <input type="text" class="form-control" name="pencarian"placeholder="Pencarian"  v-model="pencarian" >
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <th>Nama Toko</th>
              <th>Nama Pemilik</th>
              <th>Email</th>
              <th>No. Telp</th>
              <th>Dibuat Pada</th>
              <th>Konfirmasi</th>
              <th>Aksi</th>
            </thead>
            <tbody v-if="tokos.length > 0 && loading == false" class="data-ada">
              <tr v-for="toko , index in tokos" >
                <td>{{toko.nama_tokos}}</td>
                <td>{{toko.nama_pemilik}}</td>
                <td>{{toko.email}}</td>
                <td>{{toko.no_telp}}</td>
                <td>{{toko.statusToko}}</td>
                <td>{{toko.created_at}}|{{toko.id_user}}</td>
                <td v-if="toko.statusToko == 1">
                  <button type="button" size="xs" v-on:click="statusTokoNonaktif(toko.id_user, index,toko.nama_tokos)" class="btn btn-xs btn-danger">
                    Nonaktifkan Toko 
                  </button>
                </td>
                <td v-else>
                  <button type="button" size="xs" v-on:click="statusTokoAktif(toko.id_user, index,toko.nama_tokos)" class="btn btn-xs btn-danger">
                    Aktifkan Toko 
                  </button>
                </td>
                <router-link :to="{name:'editToko', params: {id: toko.id_toko}}" class="btn btn-xs btn-success" v-bind:id="'edit' +toko.id">Edit</router-link>
                <a href="#"
                class="btn btn-xs btn-danger" 
                v-on:click="deleteToko(toko.id, index,toko.nama_tokos)">Delete</a>
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
        <pagination :data="tokosData" v-on:pagination-change-page="getTokos"></pagination>
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
      tokos: [],
      // users: [],
      // buat paginations
      tokosData: {},
      pencarian: '',
      message : '',
      url : window.location.origin+(window.location.pathname).replace("home", "toko"),
      url_user : window.location.origin+(window.location.pathname).replace("home", "user"),
      loading : true
    }
  },
  mounted() {
   var app = this;
   app.getTokos();
 },
 watch: {
        // whenever question changes, this function will run
        pencarian: function (newQuestion) {
          var app = this;
          app.searchData()
        }
      },
      methods: {
        statusTokoAktif(id_user, index,nama_tokos) {         
          swal({
            title: "Konfirmasi Status Toko",
            text : "Anda Yakin Ingin Mengaktifkan "+nama_tokos+" ?",
            icon : "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willConfirm) => {
            if (willConfirm) {
              var app = this;
              axios.get(app.url_user+'/status/' + id_user)
              .then(function (resp) {
                swal("Berhasil Diaktifkan!  ", {
                  icon: "success",
                });
                app.getTokos();
              })
              .catch(function (resp) {
                app.$router.replace('/toko/');
                swal("Gagal Mengaktifkan!", {
                  icon: "warning",
                });
              });
            }
            this.$router.replace('/toko/');
          });
        },
        statusTokoNonaktif(id_user, index,nama_tokos) {         
          swal({
            title: "Konfirmasi Status Toko",
            text : "Anda Yakin Ingin Menonaktifkan "+nama_tokos+" ?",
            icon : "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willConfirm) => {
            if (willConfirm) {
              var app = this;
              axios.get(app.url_user+'/status/' + id_user)
              .then(function (resp) {

                // app.tokos.status = resp.data.data;
                swal("Berhasil Dinonaktifkan!  ", {
                  icon: "success",
                });
                app.getTokos();
              })
              .catch(function (resp) {
                app.$router.replace('/toko/');
                swal("Gagal Menonaktifkan!", {
                  icon: "warning",
                });
              });
            }
            this.$router.replace('/toko/');
          });
        },
        // method getTokos
        getTokos(page) {
          var app = this;
          if (typeof page === 'undefined') {
            page = 1;
          }
          axios.get(app.url+'/view?page='+page)
          .then(function (resp) {
            app.tokos = resp.data.data;
            app.tokosData = resp.data;
            app.loading = false;
        // buat cek ddi console
        console.log(app.tokos)
      })
          .catch(function (resp) {
            alert("Could not load tokos");
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
          app.tokos = resp.data.data;
          app.tokosData = resp.data;
          app.loading = false;

        })
        .catch(function(resp) {
          alert("data tidak ditemukan");
          app.loading = false
        });
      },
      deleteToko(id, index,nama_tokos) {
       swal({
        title: "Konfirmasi Hapus",
        text : "Anda Yakin Ingin Menghapus "+nama_tokos+" ?",
        icon : "warning",
        buttons: true,
        dangerMode: true,
      })
       .then((willDelete) => {
        if (willDelete) {
          var app = this;
          axios.delete(app.url+'/' + id)
          .then(function (resp) {
            app.getTokos();
            swal("Berhasil Dihapus!  ", {
              icon: "success",
            });
          })
          .catch(function (resp) {
            app.$router.replace('/toko/');
            swal("Gagal Menghapus!", {
              icon: "warning",
            });
          });
        }
        this.$router.replace('/toko/');
      });
     }
   }
 }
 </script>