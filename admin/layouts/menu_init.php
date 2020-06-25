<?php

// EX. MENU WITH SUB //
$sub_admin[] = ["label"=>"จัดการชนิดกีฬา", "key"=>"sports", "url"=>URL."admin/sports", 'icon'=>'fas fa-swimmer'];
$sub_admin[] = ["label"=>"จัดการการแข่งขัน", "key"=>"tournament", "url"=>URL."admin/tournament", 'icon'=>'fas fa-edit'];
// $sub_admin[] = ["label"=>"จัดการผลการแข่งขัน", "key"=>"result", "url"=>URL."admin/result", 'icon'=>'fas fa-file'];
$menu[] = ["label"=>"การจัดการการแข่งขัน", "key"=>"sport", 'icon'=>'fas fa-cogs', "sub"=>$sub_admin];
// END //

// $menu[] = ["label"=>"จัดการทีม", "key"=>"team", "url"=>URL."admin/team", 'icon'=>'fas fa-file-invoice-dollar'];
// $menu[] = ["label"=>"จัดการสมาชิกทีม", "key"=>"player", "url"=>URL."admin/player", 'icon'=>'fa fa-users'];

?>