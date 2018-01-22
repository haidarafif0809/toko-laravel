<style type="text/css">

.logo-toko {
    width: 50%;
    margin: auto;
    display: block;
    box-shadow: 10px 10px 5px 5px;
    border-radius: 5px;
    margin-bottom: 10px;
    }.color {
        margin: auto;
        display: block;
        box-shadow: 5px 4px 2px 1px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    button {

    }
    </style>
    <template>  
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
                        <li class="active">Profile Toko</li>
                    </ul>
                    <div class="panel panel-default">
                        <h4 class="panel-heading"> <i class="fa fa-cog" aria-hidden="true"></i> <B>PROFILE ANDA</B></h4>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <ul class="breadcrumb color">
                        <li class="active">INFORMASI USER</li>
                    </ul>
                    <div class="panel panel-default color">
                        <div class="panel-heading"><i class="fa fa-user-o" aria-hidden="true"></i> User Toko</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody v-if="profileTokos.length > 0 && loading == false" class="data-ada">
                                        <tr v-for="profileToko , index in profileTokos">
                                            <td class="col-md 2">NAMA TOKO</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.nama_toko}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">ALAMAT EMAIL</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.email}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">TANGGAL REGISTRASI</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.created_at}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">LOGIN TERAKHIR </td>
                                            <td class="col-md-8">: {{profileToko.last_login}}</td>
                                        </tr>                
                                        <br>
                                        <ul>
                                            <span v-for="profileToko , index in profileTokos">
                                                <router-link :to="{name: 'editProfileToko', params: {id: profileToko.profileToko.id}}" class="btn btn-md btn-primary" v-bind:id="'edit-' + profileToko.profileToko.id" >
                                                Edit Profil </router-link> 
                                            </span>
                                        </ul>
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
                                <pagination :data="profileTokosData" v-on:pagination-change-page="getProfileTokos"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <ul class="breadcrumb color">
                        <li class="active">INFORMASI TOKO</li>
                    </ul>
                    <div class="panel panel-default color">
                        <div class="panel-heading"><i class="fa fa-university" aria-hidden="true"></i> Toko</div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <tbody v-if="profileTokos.length > 0 && loading == false" class="data-ada">
                                        <tr v-for="profileToko , index in profileTokos">
                                            <td class="col-md 2">NAMA TOKO</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.nama_toko}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">NAMA PEMILIK TOKO</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.nama_pemilik}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">NOMOR TELP</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.no_telp}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">PROVINSI </td>
                                            <td class="col-md-8">: {{profileToko.provinsi.name}}</td>
                                        </tr>                
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">KABUPATEN </td>
                                            <td class="col-md-8">: {{profileToko.kabupaten.name}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">ALAMAT</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.alamat}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">PREFIX MEMBER ID</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.prefix_member_id}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">TANGGAL REGISTRASI</td>
                                            <td class="col-md-8">: {{profileToko.profileToko.created_at}}</td>
                                        </tr>
                                        <tr v-for="profileToko , index in profileTokos" >
                                            <td class="col-md 2">LOGO TOKO</td>
                                            <td class="col-md-8">: 
                                                <img v-if="profileToko.profileToko.foto == null" class="img-responsive thumbnail shadow logo-toko" src="https://www.glasgow.gov.uk/georgesquarewebcam/camera-unavailable.gif">
                                                <img v-else class="logo-toko img-responsive thumbnail shadow" :src="url_img + profileToko.profileToko.foto">
                                            </td>
                                        </tr>
                                        <br>
                                        <ul>
                                            <span v-for="profileToko , index in profileTokos">
                                                <router-link :to="{name: 'editProfileToko', params: {id: profileToko.profileToko.id}}" class="btn btn-md btn-primary" v-bind:id="'edit-' + profileToko.profileToko.id" >
                                                Edit Profil </router-link> 
                                            </span>
                                        </ul>
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
                                <pagination :data="profileTokosData" v-on:pagination-change-page="getProfileTokos"></pagination>
                            </div>
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
                // buat nampilin data dlm bentuk array
                profileTokos: [],
                // buat paginations
                profileTokosData: {},
                message : '',
                url : window.location.origin+(window.location.pathname).replace("home", "profile-toko"),
                url_img : window.location.origin + (window.location.pathname).replace("home", "logo/"),
                loading : true
            }
        },
        mounted() {
            var app = this;
            app.getProfileTokos();
        },
        methods: {
            // method getprofileToko
            getProfileTokos(page) {
                var app = this;
                if (typeof page === 'undefined') {
                    page = 1;
                }
                axios.get(app.url+'/view?page='+page)
                .then(function (resp) {
                    console.log(resp);
                    app.profileTokos = resp.data.data;
                    app.profileTokosData = resp.data;
                    app.loading = false;
                })
                .catch(function (resp) {
                    alert("Could not load Profile Tokos");
                    app.loading = false
                });
            },
        }
    }
    </script>