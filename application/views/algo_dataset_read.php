<h4>Dataset</h4>
<table class="table table-striped table-hover" id="datatables">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>gender</th>
			<th>status_mhs</th>
			<th>status_nikah</th>
			<th>status_lulus</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($algo_dataset_list as $dataset):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $dataset['gender'];?></td>
			<td><?php echo $dataset['status_mhs'];?></td>
			<td><?php echo $dataset['status_nikah'];?></td>
			<td><?php echo $dataset['status_lulus'];?></td>
		</tr>
		<?php endforeach?>
	</tbody>
</table>
<br /><br />

<h4>Algortima Naive-bayes</h4>
<table class="table">
	<tr>
		<td style="font-weight:bold;color:blue;"><?php echo str_replace(';', '<br />', $algo_result_top['param']);?></td>
		<td style="font-weight:bold;color:blue;"><?php echo $algo_result_top['result'];?></td>
	</tr>
</table>

<h4>Detil Perhitungan</h4>
<table class="table table-striped table-hover">
	<thead class="thead-dark">
		<tr>
			<th>No</th>
			<th>param</th>
			<th>data_count</th>
			<th>data_total</th>
			<th>result</th>
		</tr>
	</thead>
	<tbody>
		<?php $no=1;?>
		<?php foreach($algo_result_list as $result):?>
		<tr>
			<td><?php echo $no++;?></td>
			<td><?php echo $result['param'];?></td>
			<td><?php echo $result['data_count'] != 0 ? $result['data_count'] : '';?></td>
			<td><?php echo $result['data_total'] != 0 ? $result['data_total'] : '';?></td>
			<td><?php echo $result['result'];?></td>
		</tr>
		<?php endforeach?>
	</tbody>
</table>

