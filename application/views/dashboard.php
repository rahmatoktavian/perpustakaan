<!--dashboard summary-->
<div class="row">

	<!-- Total Peminjaman -->
	<div class="col-xl-4 col-md-4 mb-4">
	  <div class="card border-left-primary shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800">
	           <?php echo $data_peminjaman_buku['total'];?> Buku
	       	  </div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-upload fa-2x text-primary"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Total Pengembalian -->
	<div class="col-xl-4 col-md-4 mb-4">
	  <div class="card border-left-success shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pengembalian</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800">
	          	<?php echo $data_pengembalian_buku['total'];?> Buku
	          </div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-download fa-2x text-success"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Menunggu Pengembalian -->
	<div class="col-xl-4 col-md-4 mb-4">
	  <div class="card border-left-danger shadow h-100 py-2">
	    <div class="card-body">
	      <div class="row no-gutters align-items-center">
	        <div class="col mr-2">
	          <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Menunggu Pengembalian</div>
	          <div class="h5 mb-0 font-weight-bold text-gray-800">
	          	<?php echo ($data_peminjaman_buku['total'] - $data_pengembalian_buku['total']);?> Buku
	          </div>
	        </div>
	        <div class="col-auto">
	          <i class="fas fa-question fa-2x text-danger"></i>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>

</div>
<!--dashboard summary-->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-8">
      <div class="card shadow mb-4">

        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Rekap Peminjaman Buku</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body">
          
        	<div id="grafik_buku"></div>

					<script src="<?php echo base_url('assets/vendor/highcharts/highcharts.js');?>"></script>
					<script src="<?php echo base_url('assets/vendor/highcharts/modules/exporting.js');?>"></script>
					<script src="<?php echo base_url('assets/vendor/highcharts/modules/export-data.js');?>"></script>
					<script type="text/javascript">
						// Build the chart
						Highcharts.chart('grafik_buku', {
						    chart: {
						        plotBackgroundColor: null,
						        plotBorderWidth: null,
						        plotShadow: false,
						        type: 'pie'
						    },
						    title: {
						        text: ''
						    },
						    tooltip: {
						        pointFormat: '{series.name}: <b>{point.y}</b> (<b>{point.percentage:.1f}%</b>)'
						    },
						    accessibility: {
						        point: {
						            valueSuffix: '%'
						        }
						    },
						    plotOptions: {
						        pie: {
						            allowPointSelect: true,
						            cursor: 'pointer',
						            dataLabels: {
						                enabled: false
						            },
						            showInLegend: true
						        }
						    },
						    series: [{
						        name: 'Peminjaman',
						        colorByPoint: true,       
				                innerSize: '40%',
				                showInLegend:true,

						        //format data chart
						        data: [
						        		<?php foreach($data_grafik as $grafik):?>
						        		{	
						        			name: '<?php echo $grafik['judul'];?>',
						        			y: <?php echo $grafik['total_peminjaman'];?>
						        		},
								        <?php endforeach?>
								   	]

						        //format data original
						        /*
						        data: [
						        		{
								            name: 'Chrome', 
								            y: 61.41
								        }, 

								        {
								            name: 'Internet Explorer',
								            y: 11.84
								        }, 

								        {
								            name: 'Firefox, 
								            y: 10.85
								        },
								   	]
										*/
						    }]
						});
					</script>

        </div>
      </div>
    </div>

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-4">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman Buku</h6>
        </div>

        <!-- Card Body -->
        <div class="card-body">
        	
        	<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Judul</th>
						<th>Peminjaman</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($data_grafik as $buku):?>
					<tr>
						<td><?php echo $buku['judul'];?></td>
						<td><?php echo $buku['total_peminjaman'];?> x</td>
					</tr>
					<?php endforeach;?>
				</tbody>
			</table>

        </div>
      </div>
    </div>
</div>