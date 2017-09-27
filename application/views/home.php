<?php $this->load->view('./komponen/header');?>
		<div class="col-12">
			<div class="card" style="margin-top:20px; border-color: #add4ad;">
			  <h4 class="card-header bg-success" style="color: white;">Daftar Customer</h4>
			  <div class="card-body">
			  	<?php if(isset($error)){?><div class="alert alert-danger"><?php echo $error; ?></div><?php } ?>
			  	<?php if(isset($success)){?><div class="alert alert-success"><?php echo $success; ?></div><?php } ?>
				<table class="table table-hover">
					<thead>
				    	<tr>
				    		<th>No</th>
					    	<th>ID</th>
					    	<th>Nama</th>
					    	<th>Nomor HP</th>
					    	<th>Email</th>
					    	<th>
					    		<a class="btn btn-primary btn-sm" href="<?php echo site_url('customer/add/'); ?>">Tambah Customer</a>
					    	</th>
					    </tr>
					</thead>
					<tbody>
					  	<?php $no = 1; foreach ($customer as $d) { ?>
					  		<tr>
						      <td scope="row"><?php echo $no ?></th>
						      <td><?php echo $d->id_customer ?></td>
						      <td><?php echo $d->nama.' '.$d->gelar ?></td>
						      <td><?php echo $d->hp ?></td>
						      <td><?php echo $d->email ?></td>
						      <td>
						      	<div class="btn-group" role="group">
						      		<a class="btn btn-outline-success btn-sm" href="<?php echo site_url('customer/edit/'.$d->id_customer); ?>">Edit</a>
						      		<a class="btn btn-danger btn-sm" href="<?php echo site_url('customer/delete/'.$d->id_customer); ?>">Delete</a>
								</div>
						      </td>
						    </tr>
					  	<?php $no++; } ?>
					</tbody>
				</table>
			  </div>
			</div>			
		</div>
<?php $this->load->view('./komponen/footer'); ?>
