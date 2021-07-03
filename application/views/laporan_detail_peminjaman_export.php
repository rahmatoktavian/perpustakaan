<?php
if($tipe_file == 'xls') {
	header( "Content-Type: application/vnd.ms-excel" );
	header( "Content-disposition: attachment; filename=".$_ci_view.".xls" );
}
?>

<table border="1">
	<thead>
		<tr>
			<th>Nama Anggota</th>
			<th>Tanggal Pinjam</th>
			<th>Batas Tanggal Kembali</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_laporan as $laporan):?>
		<tr>
			<td><?php echo $laporan['nama_anggota'];?></td>
			<td><?php echo $laporan['tanggal_pinjam'];?></td>
			<td><?php echo $laporan['tanggal_batas_kembali'];?></td>
		</tr>
		<?php endforeach?>	
	</tbody>
</table>