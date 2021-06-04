<form method="post" action="<?php echo site_url('peminjaman/update_submit/'.$data_peminjaman_single['id']);?>">
	<table class="table table-striped">
		<tr>
			<td>Anggota</td>
			<td>
				<select name="nim" class="form-control">
					<?php foreach($data_anggota as $anggota):?>

					<?php if($anggota['nim'] == $data_peminjaman_single['nim']):?>
					<option value="<?php echo $anggota['nim'];?>" selected>
						<?php echo $anggota['nim'];?> - <?php echo $anggota['nama'];?>	
					</option>
					<?php else:?>
					<option value="<?php echo $anggota['nim'];?>">
						<?php echo $anggota['nim'];?> - <?php echo $anggota['nama'];?>	
					</option>
					<?php endif;?>

					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tanggal Pinjam</td>
			<td><input type="date" name="tanggal_pinjam" value="<?php echo $data_peminjaman_single['tanggal_pinjam'];?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Batas Tanggal Kembali</td>
			<td><input type="date" name="tanggal_batas_kembali" value="<?php echo $data_peminjaman_single['tanggal_batas_kembali'];?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>