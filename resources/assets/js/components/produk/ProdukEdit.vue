<style scoped>
.shadow {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<template>
    <div class="container" >
        <ul class="breadcrumb">
            <li><router-link :to="{name: 'indexDashboard'}" >Dashboard</router-link></li>
            <li><router-link :to="{name: 'indexProduk'}" >Produk</router-link></li>
            <li class="active" >Edit Produk</li>
        </ul>
        <div class="col-md-9 col-md-offset-1">
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
                            <label for="kategori_produks_id" class="col-md-2 control-label">Kategori Produk</label>
                            <div class="col-md-4">
                                <table width="100%">
                                    <tbody>
                                        <tr>
                                            <td width="80%" style="vertical-align: middle;">
                                                <selectize-component v-model="produk.kategori_produks_id" :settings="setting_kategori_produk"> 
                                                    <option v-for="kategori_produk in kategori_produks_id" v-bind:value="kategori_produk.id" >{{ kategori_produk.nama_kategori_produk }}</option>
                                                </selectize-component> 
                                            </td>
                                            <td width="20%" style="vertical-align: top; text-align: center;">
                                                <span @click="tambahKategori()" class="glyphicon glyphicon-plus btn btn-sm btn-default">Tambah</span>   
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>


                                <span v-if="errors.kategori_produks_id" class="label label-danger">{{ errors.kategori_produks_id[0] }}</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-md-2 control-label">Harga Beli</label>
                            <div class="col-md-2">
                                <input class="form-control" required autocomplete="off" placeholder="Harga Beli" type="text" v-model="produk.harga_beli" name="harga_beli"  autofocus="">
                                <span v-if="errors.harga_beli" class="label label-danger">{{ errors.harga_beli[0] }}</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="harga" class="col-md-2 control-label">Harga Jual</label>
                            <div class="col-md-2">
                                <input class="form-control" required autocomplete="off" placeholder="Harga Jual" type="text" v-model="produk.harga_jual" name="harga_jual"  autofocus="">
                                <span v-if="errors.harga_jual" class="label label-danger">{{ errors.harga_jual[0] }}</span>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status_jual" class="col-md-2 control-label">Bisa Dijual</label>
                            <div class="col-md-4 margin-atas">
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="status_jual" v-model="produk.status_jual" value="1"> Ya
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="radio" name="status_jual" v-model="produk.status_jual" value="0"> Tidak
                                    </label>
                                    <span v-if="errors.status_jual" class="label label-danger">{{ errors.status_jual[0] }}</span>
                                </div>
                            </div>
                        </div>
                        <div v-if="produk.foto !== null && produk.foto != ''" class="form-group">
                            <label for="pratinjau_foto_produk" class="col-md-2 control-label">Pratinjau Foto</label>
                            <div class="col-md-4">
                                <div v-if="produk.foto.length > 100">
                                    <img :src="produk.foto" class="img-responsive thumbnail shadow">
                                </div>
                                <div v-else>
                                    <img :src="url_foto_produk +'/'+ produk.foto" class="img-responsive thumbnail shadow">
                                </div>
                            </div>
                            <div v-if="produk.foto == ''" class="col-md-4">
                                <img :src="broken_file" title="File yang Anda masukkan tidak didukung" class="img-responsive thumbnail shadow">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="foto" class="col-md-2 control-label">Foto</label>
                            <div class="col-md-4">
                                <input class="form-control" type="file" name="foto" v-on:change="onFileChange" id="image">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="modifier" class="col-md-2 control-label"></label>
                            <div class="col-md-4">
                                <div>
                                    <b-form-checkbox v-if="" id="checkbox1" v-model="status_modifier" value="accepted" unchecked-value="not_accepted" style="cursor:pointer" checked="true">
                                      Tambahan & Pilhan Produk
                                  </b-form-checkbox>
                                  <div v-if="status_modifier == 'accepted'">
                                    <selectize-component v-model="produk.produk_modifier_id" :settings="setting_produk_modifier"> 
                                        <option v-for="produk_modifier in produk_modifier_id" v-bind:value="produk_modifier.id" >{{ produk_modifier.nama_modifier }}</option>
                                    </selectize-component>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-4 col-md-offset-2">
                            <div v-if="produk.foto != null">
                                <button class="btn btn-primary" id="btnSimpanproduk" type="submit">Submit</button>
                            </div>
                            <div v-else>
                                <button class="btn btn-primary" id="btnSimpanproduk" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data: function () {
        return {
            status_modifier: '',
            errors: [],
            kategori_produks_id: [],
            produk_modifier_id: [],
            produkId: null,
            url : window.location.origin + (window.location.pathname).replace("home", "produk"),
            url_foto_produk: window.location.origin + (window.location.pathname).replace("home", "foto_produk"),
            broken_file : window.location.origin + (window.location.pathname).replace("home", "broken-image.png"),
            url_newKategoriProduk : window.location.origin+(window.location.pathname).replace("home", "kategoriProduk"),
            produk: {
                kode_produk: '',
                nama_produk: '',
                harga_jual: '',
                harga_beli: '',
                kategori_produks_id: '',
                status_jual: '',
                foto: '',
                produk_modifier_id: ''
            },
            newKategoriProduk: {
                nama_kategori_produk: ''
            },
            message : '',
            setting_satuan: {
                placeholder: 'Pilih Satuan'
            },
            setting_kategori_produk: {
                placeholder: 'Pilih Kategori Produk'
            },
            setting_produk_modifier:{
                placeholder: 'Pilih Tambahan',
            }
        }
    },
    mounted(){
        var app = this;
        app.getData();
        app.selectedKategoriProduksId();
        app.selectedProdukModifierId();
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

            if(!file.name.match(ekstensiOk)) {
                foto.produk.foto = null;
                this.$swal({
                    title: "File tidak didukung!",
                    text: "Pilih file gambar dengan format .jpg, .jpeg, atau .png.",
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
        saveForm() {
            var app = this;
            console.log(app.produk);
            // var newProduk = app.produk;
            var image = document.getElementById('image');

            if (image.value == '') {
                app.produk.foto = null;
            }
            axios.patch(app.url+'/' + app.produkId, app.produk)
            .then(function (resp) {
                app.message = 'Sukses : Berhasil Mengedit produk '+ app.produk.nama_produk;
                app.alert(app.message);
                app.$router.replace('/produk');

            })
            .catch(function (resp) {
                app.success = false;
                app.errors = resp.response.data.errors;
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
                if (app.produk.foto == null) {
                    app.produk.foto = '';
                };

                if (resp.data.produk_modifier_id > 0) {
                    app.status_modifier = 'accepted';
                }
                else{
                    app.status_modifier = 'not_accepted';
                }
            })
            .catch(function () {
                alert("Could not load your produk");
            });
        },
        tambahKategori() {
            var app = this;
            swal({
                title: 'Tambah Kategori Produk',
                input: 'text',
                inputPlaceholder: 'Masukkan nama kategori produk yang baru',
                showCancelButton: true,
                allowOutsideClick: false,
                reverseButtons: true,
                inputValidator: (nama_kategori_produk) => {
                    return new Promise((resolve) => {
                        if (!nama_kategori_produk) {
                            return resolve('Nama kategori produk tidak boleh kosong!');     
                        }
                        return resolve();
                    })
                }
            })
            .then(nama_kategori_produk => {
                if (nama_kategori_produk.value) {
                    console.log(app.newKategoriProduk)
                    app.newKategoriProduk.nama_kategori_produk = nama_kategori_produk.value;
                    var newNamaKategori = app.newKategoriProduk;

                    axios.post(app.url_newKategoriProduk, newNamaKategori)
                    .then(function (resp) {
                        app.selectedKategoriProduksId();    
                        swal({
                            title: "Berhasil!",
                            type: 'success',
                            text: 'Berhasil menambahkan "'+ nama_kategori_produk.value +'" ke kategori produk.',
                        });
                    })
                    .catch(function (resp) {
                        console.log(resp)
                        swal({
                            title: "Gagal!",
                            type: 'warning',
                            text: 'Ada sesuatu yang salah terjadi.',
                        });
                    });
                }
            })
            .catch(function (resp) {
                console.log(resp)
                swal("Ups.. Ada yang tidak beres.", "Pembuatan kategori produk gagal!", "error");
            });
        },
        selectedProdukModifierId() {
            var app = this;
            axios.get(app.url+'/produk-modifier-id')
            .then(function (resp) {
                app.produk_modifier_id = resp.data;
            })
            .catch(function (resp) {
                alert("Could not load produk modifier");
            });
        }

    }
}
</script>