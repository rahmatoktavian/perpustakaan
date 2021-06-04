<a href="<?php echo site_url('peminjaman_saya/read');?>" class="btn btn-primary">
	<i class="fas fa-chevron-left"></i> Peminjaman Lain
</a>
<br /><br />

<table class="table table-striped table-hover">
	<tbody>
		<tr>
			<td width="20%">Tanggal Pinjam</td>
			<td><?php echo $data_peminjaman['tanggal_pinjam'];?></td>
		</tr>
		<tr>
			<td width="20%">Batas Tanggal Kembali</td>
			<td><?php echo $data_peminjaman['tanggal_batas_kembali'];?></td>
		</tr>
	</tbody>
</table>



<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Judul Buku</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_peminjaman_buku as $peminjaman_buku):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $peminjaman_buku['judul_buku'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

