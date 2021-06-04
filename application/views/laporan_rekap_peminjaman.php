<table class="table table-striped">
	<thead class="thead-dark">
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

<a href="<?php echo site_url('laporan/rekap_peminjaman_export/xls');?>" class="btn btn-success">
<i class="fa fa-download"></i> Excel
</a>

<a href="<?php echo site_url('laporan/rekap_peminjaman_export/pdf');?>" class="btn btn-danger">
<i class="fa fa-download"></i> PDF
</a>