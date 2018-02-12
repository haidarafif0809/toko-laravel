<template>
    <div class="container">
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
            <li class="active">User Toko</li>
        </ul>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="panel-title">User Toko</p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="pencarian">
                                <input type="text" class="form-control" name="search" placeholder="Pencarian"  v-model="search">
                            </div>
                            <b-table class="table table-striped table-hover data-ada" v-if="users.length > 0 && loading == false" :items="users" :fields="field_users">
                                <!-- <b-tr v-for="user , index in users" :key="user.id"> -->
                                    <template slot="lihat_detail" slot-scope="row">
                                        <b-button size="sm" v-on:click.stop="row.toggleDetails" class="mr-2">
                                            {{ row.detailsShowing ? 'Tutup' : 'Lihat'}} Staf
                                        </b-button>
                                    </template>
                                    <!-- </b-tr> -->
                                    <template slot="row-details" slot-scope="row">
                                        <b-table class="table table-striped table-hover data-ada" :items="staffs[row.item.toko_id]" :fields="field_staffs">
                                        </b-table>
                                    </template>
                                    <tbody v-if="users.length > 0 && loading == true" class="data-ada" >
                                        <tr >
                                            <td colspan="5"  class="text-center">
                                                Sedang Memuat Data
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-if="users.length == 0 && loading == false" class="tidak-ada-data">
                                        <tr>
                                            <td colspan="5"  class="text-center">
                                                Tidak Ada Data
                                            </td>
                                        </tr>
                                    </tbody>
                                </b-table>
                            </div>
                        </div>
                        <vue-simple-spinner v-if="loading"></vue-simple-spinner>
                        <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getUsers" v-if="search == '' "></pagination></div>
                        <div align="right"><pagination :data="usersData" v-on:pagination-change-page="getHasilPencarian" v-if="search != '' "></pagination></div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <script>
    export default {
        data: function () {
            return {
                staffs: [],
                field_users: ['nama_toko','nama_pemilik', 'email', 'no_telp', 'last_login', 'lihat_detail'],
                field_staffs: ['nama_pemilik', 'email', 'no_telp', 'last_login'],
                users: [],
                usersData: {},
                url : window.location.origin+(window.location.pathname).replace("home","admin/user"),
                search : '',
                loading : true

            }
        },
        mounted() {
            var app = this;
            app.loading = true
            app.getUsers();
            app.getStaff(); 

        },
        watch: {
        // whenever question changes, this function will run
        search: function (newQuestion) {
            this.getHasilPencarian();  
        }
    },
    methods: {
        getStaff() {
            let app = this;
            axios.get(app.url + '/viewStaff')
            .then(function(resp) {
                app.loading = false
                app.staffs = resp.data;
                // app.usersData = resp.data
                // console.log(resp.data.data.data.data)
                console.log(resp.data)
            })
            .catch(function (resp) {
                alert("Could not load staff");
            });
        },
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
                // console.log(resp)

            })
            .catch(function (resp) {
                alert("Could not load users");
            });
        },
        getHasilPencarian(page){
            var app = this;
            app.loading = true;
            if (typeof page === 'undefined') {
                page = 1;
            }
            axios.get(app.url+'/pencarian?search='+app.search+'&page='+page)
            .then(function (resp) {
                app.loading = false
                app.users = resp.data.data;
                app.usersData = resp.data;
            })
            .catch(function (resp) {
                app.loading = false
                alert("Could not load users");
            });
        },
        deleteEntry(id, index,nama_pemilik) {
            if (confirm("Yakin Ingin Menghapus Staf "+nama_pemilik+" ?")) {
                var app = this;
                axios.delete(app.url+'/' + id)
                .then(function (resp) {
                    app.getUsers();
                    app.alert(nama_pemilik)
                    app.$router.replace('/user');
                })
                .catch(function (resp) {
                    alert("Could not delete user");
                });
            }
        },
        alert(nama_pemilik) {
            this.$swal({
                title: "Berhasil!",
                text: "Berhasil Menghapus "+ nama_pemilik,
                icon: "success",
            });
        }
    }

}
</script>

