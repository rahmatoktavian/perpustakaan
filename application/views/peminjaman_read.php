<a href="<?php echo site_url('peminjaman/insert');?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Anggota</th>
			<th>Tanggal Pinjam</th>
			<th>Batas Tanggal Kembali</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_peminjaman as $peminjaman):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $peminjaman['nama_anggota'];?></td>
			<td><?php echo $peminjaman['tanggal_pinjam'];?></td>
			<td><?php echo $peminjaman['tanggal_batas_kembali'];?></td>
			<td>
				<a href="<?php echo site_url('peminjaman_buku/read/'.$peminjaman['id']);?>" class="btn btn-primary">
				<i class="fas fa-book"></i> Buku
				</a>

				<a href="<?php echo site_url('peminjaman/update/'.$peminjaman['id']);?>" class="btn btn-warning">
				<i class="fas fa-edit"></i> Ubah
				</a>
				
				<a href="<?php echo site_url('peminjaman/delete/'.$peminjaman['id']);?>" onClick="return confirm('Anda yakin?')" class="btn btn-danger">
				<i class="fas fa-trash"></i> Hapus
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>



