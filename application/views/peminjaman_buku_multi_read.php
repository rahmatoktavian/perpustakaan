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
			<td><strong><?php echo $data_peminjaman['batas_tanggal_kembali'];?></strong></td>
		</tr>
	</tbody>
</table>

<a href="<?php echo site_url('peminjaman_buku/insert/'.$peminjaman_id);?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<form method="post" action="<?php echo site_url('peminjaman_buku/read_submit_multi/'.$peminjaman_id);?>">
<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th width="10%">Dipinjam</th>
			<th>Buku</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_buku as $buku):?>

		<?php /*
		if(!empty($list_buku_peminjaman_id[$buku['id']])) {
			$buku_dipinjam = 'checked';
		} else {
			$buku_dipinjam = '';
		}
		$nilai = !empty($list_buku_peminjaman_id[$buku['id']]) ? $list_buku_peminjaman_id[$buku['id']] : '';
		*/?>

		<!--check buku dipinjam atau belum-->
		<?php $buku_dipinjam = !empty($list_buku_peminjaman_id[$buku['id']]) ? 'checked' : '';?>
		<tr>
			<td>
				<input type="checkbox" name="buku_id[<?php echo $buku['id'];?>]" value="<?php echo $buku['id'];?>" size="20" <?php echo $buku_dipinjam;?> />
			</td>
			<td><?php echo $buku['judul'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2"><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</tfoot>
</table>
</form>

