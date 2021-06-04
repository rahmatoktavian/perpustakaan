<form method="post" action="<?php echo site_url('buku/insert_submit/');?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>Kategori</td>
			<td>
				<select name="kategori_id" class="form-control">
					<?php foreach($data_kategori as $kategori):?>
					<option value="<?php echo $kategori['id'];?>">
						<?php echo $kategori['nama'];?>	
					</option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Cover</td>
			<td>
				<!--input untuk memilih file yang akan diupload-->
				<input type="file" name="cover" size="20" class="form-control-file" />
			</td>
		</tr>
		<tr>
			<td>Judul</td>
			<td><input type="text" name="judul" value="" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td><input type="number" name="stok" value="" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>