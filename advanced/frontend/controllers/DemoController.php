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
use app\models\User;
use app\models\Num;

use yii\data\Pagination;

//引入dfa
use DfaFilter\SensitiveHelper;

/**
 * Site controller
 */
class DemoController extends Controller
{
    //关闭公共模版
    public $layout = false;
    //关闭CSRF攻击
    public $enableCsrfValidation = false;

    //登陆展示
    public function actionIndex()
    {
        return $this->render('index');
    }

    //登陆验证
    public function actionLogin()
    {
        $Exam = new User();
        $session = Yii::$app->session;

        $name=Yii::$app->request->post('name');
        $pwd=Yii::$app->request->post('pwd');

        $sql = $Exam->find()->where(['pwd'=>$pwd])->one();

        if($sql == null){
            return $this->redirect('/demo/index');
        }else{
            $session->set('name',$name);
            return $this->redirect('/demo/show');
        }
    }

    //展示
    public function actionShow()
    {
        $this->layout='main';
        $Exam = new Num();

        // 查询总数
        $user_count = $Exam->find()->count();
        $data['pages'] = new Pagination(['totalCount' => $user_count]);
        // 设置每页显示多少条
        $data['pages']->defaultPageSize = 5;
        $user_list = $Exam->find()->offset($data['pages']->offset)->limit($data['pages']->limit)->asArray()->all();
        $data['pages']->params=array("tab"=>'all');
        return $this->render('show',[
            'data' => $data,
            'res' => $user_list,
        ]);
    }


    // 添加
    public function actionAdd()
    {
        // 获取感词库索引数组
        $wordData = array(
            '察象蚂',
            '拆迁灭',
            '车牌隐',
            '成人电',
            '成人卡通',
            '你妈',
        );
        $Exam = new Num();
        $session = Yii::$app->session;
        $data=Yii::$app->request->post();
        $content = $data['content'];
        //验证关键词
        $islegal = SensitiveHelper::init()->setTree($wordData)->islegal($content);
        //替换关键词
        $filterContent = SensitiveHelper::init()->setTree($wordData)->replace($content, '***');
        //获取关键词
        $sensitiveWordGroup = SensitiveHelper::init()->setTree($wordData)->getBadWord($content);

        $name = $session->get('name');
        $Exam->time = time();
        $Exam->name = $name;
        // $Exam->content = $data['content'];
        $Exam->content = $filterContent;
        if($Exam->save()){
            return $this->redirect('/demo/show');
        }else{
            return $this->render('/demo/show');
        }
    }

    //修改页面加执行
    public function actionUpdate()
    {
        $Exam = new Num();
        $id = Yii::$app->request->get('id');
        $res = $Exam->find()->where(['id'=>$id])->one();
        return $this->render('update',['res'=>$res]);
    }
    public function actionUpdateto()
    {
        $Exam = new Num();
        $data=Yii::$app->request->post();
        $res = $Exam->find()->where(['id'=>$data['id']])->one();
        $res->content = $data['content'];
        $res->time = time();
        if($res->save()){
            return $this->redirect(['/demo/show']);
        }else{
            return $this->render('add');
        }
    }
    
    //删除
    public function actionDel()
    {
        $Exam = new Num();
        $id = $_GET['id'];
        if($Exam->find()->where(['id'=>$id])->one()->delete()){
            return $this->redirect('/demo/show');
        }
    }
}