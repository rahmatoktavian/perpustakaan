<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Perpustakaan - <?php echo $judul;?></title>

  <!-- css yang digunakan theme -->
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css"> 
  <link href="<?php echo base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">

  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- load sidebar -->
    <?php $this->load->view('theme/sidebar');?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- load header -->
        <?php $this->load->view('theme/header');?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php if($this->session->flashdata('message')):?>
            <div class="text-center alert alert-success">
              <?php echo $this->session->flashdata('message');?>
            </div>
          <?php endif;?>

          <?php echo validation_errors('<div class="alert alert-danger text-center">', '</div>'); ?>

          <!-- load halaman sesuai controller yang dipilih dari sidebar -->
          <?php $this->load->view($theme_page);?>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- load footer -->
      <?php $this->load->view('theme/footer');?>

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
  <!-- js yang digunakan theme -->
  <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js');?>"></script>
  <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
  <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js');?>"></script>
  <script src="<?php echo base_url('assets/js/sb-admin-2.min.js');?>"></script>
  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css');?>">
  <script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>
  <script type="text/javascript" charset="utf8" src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js');?>"></script>
  

  <script type="text/javascript">
    $(document).ready( function () {
      $('#datatables').DataTable({
          "lengthChange": false,
          "pageLength": 10,
      });

      $('#datatables2 tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );
     
        // DataTable
        var table = $('#datatables2').DataTable({
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;
     
                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        });

    });
  </script>

</body>

</html>
