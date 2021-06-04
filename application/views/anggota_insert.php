<form method="post" action="<?php echo site_url('anggota/insert_submit/');?>">
	<table class="table table-striped">
		<tr>
			<td>NIM</td>
			<td>
				<input type="number" name="nim" value="" class="form-control" required="">
				<small>Min. 3 digit</small>
			</td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" value="" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td>
				<input type="radio" name="jurusan" value="Teknik Informatika" required="" checked=""> Teknik Informatika
				<input type="radio" name="jurusan" value="Sistem Informasi" required=""> Sistem Informasi
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>