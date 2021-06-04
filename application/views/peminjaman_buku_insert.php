<form method="post" action="<?php echo site_url('peminjaman_buku/insert_submit/'.$peminjaman_id);?>">
	<table class="table table-striped">
		<tr>
			<td>Anggota</td>
			<td>
				<select name="buku_id" class="form-control">
					<?php foreach($data_buku as $buku):?>
					<option value="<?php echo $buku['id'];?>">
						<?php echo $buku['judul'];?>	
					</option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>