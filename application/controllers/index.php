<?php
/**
 * 默认控制器
 * 方法创建视图实例
 * 绑定数据
 * 调用提交方法, 并返回解析后的结果
 * 获取前端控制器，并填充内容
 */
class index implements IController {
	
	public function index() {
		
		$fc = FrontController::get_instance();
		$params = $fc->getParams();
		//根据键值获取传递的参数
		$name = $params['name'];
		
		
		$view = new View();
		$view->username = $name;			//向视图传递数据
		$result = $view->render('../views/index.php');
		
		
		$fc->setBody($result);
	}
	
}