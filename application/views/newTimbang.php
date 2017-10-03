<?php $this->load->view('./komponen/header');?>
		<div class="col-12">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Timbang ke <?php echo $timbang; ?></h4>
			  <div class="card-body">
			  	<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
				<form method="post" action="<?php echo site_url('timbang/postAdd/'.$progress->id_progress); ?>">
					<div class="form-group">
						<label for="exampleInputEmail1">Berat Badan<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="berat" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Lemak Tubuh (Body Fat)<small class="isi">*</small></label>
						<input type="text" class="form-control" name="tubuh" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Kepadatan Tulang (Bon Mass)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="tulang" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Kadar Air (Body Water)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="air" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Massa Otot (Muscle Mass)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="otot" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Ratting Fisik (Physsique Rating)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="fisik" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Kebutuhan Kalori (BMR)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="kalori" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Usia Sel (Metabolic Age)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="sel" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Lemak Perut (Visceral Fat)<small class="isi">*</small> </label>
						<input type="text" class="form-control" name="perut" required>
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