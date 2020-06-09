<?php
// ============================= JAVASCRIPT CONTROL ================================ //

if (isset ( $alert )) echo "<script type='text/javascript'>alert('$alert');</script>";
if (isset ( $reload )) echo "<script type='text/javascript'>window.location.reload();</script>";
if (isset ( $location )) echo "<script type='text/javascript'>window.location = '$location';</script>";
if (isset ( $localSetTimeout)) echo "<script type='text/javascript'>setTimeout(function(){location.href='$localSetTimeout'},3000);</script>";
if (isset ( $close )) echo "<script type='text/javascript'>window.close();</script>";
if (isset ( $msgSuccessLogin )) echo "<script type='text/javascript'>swal({title: 'ยินดีต้อนรับ',text: 'คุณ $msgSuccessLogin \\n เข้าสู่ระบบสหกิจศึกษา', type: 'success',showConfirmButton: false});</script>";
if (isset ( $msgErrorLogin )) echo "<script type='text/javascript'>swal('เกิดข้อผิดพลาด','$msgErrorLogin','error');</script>";
if (isset ( $msgErrorStatus )) echo "<script type='text/javascript'>swal('เกิดข้อผิดพลาด','$msgErrorStatus','warning');</script>";
if (isset ( $msgLogout )) echo "<script type='text/javascript'>swal({title: 'เสร็จสิ้น',text: '$msgLogout',type: 'success',showConfirmButton: false});</script>";
if (isset ( $msgSuccessReg )) echo "<script type='text/javascript'>swal('เสร็จสิ้น','$msgSuccessReg','success');</script>";
if (isset ( $msgSuccessLoginCMS )) echo "<script type='text/javascript'>swal({title: 'ยินดีต้อนรับ',text: 'คุณ $msgSuccessLoginCMS \\n เข้าสู่ ระบบการจัดการข้อมูล', type: 'success',showConfirmButton: false});</script>";
if (isset ( $msgErrorLoginCMS )) echo "<script type='text/javascript'>swal({title: 'ผิดพลาด',text: '$msgErrorLoginCMS', type: 'error',showConfirmButton: false});</script>";
if (isset ( $msgSuccessSending )) echo "<script type='text/javascript'>swal({title: 'ส่งไฟล์เรียบร้อย',text: '$msgSuccessSending', type: 'success',showConfirmButton: false});</script>";
	
// =========================== END JAVASCRIPT CONTROL ============================== //
?>