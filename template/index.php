<?php
	//引导程序的文件

	//导入组件
	require_once '../application/models/front.php';
	require_once '../application/models/IController.php';
	require_once '../application/models/view.php';
	
	//导入控制器
	require_once '../application/controllers/index.php';
	
	//前端控制器
	$front = FrontController::get_instance();
	$front->route();
	echo $front->getBody();