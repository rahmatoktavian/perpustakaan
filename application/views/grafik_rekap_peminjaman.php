<div id="grafik_rekap_peminjaman"></div>

<script src="<?php echo base_url('assets/vendor/highcharts/highcharts.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/highcharts/modules/exporting.js');?>"></script>
<script src="<?php echo base_url('assets/vendor/highcharts/modules/export-data.js');?>"></script>
<script type="text/javascript">
	// Build the chart
	Highcharts.chart('grafik_rekap_peminjaman', {
	    chart: {
	        type: 'line'
	    },
	    title: {
	        text: '<?php echo $judul;?>'
	    },
	    xAxis: {
	    	//categories: [ 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul']
	        categories: [
        					<?php foreach($data_grafik as $grafik):?>
        						'<?php echo $grafik['tanggal_pinjam'];?>',
        					<?php endforeach?>
        				],
	        crosshair: true
	    },
	    yAxis: {
	        min: 0,
	        title: {
	            text: 'Total Buku'
	        }
	    },
	    plotOptions: {
	        column: {
	            pointPadding: 0.2,
	            borderWidth: 0
	        }
	    },

	    series: [
	    			{
	    				name: 'Total Buku', 
	        			data: [
	        					<?php foreach($data_grafik as $grafik):?>
	        						<?php echo $grafik['total_buku'];?>,
	        					<?php endforeach?>
	        				]
	        		}
				]
	    /*
	    series: [
		    		{
				        name: 'Temperature',
				        data: [49, 53, 70, 73, 45, 90, 105]
				    },
				]
		*/

	});
</script>