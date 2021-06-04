<form method="post" action="<?php echo site_url('peminjaman/insert_submit/');?>">
	<table class="table table-striped">
		<tr>
			<td>Anggota</td>
			<td>
				<select name="nim" class="form-control">
					<?php foreach($data_anggota as $anggota):?>
					<option value="<?php echo $anggota['nim'];?>">
						<?php echo $anggota['nim'];?> - <?php echo $anggota['nama'];?>	
					</option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Tanggal Pinjam</td>
			<td><input type="date" name="tanggal_pinjam" value="<?php echo date('Y-m-d');?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Batas Tanggal Kembali</td>
			<td><input type="date" name="tanggal_batas_kembali" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d'). ' +7 days'));?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>