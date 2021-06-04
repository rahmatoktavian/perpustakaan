<a href="<?php echo site_url('peminjaman/read/');?>" class="btn btn-warning">
	<i class="fas fa-chevron-left"></i> Peminjaman Lain
</a>
<br /><br />

<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<td width="20%">Nama</td>
			<td><strong><?php echo $data_peminjaman['nama_anggota'];?></strong></td>
		</tr>
		<tr>
			<td width="20%">Tanggal Pinjam</td>
			<td><strong><?php echo $data_peminjaman['tanggal_pinjam'];?></strong></td>
		</tr>
		<tr>
			<td width="20%">Batas Tanggal Kembali</td>
			<td><strong><?php echo $data_peminjaman['tanggal_batas_kembali'];?></strong></td>
		</tr>
	</tbody>
</table>

<a href="<?php echo site_url('peminjaman_buku/insert/'.$peminjaman_id);?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Buku</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_peminjaman_buku as $peminjaman_buku):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $peminjaman_buku['judul_buku'];?></td>
			<td>
				<a href="<?php echo site_url('peminjaman_buku/delete/'.$peminjaman_buku['peminjaman_id'].'/'.$peminjaman_buku['id']);?>" onClick="return confirm('Anda yakin?')" class="btn btn-danger">
				<i class="fas fa-trash"></i> Hapus
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>



