<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="index3.html" class="brand-link">
		<img src="<?=IMAGES?>/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<span class="brand-text font-weight-light">ADMIN System</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?=IMAGES?>/avatar.png" class="img-circle elevation-2" alt="User Image">
			</div>
               <!-- style="padding: 0px 5px 0px 10px;" -->
			<div class="info" >
				<a href="" class="d-block"><?=$auth["user_name"]?></a>
                    <!-- <small class="text-white">Username : <?=$auth["username"]?></small> -->
			</div>
		</div>

          <?php include("menu_init.php"); ?>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          	with font-awesome or any other icon font library -->
               <?php 
               foreach ($menu as $key => $value) {
                    if( empty($value["sub"]) ){
                         ?>
                         <li class="nav-item">
                              <a href="<?=$value["url"]?>?page=<?=$value['key']?>" class="nav-link <?= $value['key'] == $_GET['page'] ? "active" : "" ?>">
                                   <i class="nav-icon <?=$value["icon"]?>"></i>
                                   <p>
                                        <?=$value["label"]?>
                                   </p>
                              </a>
                         </li>
                         <?php
                    }
                    else{
                         ?>
                         <li class="nav-item has-treeview <?= $value['key'] == $_GET['page'] ? "menu-open" : "" ?>">
                              <a href="#" class="nav-link <?= $value['key'] == $_GET['page'] ? "active" : "" ?>">
                                   <i class="nav-icon <?=$value["icon"]?>"></i>
                                   <p>
                                        <?=$value["label"]?>
                                        <i class="right fas fa-angle-left"></i>
                                   </p>
                              </a>
                              <ul class="nav nav-treeview">
                                   <?php 
                                   foreach ($value["sub"] as $sub) {
                                        ?>
                                        <li class="nav-item">
                                             <a href="<?=$sub['url']?>?page=<?=$value["key"]?>&sub=<?=$sub["key"]?>" class="nav-link  <?= $sub['key'] == $_GET['sub'] ? "active" : "" ?>">
                                                  <i class="<?=$sub['icon']?> nav-icon"></i>
                                                  <p><?=$sub['label']?></p>
                                             </a>
                                        </li>
                                        <?php
                                   }
                                   ?>
                              </ul>
                         </li>
                         <?php
                    }
               }
               ?>
          	<!-- <li class="nav-header">แยกเมนู</li> -->
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>