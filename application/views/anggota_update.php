<form method="post" action="<?php echo site_url('anggota/update_submit/'.$data_anggota_single['nim']);?>">
	<table class="table table-striped">
		<tr>
			<td>NIM</td>
			<td><input type="text" name="nim" value="<?php echo $data_anggota_single['nim'];?>" class="form-control" disabled=""></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" value="<?php echo $data_anggota_single['nama'];?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td>
				<?php if($data_anggota_single['jurusan'] == 'Teknik Informatika'):?>
					<input type="radio" name="jurusan" value="Teknik Informatika" required="" checked=""> Teknik Informatika
					<input type="radio" name="jurusan" value="Sistem Informasi" required=""> Sistem Informasi
				<?php else:?>
					<input type="radio" name="jurusan" value="Teknik Informatika" required=""> Teknik Informatika
					<input type="radio" name="jurusan" value="Sistem Informasi" required="" checked=""> Sistem Informasi
				<?php endif;?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>