<?php

namespace common\helps;

use yii\web\Controller;
use Yii;

class BaseController extends  Controller
{
	/*定义私有属性*/
	// private $request = Yii::$app->request;
	/**
	 * GET接值
	 * @param  [type] $param   [键名]
	 * @param  string $defaust [默认值]
	 * @return [type]          [value]
	 */
	    public function Get($param=null,$defaust=null)
	    {
	        return  Yii::$app->request->get($param,$defaust);
	    }
    /**
     * POST接值
     * @param  [type] $param   [键名]
     * @param  string $defaust [默认值]
     * @return [type]          [value]
     */
	    public function Post($param=null,$defaust=null)
	    {
	        return  Yii::$app->request->post($param,$defaust);
	    }
	 /**
	  * [isGet 判断是否为GET传值]
	  * @return boolean [true or false]
	  */
		 public function isGet()
		 {
		 	return Yii::$app->request->isGet;
		 }
	/**
	  * [isPost 判断是否为POST传值]
	  * @return boolean [true or false]
	  */
		 public function isPost()
		 {
		 	return Yii::$app->request->isPost;
		 }
		public function md5Pwd($pwd,$key){

			return md5(md5($pwd).$key);
		}

 //  	public function isAjax(){
 //        return Yii::$app->request->isAjax;
 //  	}



}