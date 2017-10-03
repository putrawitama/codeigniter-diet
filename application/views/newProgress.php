<?php $this->load->view('./komponen/header');?>
<?php $this->load->view('./komponen/sidemenu');?>
		<div class="col-md-9 main">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Program Baru</h4>
			  <div class="card-body">
			  	<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
				<form method="post" action="<?php echo site_url('progress/postAdd/'.$customer->id_customer); ?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Nama<small class="isi">*</small> </label>
						<input type="username" class="form-control" placeholder="Nama" name="nama" value="<?php echo $customer->nama ?>" readonly="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tinggi<small class="isi">*</small></label>
						<input type="text" class="form-control" placeholder="Tinggi" name="tinggi" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Masalah<small class="isi">*</small> </label>
						<textarea class="form-control" id="exampleTextarea" rows="3" name="masalah"></textarea>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Usia<small class="isi">*</small> </label>
						<input type="text" class="form-control" placeholder="Usia" name="usia" value="<?php echo $usia ?>" required="true">
					</div>
					<label for="exampleInputEmail1">Program<small class="isi">*</small> </label>
					<div class="form-group">						
						<select class="form-control" id="exampleSelect1" name="program" required>
					      <option value="">Pilih program</option>
					      <option value="naik">Naik Berat Badan</option>
					      <option value="turun">Turun Berat Badan</option>
					      <option value="jaga">Jaga Berat Badan</option>
					      <option value="jagaKes">Jaga Kesehatn</option>
					    </select>
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