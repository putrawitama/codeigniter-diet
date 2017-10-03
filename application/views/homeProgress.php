<?php $this->load->view('./komponen/header');?>
<?php $this->load->view('./komponen/sidemenu');?>
		<div class="col-md-9 main" style="margin-top: 10px;">
			<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
			<?php if(isset($success)){?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-9 main" style="margin-top:20px;">
			<a class="float-right btn btn-success btn-sm" href="<?php echo site_url('progress/add/'.$customer) ?>">Tambah Program</a>
			<h4>Daftar Program Anda</h4>
			<hr>
		</div>
	</div>
	<?php if(!$progress == null){?>

		<?php 
		$idx = 0;
		foreach ($progress as $d) { 
		if($idx%3 == 0){?>
			<div class="row" style="margin-bottom: 15px;">
				<div class="col-md-3 main">
		<?php } else { ?>
				<div class="col-md-3">
		<?php 	} ?>
					<div class="card" style="border-color: #add4ad;">
					  <div class="card-body">
					  	<div class="float-right">
					  		<small><?php echo ($d->tanggal) ? date("d F Y", strtotime($d->tanggal)) : 'Belum Timbang' ; ?></small>
					  	</div>
					  	<h5 class="card-title">Program <?php echo $d->program ?> 
					  		<small>
					  			<?php echo ($d->status == 1) ? '<span class= "badge badge-pill badge-success">Aktif</span>' : '<span class= "badge badge-pill badge-danger">Non-Aktif</span>' ; ?>
					  		</small>
					  	</h5>
					  	<hr/>
					  	<div class=" w-100 justify-content-between">
					  		<p class="card-text">Tinggi: <?php echo $d->tinggi ?></p>
					  		<p class="card-text">Usia: <?php echo $d->usia ?></p>
					  		<p class="card-text">Target : <?php echo $d->target ?>kg</p>
						  	<p>Masalah : <?php echo $d->masalah ?></p>
					  	</div>
					  	<?php if ($d->status == 1) { ?>
					  		<div class="btn-group btn-block" style="">
						  		<a href="<?php echo site_url('timbang/add/'.$d->id_progress); ?>" class="btn btn-outline-success btn-group-block">Timbang</a>
						  		<a href="#" class="btn btn-success btn-group-block">Hasil</a>
						  	</div>
						  	<a href="<?php echo site_url('progress/finish/'.$d->id_progress); ?>" class="btn btn-danger btn-block">Selesai</a>
					  	<?php } else { ?>
					  		<a href="#" class="btn btn-success btn-block">Hasil</a>
					  	<?php } ?>
					  </div>
					</div>		
				</div>
			<?php 
			$idx++;
			if($idx%3 == 0){ ?>
			</div>
		<?php }} ?>

<?php } else { ?>
	<div class="alert alert-info">Tidak Ada Program</div>
<?php } ?>

</div>
<?php $this->load->view('./komponen/footer'); ?>