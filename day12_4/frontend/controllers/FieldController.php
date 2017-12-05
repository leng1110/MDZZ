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
use app\models\Yonghu;
use app\models\Label;


use yii\data\Pagination;
use DfaFilter\SensitiveHelper;

/**
 * Field controller
 */
class FieldController extends Controller
{
    //取消公公模板
    public $layout = false;
    //关闭csrf攻击
    public $enableCsrfValidation=false;

    //添加方法
    public function actionAdd()
    {
        return $this->render('register');
    }

    public function actionAdd_to()
    {
        $data = Yii::$app->request->post();
        return $this->render('register_2',['data'=>$data]);
    }    

    public function actionReg_3()
    {
        $data = Yii::$app->request->post();
        unset($data['_csrf-frontend']);

        $redis = \Yii::$app->redis;
        $redis->set('aa',serialize($data));  

        $label = new Label();
        $res = $label->find()->asArray()->all();
        return $this->render('register_3',['data'=>$res]);
    }    

    public function actionReg_2()
    {
        $redis = \Yii::$app->redis;
        $data = $redis->get('aa'); 
        

        return $this->render('register_2',['data'=>unserialize($data)]);
    }

    public function actionReg_1()
    {   
        $data = Yii::$app->request->post();
        var_dump($data);die;
        $yh = new Yonghu();

        $yh->name = $data['name'];
        $yh->phone = $data['phone'];
        $yh->day = $data['day'];
        $yh->pwd = $data['pwd'];
        $yh->add = $data['add'];
        if($yh->save()){
            $label = new Label();
            $data = $label->find()->asArray()->all();
            return $this->render('register_3',['data'=>$data]);
        }
    }

    public function actionEnd()
    {
        echo '完犊子';
    }
    
}
