<?php $this->load->view('./komponen/header');?>
		<div class="col-12">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Tambah Customer</h4>
			  <div class="card-body">
			  	<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
				<form method="post" action="<?php echo site_url('customer/postAdd'); ?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Nama<small class="isi">*</small> </label>
						<input type="username" class="form-control" placeholder="Nama" name="nama" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gelar</label>
						<input type="text" class="form-control" placeholder="Contoh: S.Kom., M.Kom." name="gelar">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tgl Lahir<small class="isi">*</small> </label>
						<input type="date" class="form-control" name="lahir" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Telepon Rumah</label>
						<input type="tel" class="form-control" placeholder="Telepon Rumah" name="tlp">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">HP<small class="isi">*</small> </label>
						<input type="tel" class="form-control" placeholder="Nomor HP" name="hp" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email<small class="isi">*</small> </label>
						<input type="email" class="form-control" placeholder="Email" name="email" required="true">
					</div>
					<div class="form-group">
						<small class="isi">* (Wajib diisi)</small>
					</div>
					<button type="submit" class="btn btn-success">Simpan</button>
				</form>
			  </div>
			</div>			
		</div>
<?php $this->load->view('./komponen/footer'); ?>
