<a href="<?php echo site_url('user/insert');?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Username</th>
			<th>Type</th>
			<th>Petugas ID</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_user as $user):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $user['username'];?></td>
			<td><?php echo $user['type'];?></td>
			<td><?php echo $user['petugas_id'];?></td>
			<td><?php echo $user['nim'];?></td>
			<td><?php echo $user['nama'];?></td>
			<td>
				<a href="<?php echo site_url('user/update/'.$user['id']);?>" class="btn btn-warning">
				<i class="fas fa-edit"></i> Ubah
				</a>
				
				<a href="<?php echo site_url('user/delete/'.$user['id']);?>" onClick="return confirm('Anda yakin?')" class="btn btn-danger">
				<i class="fas fa-trash"></i> Hapus
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

