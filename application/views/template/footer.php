<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/js/sb-admin-2.min.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/js/demo/chart-area-demo.js') ?>"></script>
<script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js') ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/js/demo/datatables-demo.js') ?>"></script>

<script>
  $(document).ready(function() {
    var bulan = $("#bulan option:selected").val();
    var tahun = $("#tahun option:selected").val();


    $("#cari").click(function() {
      if (bulan.length < 0 && tahun.length < 0) {
        $("#b").hide();
        $("#w").hide();
      } else {
        $("#b").show();
        $("#w").show();
      }
    });
  });
</script>

</body>

</html>