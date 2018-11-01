<!DOCTYPE html>
<html>
<head>
	<title>Form Registrasi</title>

	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
	<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
</head>
<body style="background-color: gray;">
<?php 
$hasil = $this->session->flashdata('hasil');
if ($hasil == "success") {
	$alert = "<div class='alert alert-success' role='alert'>Pendaftaran Berhasil</div>";
}elseif ($hasil == "fail") {
	$alert = "<div class='alert alert-danger' role='alert'>Pendaftaran Gagal</div>";
}else{
	$alert = "";
}
?>
	<div class="container mt-3">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('left-nav'); ?>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="card-body">
					<?php echo $alert; ?>
						<form method="post" action="<?php echo base_url().'registrasi/add'; ?>" enctype="multipart/form-data">
							<div class="form-group">
								<label>No Anggota</label>
								<input type="number" name="inputnoanggota" id="inputnoanggota" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Nama Lengkap</label>
								<input type="text" name="inputfullname" id="inputfullname" class="form-control" required autocomplete="off">
							</div>
							<div class="form-group">
								<label>No KTP</label>
								<input type="number" name="inputktp" id="inputktp" class="form-control" required>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tempat Lahir</label>
										<input type="text" name="inputtmplahir" id="inputtmplahir" class="form-control" required autocomplete="off">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" name="inputtgllahir" id="inputtgllahir" class="form-control" required>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Alamat Kantor</label>
								<input type="text" name="inputalmtkantor" id="inputalmtkantor" class="form-control" required autocomplete="off">
							</div>
							<div class="form-group">
								<label>Tlp Kantor</label>
								<input type="number" name="inputtlpkantor" id="inputtlpkantor" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Fax Kantor</label>
								<input type="number" name="inputfaxkantor" id="inputfaxkantor" class="form-control" required>
							</div>
							<div class="form-group">
								<label>No Hp</label>
								<input type="number" name="inputhp" id="inputhp" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="inputemail" id="inputemail" class="form-control" required autocomplete="off">
							</div>
							<div class="form-group">
								<label>Wilayah Kerja</label>
								<input type="text" name="inputwk" id="inputwk" class="form-control" required autocomplete="off">
							</div>
							<div class="form-group">
								<label>Foto</label>
								<input type="file" name="inputfoto" id="inputfoto" class="form-control-file" required accept=".gif,.jpg,.png,.PNG,.JPG,.JPEG">
							</div>
							<hr>
							<div class="form-group">
								<center>
									<button type="submit" name="btnregis" id="btnregis" class="btn btn-primary">Registrasi</button>
								</center>
								
							</div>
						</form>
					</div>
				</div>
				
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
	<!-- =================================================================================== -->
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jQuery v3.3.1.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> -->
</body>
</html>