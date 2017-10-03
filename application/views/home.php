<?php $this->load->view('./komponen/header');?>
		<div class="col-12">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Daftar Customer</h4>
			  <div class="card-body">
			  	<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
			  	<?php if(isset($success)){?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
			  	<div class="float-left">
			  		<a class="btn btn-success" href="<?php echo site_url('customer/add/'); ?>">Tambah Customer</a>
			  	</div>
			  	<form method="post" action="<?php echo site_url('customer/cari/'); ?>">
			  		<div class="input-group col-4 float-right search">
				  		<input type="text" class="form-control" placeholder="ID, Nama, Email" name="q">
						<span class="input-group-btn">
							<button class="btn btn-outline-success" type="submit">Cari</button>
						</span>
					</div>
			  	</form>
				<table class="table table-hover">
					<thead>
				    	<tr>
				    		<th>No</th>
					    	<th>ID</th>
					    	<th>Nama</th>
					    	<th>Gender</th>
					    	<th>Nomor HP</th>
					    	<th>Email</th>
					    	<th></th>
					    </tr>
					</thead>
					<tbody>
					  	<?php $no = 1; foreach ($customer as $d) { ?>
					  		<tr>
						      <td scope="row"><?php echo $no ?></th>
						      <td><?php echo $d->id_customer ?></td>
						      <td><?php echo $d->nama.' '.$d->gelar ?></td>
						      <td class="text-center"><?php echo $d->gender ?></td>
						      <td><?php echo $d->hp ?></td>
						      <td><?php echo $d->email ?></td>
						      <td class="text-center">
						      	<div class="btn-group" role="group">
						      		<a class="btn btn-outline-success btn-sm" href="<?php echo site_url('progress/all/'.$d->id_customer); ?>">Program</a>
						      		<a class="btn btn-outline-success btn-sm" href="<?php echo site_url('customer/edit/'.$d->id_customer); ?>">Edit</a>
						      		<a class="btn btn-danger btn-sm" href="<?php echo site_url('customer/delete/'.$d->id_customer); ?>">Delete</a>
								</div>
						      </td>
						    </tr>
					  	<?php $no++; } ?>
					</tbody>
				</table>
				<nav>
					<?php echo $halaman ?>
				</nav>
			  </div>
			</div>			
		</div>
<?php $this->load->view('./komponen/footer'); ?>
