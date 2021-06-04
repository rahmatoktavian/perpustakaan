<form method="post" action="<?php echo site_url('buku/update_submit/'.$data_buku_single['id']);?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>Kategori</td>
			<td>
				<select name="kategori_id" class="form-control">
					<?php foreach($data_kategori as $kategori):?>

					<?php if($kategori['id'] == $data_buku_single['kategori_id']):?>
					<option value="<?php echo $kategori['id'];?>" selected>
						<?php echo $kategori['nama'];?>	
					</option>
					<?php else:?>
					<option value="<?php echo $kategori['id'];?>">
						<?php echo $kategori['nama'];?>	
					</option>
					<?php endif;?>
					
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Cover</td>
			<td>
				<!--input untuk memilih file yang akan diupload-->
				<input type="file" name="cover" size="20" class="form-control-file" />

				<?php if($data_buku_single['cover'] != ''):?>
				<br />
				<img src="<?php echo base_url('upload/'.$data_buku_single['cover']);?>" width="100" />
				<?php endif;?>
			</td>
		</tr>
		<tr>
			<td>Judul</td>
			<td><input type="text" name="judul" value="<?php echo $data_buku_single['judul'];?>" class="form-control"  required=""></td>
		</tr>
		<tr>
			<td>Stok</td>
			<td><input type="number" name="stok" value="<?php echo $data_buku_single['stok'];?>" class="form-control"  required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>