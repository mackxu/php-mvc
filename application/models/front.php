<?php
/**
 * 前端控制器
 * 负责控制应用的程序流
 */
class FrontController {
	protected $_controller;
	protected $_action;
	protected $_params = array();
	protected $_body;
	
	static $_instance;
	
	public static function get_instance() {
		if (!(self::$_instance instanceof self)){
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}
	/**
	 * 初始化工作
	 * 解析路径为控制器、方法、参数赋值
	 */
	private function __construct() {
		$request = $_SERVER['REQUEST_URI'];
		
		$splits = explode('/', trim($request, '/'));
		$this->_controller = (!empty($splits[0]))?$splits[0]:'index';		//控制器名
		$this->_action = (!empty($splits[1]))?$splits[1]:'index';			//方法名
		
		//获取参数
		if (!empty($splits[2])) {
			$keys = $values = array();
			for ($i=2; $i<count($splits); $i++) {
				if($i % 2 == 0) {
					$keys[] = $splits[$i];			//偶数索引号为键值
				}else {
					$values[] = $splits[$i];		//奇数索引号为值
				}
			}
			$this->_params = array_combine($keys, $values);
		}
	}
	
	/**
	 * 解析路由
	 * 根据控制器名调用方法，传递参数
	 */
	public function route() {
		if (class_exists($this->_controller)){
			$rc = new ReflectionClass($this->getController());
			if ($rc->implementsInterface("IController")) {
				if ($rc->hasMethod($this->getAction())) {
					$controller = $rc->newInstance();				//初始化控制器
					$method = $rc->getMethod($this->getAction());	//调用的方法名
					$method->invoke($controller);
				}else {
					throw new Exception("Action");;
				}
			}else {
				throw new Exception("IController");
			}
		}else {
			throw new Exception("Controller");
		} 
	}
	
	/**
	 * @return the $_controller
	 */
	public function getController() {
		return $this->_controller;
	}

	/**
	 * @return the $_action
	 */
	public function getAction() {
		return $this->_action;
	}

	/**
	 * @return the $_params
	 */
	public function getParams() {
		return $this->_params;
	}

	/**
	 * @return the $_body
	 */
	public function getBody() {
		return $this->_body;
	}

	/**
	 * @param field_type $_body
	 */
	public function setBody($_body) {
		$this->_body = $_body;
	}
	
}