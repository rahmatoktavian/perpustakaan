<a href="<?php echo site_url('api_client/rajaongkir');?>" class="btn btn-primary">
	<i class="fas fa-chevron-left"></i> Kembali
</a>
<br /><br />

<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Service</th>
			<th>Deskripsi</th>
			<th>Ongkir</th>
			<th>Durasi Kirim</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>

		<tr>
			<td colspan="5">JNE</td>
		</tr>
		<?php foreach($data_ongkir_jne as $ongkir_jne):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $ongkir_jne['service'];?></td>
			<td><?php echo $ongkir_jne['description'];?></td>
			<td><?php echo number_format($ongkir_jne['cost'][0]['value']);?></td>
			<td><?php echo $ongkir_jne['cost'][0]['etd'];?> Hari</td>
		</tr>
		<?php endforeach?>

		<tr>
			<td colspan="5">POS</td>
		</tr>
		<?php foreach($data_ongkir_pos as $ongkir_pos):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $ongkir_pos['service'];?></td>
			<td><?php echo $ongkir_pos['description'];?></td>
			<td><?php echo number_format($ongkir_pos['cost'][0]['value']);?></td>
			<td><?php echo $ongkir_pos['cost'][0]['etd'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

