<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use app\models\Field;
use app\models\Login;
use app\models\Label;
use app\models\Register;
use yii\data\Pagination;
use DfaFilter\SensitiveHelper;

/**
 * Site controller
 */
class RegisterController extends Controller
{

    //第一步注册
	public function actionOne(){
		$register = new Register();
		$state = Yii::$app->request->get('state');
		if($state == '1'){
			$session = Yii::$app->session;
			$tel = $session->get('tel');
			// $register = new Register();
			$data = $register->find()->where(['r_tel' => $tel])->asArray()->one();
			$data['state'] = $state;
		}
		if(isset($data)){
			return 	$this->render('register',['data'=>$data]);
		}else{
			$data = $register->find()->where(['r_id' =>0 ])->asArray()->one();
			return 	$this->render('register',['data'=>$data]);
		}
	}

	//将注册信息入库
	public function actionOne_do(){

		$data = Yii::$app->request->post();
		// var_dump($data);die;
		if($data['state'] == 1){
			$this->redirect(['register/two']);
		}else{
			if($data['pwd'] != $data['pwd2']){
				echo "两次输入密码不相同，重新输入";die;
			}
			$register = new Register();
			$register->r_tel = $data['tel'];
			$register->r_pwd = $data['pwd'];
			$res = $register->save();
			if($res){
				$session = Yii::$app->session;
				$session->set('tel', $data['tel']);
				// $tel = $session->get('tel');
				$this->redirect(['register/two']);
			}
		}
	}

	//第二步
	public function actionTwo(){
		$register = new Register();
		$state = Yii::$app->request->get('state');
		if($state == '1'){
			$session = Yii::$app->session;
			$tel = $session->get('tel');
			$data = $register->find()->where(['r_tel' => $tel])->asArray()->one();
			$data['state'] = $state;
		}
		if(isset($data)){
			return 	$this->render('register_2',['data'=>$data]);
		}else{
			$data = $register->find()->where(['r_id' =>0 ])->asArray()->one();
			// $data = array();
			return 	$this->render('register_2',['data'=>$data]); 
		}
		//return 	$this->render('register_2');
	}


	//第二步信息入库
	public function actionTwo_do(){
		$data = Yii::$app->request->post();
		if($data['state'] == 1){
			$this->redirect(['register/three']);
		}else{
			$register = new Register();
			$session = Yii::$app->session;
			$tel = $session->get('tel');
			$arr = $register->find()->where(['r_tel' => $tel])->one();
			// var_dump($data);
			// var_dump($arr);die;
			$arr->r_name = $data['name'];
			$arr->r_birthday = $data['birthday'];                                       
			$arr->r_address = $data['address'];
			$res = $arr->save();
			if($res){
				$this->redirect(['register/three']);
			}
		}
	}

	public function actionThree(){
		$session = Yii::$app->session;
		$tel = $session->get('tel');
		$label = new Label();
		$data = $label->find()->asArray()->all();
		return $this->render('register_3',['data'=>$data]);
	}

	public function actionThree_do(){
		$l_id = Yii::$app->request->post();
		$label_id = trim($l_id['str'],',');
		$session = Yii::$app->session;
		$tel = $session->get('tel');
		$register = new Register();
		$arr = $register->find()->where(['r_tel' => $tel])->one();
		$arr->label_id = $label_id;
		$res = $arr->save();
		if($res){
			echo 1;die;
		}else{
			echo 2;die;
		}
	}

	public function actionSuccess(){
		return $this->render('success');
	}

}