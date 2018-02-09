<style type="text/css">
#chartdiv {
  width : 100%;
  height  : 5000px;
}
.card {
  display: inline-block;
  position: relative;
  width: 100%;
  margin-top: 100px;
  border-radius: 10px;
  color: rgba(0,0,0, 0.87);
  background: #fff;
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
}
.card .header-primary {
  background: linear-gradient(60deg, #ab47bc, #7b1fa2);
}
.card .header-info {
  background: linear-gradient(60deg, #29b6f6, #0288d1);
}
.card .header-success {
  background: linear-gradient(60deg, #66bb6a, #388e3c);
}
.card .header-warning {
  background: linear-gradient(60deg, #fdd835, #fbc02d);
}
.card .header-danger {
  background: linear-gradient(60deg, #ef5350, #d32f2f);
}
.card [class*="header-"] {
  color: #FFFFFF;
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
.card .header {
  box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
  margin-bottom: 60px;
  margin-left: 15px;
  margin-right: 15px;
  margin-top: -30px;
  border-radius: 10px;
  padding: 10px 0;
  background-color: #FFFFFF;
}
h4 {
  padding-left: 20px;
}
</style>
<template>
  <div class="container">
    <div class="panel panel-default">
      <h4 class="panel-heading"><B>DASHBOARD</B></h4>
    </div>
    <div class="row">
      <div class="">
        <p>{{ msg }}</p>
        <line-chart></line-chart>
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
                <h1><chartjs-horizontal-bar></chartjs-horizontal-bar></h1>
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
                <h1><chartjs-polar-area></chartjs-polar-area></h1>
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
                <h1><chartjs-horizontal-bar></chartjs-horizontal-bar></h1>
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
      msg: 'Laporan Penjualan per hari'
    }
  },
}
</script>