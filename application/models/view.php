<?php
/**
 * 视图模型
 * 提供了视图输出功能
 * 为变量创建作用域
 * 通过在方法内部包含输出结果，从而限制那个方法的作用域，联合PHP输出缓存
 * 
 */
class View extends ArrayObject {
	public function __construct() {
		parent::__construct(array(), ArrayObject::ARRAY_AS_PROPS);
	}
	
	public function render($fileName) {
		ob_start();
		include dirname(__FILE__).'/'.$fileName;		//
		return ob_get_clean();
	}
}