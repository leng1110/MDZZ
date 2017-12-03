<?php
namespace bbackend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
use backend\models\ContactForm;

// use app\models\Goods;
// use app\models\User;
// use app\models\Num;

// use yii\data\Pagination;

//引入dfa
// use DfaFilter\SensitiveHelper;

/**
 * Site controller
 */
class DemoController extends Controller
{
    //关闭公共模版
    public $layout = false;
    //关闭CSRF攻击
    public $enableCsrfValidation = false;

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAdd()
    {
        return $this->render('demo/add');
    }

}