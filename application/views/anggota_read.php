<a href="<?php echo site_url('anggota/insert');?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Jurusan</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_anggota as $anggota):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $anggota['nim'];?></td>
			<td><?php echo $anggota['nama'];?></td>
			<td><?php echo $anggota['jurusan'];?></td>
			<td>
				<a href="<?php echo site_url('anggota/update/'.$anggota['nim']);?>" class="btn btn-warning">
				<i class="fas fa-edit"></i> Ubah
				</a>
				
				<a href="<?php echo site_url('anggota/delete/'.$anggota['nim']);?>" onClick="return confirm('Anda yakin?')" class="btn btn-danger">
				<i class="fas fa-trash"></i> Hapus
				</a>
			</td>
		</tr>
		<?php endforeach?>
	</tbody>
</table>

