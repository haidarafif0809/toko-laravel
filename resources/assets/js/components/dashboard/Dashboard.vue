<style type="text/css">
.ct-area{
  /*width: 10%;*/
}
.ct-series-a .ct-line {
  /* Set the colour of this series line */
  stroke: #578CA9;
  /*fill: hsl(120, 40%, 60%);*/
  /*Control the thikness of your lines */
  stroke-width: 5px;
  /* Create a dashed line with a pattern */
  stroke-dasharray: 10px 7px;
  stroke-linecap: square;
}

.ct-series-a .ct-area {
  fill: #578CA9;
}

.ct-series-a .ct-point {
  /* Colour of your points */
  stroke: #578CA9;
  /* Size of your points */
  stroke-width: 10px;
  /* Make your points appear as squares or round */
  stroke-linecap: square;
}

.ct-label {
  font-size: 10px;
}

#chartdiv {
  width : 100%;
  height  : 5000px;
}
.card {
  display: inline-block;
  position: relative;
  width: 100%;
  margin-top: 100px;
  /*border-radius: 10px;*/
  color: rgba(0,0,0, 0.87);
  background: #fff;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.card .header-primary {
  /*background: linear-gradient(60deg, #ab47bc, #7b1fa2);*/
  background: #578CA9;
}
.card .header-info {
  background: linear-gradient( #4C6A92);
}
/*color typografy*/
.card [class*="header-"] {
  color: #FFFFFF;
}

.card .header {
  /*box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);*/
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
  margin-bottom: 60px;
  margin-left: 15px;
  margin-right: 15px;
  margin-top: -30px;
  /*border-radius: 10px;*/
  padding: 10px 0;
  background-color: #FFFFFF;
}
h4 {
  padding-left: 20px;
}
/*.card-signup .text-divider {
  margin-top: 30px;
  margin-bottom: 0px;
  text-align: center;
}
.card-signup .content {
  padding: 0px 30px 0px 10px;
}
.card-nav-tabs .nav-tabs {
  background: transparent;
}
.card .content {
  padding: 15px;
}
.card .card-body {
  height: 30%;
  padding: 18px;
}
.card .card-footer {
  height: 10%;
  padding: 18px;
}
*/
</style>
<template>
  <div class="container">
    <div class="panel panel-default">
      <h4 class="panel-heading"><B>DASHBOARD</B></h4>
    </div>
    <div class="row">
      <div class="col-md-2">
        <p>{{ msg }}</p>
      </div>
      <div class="form-group col-md-2 ">
        <selectize-component class="form-control" v-model="filter.priode" :settings="placeholder_priode" id="pilih_priode"> 
          <option v-bind:value=0>Semua</option>                 
          <option v-bind:value=1>Hari ini</option>
          <option v-bind:value=2>7 hari terakhir</option>
          <option v-bind:value=3>30 hari terakhir</option>
          <option v-bind:value=4>1 tahun terakhir</option>
        </selectize-component>
      </div>
    </div>
    <div class="row">
      <div>
        <chartist ratio="ct-double-octave" type="Line" :data="chartData" :options="chartOptions" > </chartist>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card card-nav-tabs">
          <div class="header header-info">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Penjualan Produk Teratas</h4>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="profile">
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div class="col-md-4">
        <div class="card card-nav-tabs">
          <div class="header header-info">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Penjualan Per Kategori</h4>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="profile">
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>      
      <div class="col-md-4">
        <div class="card card-nav-tabs">
          <div class="header header-info">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <h4><i class="fa fa-area-chart" aria-hidden="true"></i> Nominal Penjualan Tertinggi</h4>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="profile">
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      filter:{
        priode:'',
        dari_tanggal:'',
        sampai_tanggal:''
      },
      placeholder_priode:{
        placeholder: 'PILIH PRIODE'
      },
      url : window.location.origin+(window.location.pathname).replace("home","laporan"),
      riwayat_penjualan: [],
      msg: 'Grafik Penjualan harian',
            // chart
            chartData: {
        // labels: ["A", "B", "C"],
        labels:[],
        series: [],
        // series: [[
        // {x: 1, y: 100},
        // {x: 2, y: 50},
        // {x: 3, y: 25},
        // {x: 5, y: 12.5},
        // {x: 8, y: 6.25}
        // ]]

      },
      chartOptions: {
        low: 0,
        // stretch: true,
        // fullWidth: true,
        showArea: true,
        lineSmooth: true,
        axisX: {
          // We can disable the grid for this axis
          showGrid: true,
          // and also don't show the label
          showLabel: true,
          // offset: 60,
        },
        // Y-Axis specific configuration
        axisY: {
          // Lets offset the chart a bit from the labels
          offset: 60,
          // The label interpolation function enables you to modify the values
          // used for the labels on each axis. Here we are converting the
          // values into million pound.
          labelInterpolationFnc: function(value) {
            return 'Qty ' + value;
          }
        }
      }
    }
  },
  mounted(){
    this.getRiwayatPenjualan();
  },
  watch: {
    'filter.priode': function(value) {
      this.submitPriode();
    }
  },
  methods: {
    submitPriode()
    {
      var app = this;
      app.filter.dari_tanggal = '';
      app.filter.sampai_tanggal = '';
      var filter = app.filter;
      app.getRiwayatPenjualan();
    },
    // menampilkan data simpan penjualan
    getRiwayatPenjualan() {
      var app = this;
      var filter = app.filter;
      axios.post(app.url+'/grafik-penjualan-harian', filter)
      .then(function (resp) {
        app.chartData.labels = resp.data.labels;
        app.chartData.series = resp.data.series;
        console.log(resp.data.series)
      })
      .catch(function (resp) {
        alert("Could not load riwayat_penjualan");
      });
    },
  }
}
</script>