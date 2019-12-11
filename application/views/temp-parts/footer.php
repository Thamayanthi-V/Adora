<!-- malar starts -->
 <script src="<?php echo base_url(); ?>assets/js/jquery-confirm.min.js"></script>
<script src="<?php echo base_url();?>assets/js/validation.js"></script>  
<!-- malar starts -->
<script>
   $(function () {
     //Initialize Select2 Elements
    $('.select1').select2({
     })
   
    //Date picker
     $('.datepicker').datepicker({
      format:'dd-mm-yyyy',
      autoclose: true,
      todayHighlight: true
     })
   
   })
   
   
   /*datatable*/
   $(document).ready(function(){
     var table = $('#example').DataTable({
         responsive: true
     });
     var table = $('#example1').DataTable({
         responsive: true,
         paging      : true,
         lengthChange: false,
         searching   : false,
         ordering    : true,
         info        : true,
         autoWidth   : false
     });
     var table = $('.example1').DataTable({
         responsive: true,
         paging      : true,
         lengthChange: false,
         searching   : false,
         ordering    : true,
         info        : true,
         autoWidth   : false
     });

   });

   /*auto Complete off*/
   $(document).ready(function(){
    $( document ).on( 'focus', ':input', function(){
        $( this ).attr( 'autocomplete', 'off' );
    });
});

</script>

<footer class="main-footer">
    <div class="container">
      <div class="pull-right hidden-xs">
        <b>Developed by <a href="https://www.minmegam.com/" target="_balnk">Minmegam Internet Services</a></b> 
      </div>
      <strong>Copyright &copy; 2019 <a href="#">Adora Boutique</a>.</strong> All rights
      reserved.
    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

</body>
</html>