<style scoped>
.row{
	border-color:#FDA698;
}
</style>
<template>
	<div class="container-fluid">
		<ul class="breadcrumb">
			<li><router-link :to="{name: 'indexDashboard'}">Home</router-link></li>
			<li><router-link :to="{name: 'indexGerai'}">Gerai</router-link></li>
			<li class="active">Tambah Gerai</li>
		</ul>

		<div class="panel panel-default">	
			<div class="panel-heading">
				<p class="panel-title">Tambah Gerai</p>
			</div>
			<div class="panel-body">
				<form  v-on:submit.prevent="saveForm()" class="form-horizontal">
					<div class="form-group">
						<label class="col-md-2 control-label">Nama Gerai</label>
						<div class="col-md-4">
							<input type="text" name="Nama Gerai" placeholder="Nama Gerai" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">Alamat</label>
						<div class="col-md-4">
							<input type="text" name="Alamat" placeholder="Alamat" 
							class="form-control">
						</div>
					</div>


					<div class="form-group">
						<label class="col-md-2 control-label">Kota</label>
						<div class="col-md-4">
							<input type="text" name="Kota" placeholder="Kota" class="form-control">
						</div>
					</div>



					<div class="form-group">
						<label class="col-md-2 control-label">Nomor Telepon 1</label>
						<div class="col-md-4">
							<input type="number" name="no_telepon_1" placeholder="Nomor telepon 1" class="form-control">
						</div>
					</div>



					<div class="form-group">
						<label class="col-md-2 control-label">Nomor Telepon 2</label>
						<div class="col-md-4">
							<input type="number" name="nomor_telepon_2" placeholder="Nomor Telepon 2" class="form-control">
						</div>
					</div>



					<div class="form-group">
						<label class="col-md-2 control-label">Notes</label>
						<div class="col-md-4">
							<input type="text" name="notes" placeholder="Notes" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">Nama Pajak</label>
						<div class="col-md-4">
							<input type="text" name="Kota" placeholder="Nama Pajak" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">Rasio Pajak</label>
						<div class="col-md-4">
							<input type="text" name="Kota" placeholder="%" class="form-control">
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-2 control-label">Modul Yang Diaktifkan ditempat ini:</label>
						<div class="col-md-4">
							<input type="checkbox"><strong>Meja</strong>
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-4 col-md-offset-2">
							<button class="btn btn-primary" id="" type="submit">Submit</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>

</template>