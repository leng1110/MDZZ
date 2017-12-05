<?php
use yii\helpers\Url;
?>

<meta charset="utf8">

<style>
table{ border-collapse: collapse; border: 1px solid #ddd; width: 800px; margin: 0 auto;margin-top: 50px; background: rgba(121, 217, 221, 0.4); color: #666}
table tr{ height: 40px;}
table td{ border: 1px solid #ddd; text-align: center}

*{margin: 0; padding:0 ; font-family: 微软雅黑}
a{ text-decoration: none; color: #666;}

.top{ width: 100%; text-align: center;}
.top h2{ margin-top: 50px;}

form{ width: 450px; margin: 0 auto; margin-top: 50px;}
form input{
    width: 300px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding-left: 5px;
    font-size: 14px;
}

form p{
    margin-top: 20px;
    width: 100%;
}

form span{
    width: 100px;
    text-align: right;
    display: inline-block;
}

.a_button{
    width: 150px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: green;
    color: #fff;
    display: block;
    border: 1px solid green;
    border-radius: 5px;
    margin: 0 auto;
}
</style>

<div class="top">
    <h2>欢迎注册</h2>
</div>

<div class="main">
    <form action="<?php echo Url::to(['register/one_do'])?>" method="post">
        <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
        <p>
            <span>手机号：</span>
            <input type="text" name="tel" placeholder="请输入手机号" value="<?=$data['r_tel']?>">
        </p>
        <p>
            <span>密码：</span>
            <input type="password" name="pwd" placeholder="请输入密码" value="<?=$data['r_pwd']?>">
        </p>
        <p>
            <span>确认密码：</span>
            <input type="password" name="pwd2" placeholder="请输入确认密码" value="<?=$data['r_pwd']?>">
            <input type="hidden" name="state" value="<?=$data['state']?>">
        </p>
        <p>
            <input type="submit" value="下一步" class="a_button">
            <!-- <a class="a_button" href="./register_2.html">下一步</a> -->
        </p>
    </form>
</div>
