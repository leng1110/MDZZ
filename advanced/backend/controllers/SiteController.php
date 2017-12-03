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

use app\models\Goods;


/**
 * Site controller
 */
class SiteController extends Controller
{
    //关闭公共模版
    public $layout = false;
    //关闭CSRF攻击
    public $enableCsrfValidation = false;

    //页面展示
    public function actionIndex()
    {
        $Exam = new Goods();
        $data = $Exam->find()->all();
        return $this->render('index',['data'=>$data]);
    }
    // 添加
    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionAddt()
    {
        $Exam = new Goods();
        $data=Yii::$app->request->post();
        $Exam->goods_name = $data['goods_name'];
        $Exam->goods_price = $data['goods_price'];
        if($Exam->save()){
            return $this->redirect('/site/index');
        }else{
            return $this->render('add');
        }
    }

    //修改页面加执行
    public function actionUpdate()
    {
        $Exam = new Goods();
        $id = Yii::$app->request->get('id');
        $res = $Exam->find()->where(['id'=>$id])->one();
        return $this->render('update',['res'=>$res]);
    }
    public function actionUpdateto()
    {
        $Exam = new Goods();
        $data=Yii::$app->request->post();
        // $Exam->id = $data['id'];
        $res = $Exam->find()->where(['id'=>$data['id']])->one();
        $res->goods_name = $data['goods_name'];
        $res->goods_price = $data['goods_price'];
        if($res->save()){
            return $this->redirect('/site/index');
        }else{
            return $this->render('add');
        }
    }
    
    //删除
    public function actionDel()
    {
        $Exam = new Goods();
        $id = $_GET['id'];
        if($Exam->find()->where(['id'=>$id])->one()->delete()){
            return $this->redirect('/site/index');
        }
    }

}