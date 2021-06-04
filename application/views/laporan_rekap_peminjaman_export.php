<?php
if($tipe_file == 'xls') {
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=".$_ci_view.".xls" );
}
?>

<table border="1">
	<thead>
		<tr>
			<th>Tanggal Pinjam</th>
			<th>Total Buku</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_laporan as $laporan):?>
		<tr>
			<td><?php echo $laporan['tanggal_pinjam'];?></td>
			<td><?php echo $laporan['total_buku'];?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>