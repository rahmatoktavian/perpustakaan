<!--filter cari-->
<form method="post" action="<?php echo site_url('laporan/detail_peminjaman_cari/');?>">
<table class="table table-striped table-hover">
	<tr>
		<td>Anggota</td>
		<td>
			<select name="anggota_nim" class="form-control">
				<option value="-">Semua Anggota</option>
				<?php foreach($data_anggota as $anggota):?>
					<?php if($search_param['anggota_nim'] == $anggota['nim']):?>
					<option value="<?php echo $anggota['nim'];?>" selected>
						<?php echo $anggota['nama'];?>	
					</option>
					<?php else:?>
					<option value="<?php echo $anggota['nim'];?>">
						<?php echo $anggota['nama'];?>	
					</option>
					<?php endif;?>
				<?php endforeach;?>
			</select>
		</td>
	</tr>
	<tr>
		<td width="20%">Nama Anggota</td>
		<td><input type="text" name="anggota_nama" value="<?php echo $search_param['anggota_nama'];?>" class="form-control"></td>
	</tr>
	<tr>
		<td width="20%">Tanggal Pinjam Mulai</td>
		<td><input type="date" name="tanggal_pinjam_start" value="<?php echo $search_param['tanggal_pinjam_start'];?>" class="form-control"></td>
	</tr>
	<tr>
		<td>Tanggal Pinjam Akhir</td>
		<td><input type="date" name="tanggal_pinjam_end" value="<?php echo $search_param['tanggal_pinjam_end'];?>" class="form-control"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" name="search" value="Search" class="btn btn-primary" required=""></td>
	</tr>
	</table>
</form>
<!--end filter cari-->

<table class="table table-striped">
	<thead class="thead-dark">
		<tr>
			<th>Anggota</th>
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

<a href="<?php echo site_url('laporan/detail_peminjaman_export/xls');?>" class="btn btn-success">
<i class="fa fa-download"></i> Excel
</a>

<a href="<?php echo site_url('laporan/detail_peminjaman_export/pdf');?>" class="btn btn-danger">
<i class="fa fa-download"></i> PDF
</a>