<?php $this->load->view('./komponen/header');?>
<?php $this->load->view('./komponen/sidemenu');?>
		<div class="col-md-9 main">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Edit Customer <?php echo $d->id_customer ?></h4>
			  <div class="card-body">
				<form method="post" action="<?php echo site_url('customer/postEdit/'.$d->id_customer); ?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Nama<small class="isi">*</small> </label>
						<input type="username" class="form-control" placeholder="Nama" name="nama" value="<?php echo $d->nama ?>" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Gelar</label>
						<input type="text" class="form-control" placeholder="Contoh: S.Kom., M.Kom." name="gelar" value="<?php echo $d->gelar ?>" data-role="tagsinput">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Tgl Lahir<small class="isi">*</small> </label>
						<input type="date" class="form-control" name="lahir" value="<?php echo $d->tgl_lahir ?>" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Telepon Rumah</label>
						<input type="tel" class="form-control" placeholder="Telepon Rumah" name="tlp" value="<?php echo $d->telepon ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">HP<small class="isi">*</small> </label>
						<input type="tel" class="form-control" placeholder="Nomor HP" name="hp" value="<?php echo $d->hp ?>" required="true">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email<small class="isi">*</small> </label>
						<input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $d->email ?>" required="true">
					</div>
					<label for="exampleInputEmail1">Gender<small class="isi">*</small> </label>
					<div class="form-group">
						<label class="custom-control custom-radio">
							<input name="gender" type="radio" class="custom-control-input" value="L" <?php echo ($d->gender == 'L' ? 'checked="checked"' : '') ?>" required="true">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Pria</span>
						</label>
						<label class="custom-control custom-radio">
							<input name="gender" type="radio" class="custom-control-input" value="P" <?php echo ($d->gender == 'P' ? 'checked="checked"' : '') ?>" required="true">
							<span class="custom-control-indicator"></span>
							<span class="custom-control-description">Wanita</span>
						</label>
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
