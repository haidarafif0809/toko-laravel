<style scoped>
.pencarian {
	color: red;

	float: right;
	padding-bottom: 10px;
}
.label {
    display: inline-block;
    padding: 2px 10px;
    font-size: 11.844px;
    font-weight: 1000;
    line-height: 20px;
    color: white;
    vertical-align: baseline;
    white-space: nowrap;
    text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
    background-color: #999999;
}
</style>

<template>  
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">Staff Toko</li>
        </ul>
        <div class="panel panel-default">
            <h4 class="panel-heading"> <i class="fa fa-cog" aria-hidden="true"></i> <B>PENGATURAN STAFF</B></h4>
        </div> 

        <div class="panel panel-default">
            <div class="panel-heading"><i class="fa fa-user-circle" aria-hidden="true"></i> Staff Toko</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div class="tambah">
                        <p> <router-link :to="{name: 'createStafToko'}" class="btn btn-primary"><i class="fa fa-user-plus" aria-hidden="true"></i> Tambah Staff Toko</router-link></p>        
                    </div>
                    <div class="pencarian">
                        <input type="text" class="form-control" name="search"placeholder="Pencarian"  v-model="search" >
                    </div>
                    <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                       <thead>
                        <th>Nama Pemilik</th>
                        <th>Email</th>
                        <th>No. Tlp</th>
                        <th>Login Terakhir</th>
                    </thead>
                    <tbody v-if="users.length > 0 && loading == false" class="data-ada">
                        <tr v-for="user ,index in users">
                            <td>{{ user.nama_pemilik }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.no_telp }}</td>
                            <td>{{ user.last_login }}</td>
                            <td>
                                <router-link :to="{ name:'editStafToko', params: {id: user.id}}" class="btn btn-xs btn-success" v-bin:id="'edit-' + user.id"><i class="fa fa-pencil" aria-hidden="true"></i> Edit
                                </router-link>
                                <a href="#" class="btn btn-xs btn-danger" v-bind:id="'delete-' + user.id" v-on:click="deleteEntry(user.id, index,user.nama_pemilik)"><i class="fa fa-trash-o" aria-hidden="true"></i> Hapus
                                </a>
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
            <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getUsers" v-if="search == '' "></pagination></div>
            <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading ">
            <h4 class="label"> <i class="fa fa-info-circle " aria-hidden="true"> </i> INFO</h4> <b><i> Undangan kepada staff baru akan diberikan melalui Email konfirmasi.</i></b> 
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
         users: [],
         usersData: {},
         url : window.location.origin+(window.location.pathname).replace("home","staf-toko"),
         search : '',
         loading : true

     }
 },
 mounted() {
  var app = this;
  app.loading = true
  app.getUsers();   

},
watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
            this.getHasilPencarian();  
        }
    },
    methods: {
        getUsers(page) {
            var app = this;
            if (typeof page === 'undefined') {
                page = 1;
            }
            axios.get(app.url+'/view?page='+page)
            .then(function (resp) {
                app.loading = false
                app.users = resp.data.data;
                app.usersData = resp.data
                console.log(resp)

            })
            .catch(function (resp) {
                alert("Could not load users");
            });
        },
        deleteEntry(id, index,nama_pemilik) {
           this.$swal({
            title: "Hapus?", 
            text: "Yakin Ingin Menghapus user "+ nama_pemilik +" ?", 
            icon: "warning",
            buttons: ['Batal', 'Hapus'],
            dangerMode: true,
        })
           .then((willDelete) => {
            if (willDelete) {
              var app = this;
              axios.delete(app.url+'/' + id)
              .then(function (resp) {
                app.getUsers();
                app.alert("Berhasil Menghapus Staf "+nama_pemilik)
            })
              .catch(function (resp) {
                app.alert("Tidak dapat menghapus Staf!");
            });
          } 
          else {
              return;
          }
      });
       },
       alert(pesan) {
          this.$swal({
            title: "Berhasil!",
            text: pesan,
            icon: "success",
        });
      },
      getHasilPencarian(page){
        var app = this;
        app.loading = true;
        if (typeof page === 'undefined') {
            page = 1;
        }
        axios.get(app.url+'/search?search='+app.search+'&page='+page)
        .then(function (resp) {
            app.loading = false
            app.users = resp.data.data;
            app.usersData = resp.data;
        })
        .catch(function (resp) {
            console.log(resp);
            app.loading = false
            alert("Could not load users");
        });

    }
}

}
</script>