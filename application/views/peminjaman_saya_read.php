<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Petugas</th>
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
			<td><?php echo $peminjaman['nama_petugas'];?></td>
			<td><?php echo $peminjaman['tanggal_pinjam'];?></td>
			<td><?php echo $peminjaman['tanggal_batas_kembali'];?></td>
			<td>
				<a href="<?php echo site_url('peminjaman_saya/read_buku/'.$peminjaman['id']);?>" class="btn btn-primary">
				<i class="fas fa-book"></i> Daftar Buku
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

