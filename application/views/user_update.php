<form method="post" action="<?php echo site_url('user/update_submit/'.$data_user_single['id']);?>">
	<table class="table table-striped">
		<tr>
			<td>Type</td>
			<td>
				<select name="type" class="form-control">
					<?php foreach($data_type as $type):?>
					
					<?php if($type == $data_user_single['type']):?>
					<option value="<?php echo $type;?>" selected>
						<?php echo $type;?>	
					</option>
					<?php else:?>
					<option value="<?php echo $type;?>">
						<?php echo $type;?>	
					</option>
					<?php endif;?>

					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Petugas</td>
			<td>
				<select name="petugas_id" class="form-control">
					<option value="">Bukan User Petugas</option>
					<?php foreach($data_petugas as $petugas):?>

					<?php if($petugas['id'] == $data_user_single['petugas_id']):?>
					<option value="<?php echo $petugas['id'];?>" selected>
						<?php echo $petugas['id'];?> - <?php echo $petugas['nama'];?>	
					</option>
					<?php else:?>
					<option value="<?php echo $petugas['id'];?>">
						<?php echo $petugas['id'];?> - <?php echo $petugas['nama'];?>	
					</option>
					<?php endif;?>

					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Anggota</td>
			<td>
				<select name="nim" class="form-control">
					<option value="">Bukan User Anggota</option>
					<?php foreach($data_anggota as $anggota):?>

					<?php if($anggota['nim'] == $data_user_single['nim']):?>
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
			<td>Username</td>
			<td><input type="text" name="username" value="<?php echo $data_user_single['username'];?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" value="<?php echo $data_user_single['nama'];?>" class="form-control" required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button></td>
		</tr>
	</table>
</form>