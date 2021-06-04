<form method="post" action="<?php echo site_url('api_client/rajaongkir_search/');?>" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<td>Kota Asal</td>
			<td>
				<select name="kota_asal_id" class="form-control">
					<?php foreach($data_kota_asal as $kota_asal):?>
					<option value="<?php echo $kota_asal['city_id'];?>">
						<?php echo $kota_asal['city_name'];?>	
					</option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>Kota Tujuan</td>
			<td>
				<select name="kota_tujuan_id" class="form-control">
					<?php foreach($data_kota_tujuan as $kota_tujuan):?>
					<option value="<?php echo $kota_tujuan['city_id'];?>">
						<?php echo $kota_tujuan['city_name'];?>	
					</option>
					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cek Ongkir</button></td>
		</tr>
	</table>
</form>