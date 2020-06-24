<?php 
// CHECK FN
function checkStr( $text , $format = 'utf-8' ){
	return mb_strlen( $text , $format );
}
function checkNum($text){
	if( !preg_match('/^[0-9]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEngNum($text){
	if( !preg_match('/^[a-z0-9A-Z\s]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEng($text){
	if( !preg_match('/^[a-zA-Z\s]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEngThai($text){
	if( !preg_match("/^[a-zA-Zก-๙\s]+$/",$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkThai($text){
	if( !preg_match("/^[ก-๙\s]+$/",$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkPID($pid) {
	if(strlen($pid) != 13) {
		return false;
	}
	for($i=0, $sum=0; $i<12;$i++){
		$sum += (int)($pid{$i})*(13-$i);
	}
	if((11-($sum%11))%10 == (int)($pid{12})){
		return true;
	}
	else{
		return false;
	}
}

//FORMAT TEXT
function dateTH($strDate, $full=null, $time=null)
{
	$dateTH = "";
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));

	$strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$strMonthThai = $strMonthCut[$strMonth];

	if( !empty($full) ){
		$strMonthFull = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$strMonthThai = $strMonthFull[$strMonth];
	}

	$dateTH = "$strDay $strMonthThai $strYear";

	if( !empty($time) ){
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$dateTH .= " ($strHour:$strMinute น.)";
	}

	return $dateTH;
}
function stringify($data){
	return htmlentities(json_encode($data));
}
function DateJQToPHP($strDate){
	$dateArr = explode("/", $strDate);
	return "{$dateArr[2]}-{$dateArr[1]}-{$dateArr[0]}";
}

//SECURITY
function hashPassword($value, $options=[]){
	$cost = isset($options['rounds']) ? $options['rounds'] : 10;
	$hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
	if ($hash === false) {
		throw new RuntimeException('Bcrypt hashing not supported.');
	}
	return $hash;
}

//***** SET DATA FOR LOOP *****//
//PREFIX
function prefix(){
	$_prefix = [];
	$_prefix[] = ['id'=>1, 'name'=>'นาย'];
	$_prefix[] = ['id'=>2, 'name'=>'นาง'];
	$_prefix[] = ['id'=>3, 'name'=>'นางสาว'];
	return $_prefix;
}
function showPrefixName($prefix){
	$data = "";
	foreach (prefix() as $key => $value) {
		if( $prefix == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

//SEX
function sex(){
	$_sex = [];
	$_sex[] = ['id'=>'male', 'name'=>'ชาย'];
	$_sex[] = ['id'=>'female', 'name'=>'หญิง'];
	return $_sex;
}
function showSex($sex){
	$data = "";
	foreach (sex() as $key => $value) {
		if( $sex == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

//STATUS
function status(){
	$_status = [];
	$_status[] = ['id'=>1, 'name'=>'รอแข่ง', 'class'=>'btn btn-secondary btn-sm text-white', 'icon'=>'fas fa-clock'];
	$_status[] = ['id'=>2, 'name'=>'กำลังแข่ง', 'class'=>'btn btn-primary btn-sm text-white', 'icon'=>'fas fa-hourglass-start'];
	$_status[] = ['id'=>3, 'name'=>'สิ้นสุดการแข่ง', 'class'=>'btn btn-success btn-sm text-white', 'icon'=>'fa fa-check'];
	return $_status;
}
function getStatus($status){
	$data = "";
	foreach (status() as $key => $value) {
		if( $status == $value["id"] ){
			$data = $value;
			break;
		}
	}
	return $data;
}