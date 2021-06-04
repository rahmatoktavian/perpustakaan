<form method="post" action="<?php echo site_url('kategori_buku/update_submit/'.$data_kategori_buku_single['id']);?>">
	<table class="table table-striped">
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" value="<?php echo $data_kategori_buku_single['nama'];?>" class="form-control"  required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>