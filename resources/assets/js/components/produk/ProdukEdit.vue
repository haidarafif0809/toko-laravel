<style scoped>
   .shadow {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<template>
    <div class="container" >
        <ol class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
            <li><router-link :to="{name: 'indexProduk'}" >Produk</router-link></li>
            <li class="active" >Edit Produk</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">Edit Produk {{ produk.nama_produk }}</div>
            <div class="panel-body">

                <form v-on:submit.prevent="saveForm()" class="form-horizontal"> 
                    <div class="form-group">
                        <label for="kode_produk" class="col-md-2 control-label">Kode Produk</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Kode Produk" type="text" v-model="produk.kode_produk" name="kode_produk"  autofocus="">
                            <span v-if="errors.kode_produk" class="label label-danger">{{ errors.kode_produk[0] }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nama_produk" class="col-md-2 control-label">Nama Produk</label>
                        <div class="col-md-4">
                            <input class="form-control" required autocomplete="off" placeholder="Name" type="text" v-model="produk.nama_produk" name="nama_produk"  autofocus="">
                            <span v-if="errors.nama_produk" class="label label-danger">{{ errors.nama_produk[0] }}</span>

                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="harga" class="col-md-2 control-label">Harga</label>
                        <div class="col-md-2">
                            <input class="form-control" required autocomplete="off" placeholder="Harga Beli" type="text" v-model="produk.harga_beli" name="harga_beli"  autofocus="">
                            <span v-if="errors.harga_beli" class="label label-danger">{{ errors.harga_beli[0] }}</span>

                        </div>
                        <div class="col-md-2">
                            <input class="form-control" required autocomplete="off" placeholder="Harga Jual" type="text" v-model="produk.harga_jual" name="harga_jual"  autofocus="">
                            <span v-if="errors.harga_jual" class="label label-danger">{{ errors.harga_jual[0] }}</span>

                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="satuans_id" class="col-md-2 control-label">Satuan</label>
                        <div class="col-md-4">
                            <selectize-component v-model="produk.satuans_id" :settings="setting_satuan"> 
                                <option v-for="satuan in satuans" v-bind:value="satuan.id" >{{ satuan.nama_satuan }}</option>
                            </selectize-component>
                            <span v-if="errors.satuans_id" class="label label-danger">{{ errors.satuans_id[0] }}</span>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kategori_produks_id" class="col-md-2 control-label">Kategori Produk</label>
                        <div class="col-md-4">
                            <selectize-component v-model="produk.kategori_produks_id" :settings="setting_kategori_produk"> 
                                <option v-for="kategori_produk in kategori_produks_id" v-bind:value="kategori_produk.id" >{{ kategori_produk.nama_kategori_produk }}</option>
                            </selectize-component>
                            <span v-if="errors.kategori_produks_id" class="label label-danger">{{ errors.kategori_produks_id[0] }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status_jual" class="col-md-2 control-label">Status Jual</label>
                        <div class="col-md-4">
                            <input type="radio" name="status_jual" v-model="produk.status_jual" value="1"> Aktif
                            <input type="radio" name="status_jual" v-model="produk.status_jual" value="0"> Tidak Aktif
                            <span v-if="errors.status_jual" class="label label-danger">{{ errors.status_jual[0] }}</span>

                        </div>
                    </div>
                    <div v-if="produk.foto != ''" class="form-group">
                        <label for="pratinjau_foto_produk" class="col-md-2 control-label">Pratinjau Foto</label>
                        <div v-if="produk.foto != null" class="col-md-4">
                            <div v-if="produk.foto.length > 100">
                                <img :src="produk.foto" class="img-responsive thumbnail shadow">
                            </div>
                            <div v-else>
                                <img :src="url_foto_produk +'/'+ produk.foto" class="img-responsive thumbnail shadow">
                            </div>
                        </div>
                        <div v-else class="col-md-4">
                            <img :src="broken_file" title="File yang Anda masukkan tidak didukung" class="img-responsive thumbnail shadow">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="foto" class="col-md-2 control-label">Foto</label>
                        <div class="col-md-4">
                            <input class="form-control" type="file" name="foto" v-on:change="onFileChange">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <div v-if="produk.foto != null">
                                <button class="btn btn-primary" id="btnSimpanproduk" type="submit">Submit</button>
                            </div>
                            <div v-else>
                                <button class="btn btn-primary" id="btnSimpanproduk" @click="broken_img" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            errors: [],
            satuans: [],
            kategori_produks_id: [],
            produkId: null,
            url : window.location.origin + (window.location.pathname).replace("home", "produk"),
            url_foto_produk: window.location.origin + (window.location.pathname).replace("home", "foto_produk"),
            broken_file : window.location.origin + (window.location.pathname).replace("home", "broken-image.png"),
            produk: {
                kode_produk: '',        
                nama_produk: '',
                harga_jual: '',
                harga_beli: '',
                satuans_id: '',
                kategori_produks_id: '',
                status_jual: '',
                foto: ''
            },
            message : '',
            setting_satuan: {
                placeholder: 'Pilih Satuan'
            },
            setting_kategori_produk: {
                placeholder: 'Pilih Kategori Produk'
            }
        } 
    },
    mounted(){
        var app = this;
        app.getData();
        app.selectedSatuan();
        app.selectedKategoriProduksId();
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return null;
            this.createImage(files[0]);
        },
        createImage(file) {
            let reader = new FileReader();
            let foto = this;
            let ekstensiOk = /(\.jpg|\.jpeg|\.png)/i;
            console.log(file);
            
            if(!file.name.match(ekstensiOk)) {
                foto.produk.foto = null;
                this.$swal({
                    title: "File tidak didukung!",
                    text: "Tolong pilih file gambar dengan format .jpg, .jpeg, atau .png.",
                    icon: "warning",
                    buttons: "Saya mengerti",
                });
            }
            else {
                reader.onload = (e) => {
                    foto.produk.foto = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        broken_img() {
            let anu = '';
            console.log();
            // let anu = 
            // this.$swal({
            //     title: "File tidak didukung!",
            //     text: "Tolong pilih file gambar dengan format .jpg, .jpeg, atau .png.",
            //     icon: "warning",
            //     buttons: "Saya mengerti",
            // });            
        },
        saveForm() {
            var app = this;
            var newProduk = app.produk;
            axios.patch(app.url+'/' + app.produkId, newProduk)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Menambah produk '+ app.produk.nama_produk;
                app.alert(app.message);
                app.produk.kode_produk = ''
                app.produk.nama_produk = ''
                app.produk.harga_jual = ''
                app.produk.harga_beli = ''
                app.produk.satuans_id = ''
                app.produk.kategori_produks_id = ''
                app.produk.status_jual = ''
                app.produk.foto = ''
                app.errors = '';
                app.$router.replace('/produk');

            })
            .catch(function (resp) {
                app.success = false;
                app.errors = resp.response.data.errors;
            });
        },
        selectedSatuan() {
            var app = this;
            axios.get(app.url+'/satuan')
            .then(function (resp) {
                app.satuans = resp.data;
            })
            .catch(function (resp) {
                alert("Could not load satuan");
            });
        },
        selectedKategoriProduksId() {
            var app = this;
            axios.get(app.url+'/kategori_produks_id')
            .then(function (resp) {
                app.kategori_produks_id = resp.data;
            })
            .catch(function (resp) {
                alert("Could not load kategori produk");
            });
        },
        alert(pesan) {
            this.$swal({
                title: "Berhasil!",
                text: pesan,
                icon: "success",
            });
        },
        getData(){
            let app = this;
            let id = app.$route.params.id;
            app.produkId = id;

            axios.get(app.url+'/' + id +'/edit')
            .then(function (resp) {
                app.produk = resp.data;
            })
            .catch(function () {
                alert("Could not load your produk");
            });
        }

    }
}
</script>
