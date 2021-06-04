<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $judul?></title>
</head>
<body>

<h1><?php echo $judul?></h1>

<a href="<?php echo site_url('kota/read/');?>">Pilih Kota Lain</a>
<br /><br />

<form method="post" action="<?php echo site_url('walikota/update_submit/'.$kota_id_url);?>">
	<table>
		<tr>
			<td>Nama Kota</td>
			<td>
				<?php echo $data_walikota_single['nama_kota'];?>
			</td>
		</tr>
		<tr>
			<td>Walikota</td>
			<td><input type="text" name="nama" value="<?php echo $data_walikota_single['nama'];?>" required=""></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" name="submit" value="Simpan"></td>
		</tr>
	</table>
</form>
<br /><br />

<form method="post" action="<?php echo site_url('walikota/update_fasilitas_submit/'.$kota_id_url);?>">
<table border="1">
	<thead>
		<tr>
			<th>Fasilitas</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_walikota_fasilitas as $walikota_fasilitas):?>
		<tr>
			<td><?php echo $walikota_fasilitas['nama_fasilitas'];?></td>
			<td>
				<select name="status[<?php echo $walikota_fasilitas['fasilitas_id'];?>]">
					<?php foreach($data_status_fasilitas as $status=>$keterangan):?>

						<?php if($status == $walikota_fasilitas['status']):?>
							<option value="<?php echo $status;?>" selected><?php echo $keterangan;?></option>
						<?php else:?>
							<option value="<?php echo $status;?>"><?php echo $keterangan;?></option>
						<?php endif;?>

					<?php endforeach;?>
				</select>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><input type="submit" name="submit" value="Simpan"></td>
		</tr>
	</tfoot>
</table>
</form>

<h3>Denda</h3>
<table border="1">
	<thead>
		<tr>
			<th>Jenis</th>
			<th>Qty</th>
			<th>Nominal</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data_walikota_denda as $walikota_denda):?>
		<tr>
			<td><?php echo $walikota_denda['jenis_denda'];?></td>
			<td><?php echo $walikota_denda['qty'];?></td>
			<td><?php echo number_format($walikota_denda['nominal']);?></td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

</body>
</html>