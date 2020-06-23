  <footer class="main-footer">
    <strong>Copyright &copy; 2020 <a href="">LPRU</a></strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- Start Modal -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="<?=PLUGINS?>jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?=PLUGINS?>jquery-ui/jquery-ui.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?=PLUGINS?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=JS?>adminlte.min.js"></script>
<!-- SWEETALERT -->
<script src="<?=JS?>sweetalert2.js"></script>
<!-- MAIN -->
<script src="<?=JS?>main.js"></script>
<!-- DataTables -->
<script src="<?=PLUGINS?>datatables/jquery.dataTables.js"></script>
<script src="<?=PLUGINS?>datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(document).ready(function() {
    $.extend(true, $.fn.dataTable.defaults, {
      "language": {
        "sProcessing": "กำลังดำเนินการ...",
        "sLengthMenu": "แสดง _MENU_ แถว",
        "sZeroRecords": "ไม่พบข้อมูล",
        "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
        "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
        "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
        "sInfoPostFix": "",
        "sSearch": "ค้นหา:",
        "sUrl": "",
        "oPaginate": {
          "sFirst": "เริ่มต้น",
          "sPrevious": "ก่อนหน้า",
          "sNext": "ถัดไป",
          "sLast": "สุดท้าย"
        }
      }
    });
    var table = $('.DataTable').DataTable( {
      // responsive: true
    } );
    $(".DatePicker").datepicker({
      changeMonth: true,
      changeYear: true,
      showButtonPanel: true,
      yearRange: "-100:+0",
      dateFormat: 'dd/mm/yy',
      monthNamesShort: $.datepicker.regional["en"].monthNames
    });
    
    // new $.fn.dataTable.FixedHeader( table );
  } );
</script>
</body>
</html>