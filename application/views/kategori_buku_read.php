<a href="<?php echo site_url('kategori_buku/insert');?>" class="btn btn-primary">
	<i class="fas fa-plus"></i> Tambah
</a>
<br /><br />

<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($data_kategori_buku as $kategori_buku):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $kategori_buku['nama'];?></td>
			<td>
				<a href="<?php echo site_url('kategori_buku/update/'.$kategori_buku['id']);?>" class="btn btn-warning">
				<i class="fas fa-edit"></i> Ubah
				</a>
				
				<a href="<?php echo site_url('kategori_buku/delete/'.$kategori_buku['id']);?>" onClick="return confirm('Anda yakin?')" class="btn btn-danger">
				<i class="fas fa-trash"></i> Hapus
				</a>
			</td>
		</tr>
		<?php endforeach?>		
	</tbody>
</table>

