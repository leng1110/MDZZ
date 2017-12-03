<?php
// $relativeHomeUrl = Url::home();
// $absoluteHomeUrl = Url::home(true);
// $httpsAbsoluteHomeUrl = Url::home('https');
use yii\helpers\Url;
// use yii\helpers\Html;
// use yii\helpers\ActiveForm;
?>
<meta charset="utf8">

<style>
table{ border-collapse: collapse; border: 1px solid #ddd; width: 800px; margin: 0 auto;margin-top: 50px; background: rgba(121, 217, 221, 0.4); color: #666}
table tr{ height: 40px;}
table td{ border: 1px solid #ddd; text-align: center}

*{margin: 0; padding:0 ; font-family: 微软雅黑}
a{ text-decoration: none; color: #666;}
ul{ list-style: none}

.top{ width: 100%; background: rgba(14, 196, 210, 0.99); color: #fff; height: 100px; line-height: 150px; text-align: right;}
.top span{ margin-right: 20px}


.left{ width: 260px; float: left; height: 100%; background: rgba(121, 217, 221, 0.4)}
.left ul{ list-style: none; width: 100%;}
.left ul li{ height: 40px; width: 100%; border: 1px solid #ddd; line-height: 40px; text-align: center;}
.left .selected{ background: rgba(14, 196, 210, 0.99);}
.left .selected a{ color: #fff;}


.right{ float: left; width: 1000px;}
.search-box{ width: 900px; margin: 0 auto; margin-top: 100px; }
.right li{
    margin-top: 20px;
}
.right span{
    display: inline-block;
    width: 200px;
    line-height: 40px;
    height: 40px;
    text-align: right;
    margin-right: 20px;
}

.right .filed-name{
    width: 300px;
    line-height: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
}

.right .length{
    width: 140px;
    line-height: 40px;
    height: 40px;
    border: 1px solid #ddd;
    border-radius: 3px;
    font-size: 14px;
}

.submit{
    width: 150px;
    height: 40px;
    line-height: 40px;
    border-radius: 3px;
    border: 1px solid #ddd;
    display: inline-block;
    background: rgba(14, 196, 210, 0.99);
    color: #fff;
    text-align: center;
    margin-left: 200px;
    margin-top: 20px;
}
</style>

<div class="top">
    <span>欢迎管理员：admin</span>
</div>

<div class="left">
    <ul>
        <li><a href="<?php echo Url::to(['field/add'])?>">添加注册字段</a></li>
        <li><a href="<?php echo Url::to(['field/index'])?>">查看注册字段</a></li>
        <li class="selected"><a href="<?php echo Url::to(['field/upd'])?>">修改注册字段</a></li>
    </ul>
</div>

<div class="right">
    <div class="search-box">
        <form action="<?php echo Url::to(['field/upd_do'])?>" method="post">
            <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
            <ul>
                <li>
                    <span>请输入字段名称：</span>
                    <input class="filed-name" type="text" name="field_name" value="<?=$data['field_name']?>">
                    <input class="filed-name" type="hidden" name="field_id" value="<?=$data['field_id']?>">
                </li>
                <li>
                    <span>请输入字段默认值：</span>
                    <input class="filed-name" type="text" name="default_value"  value="<?=$data['default_value']?>" >
                </li>
                <li>
                    <span>请选择字段类型：</span>
                    <select name="field_type" id="">
                    <?php if($data['field_type'] == 'input-text'){?>
                        <option selected value="input-text">文本框</option>
                        <option  value="input-radio">单选框</option>
                        <option  value="input-password">密码框</option>
                        <option  value="textarea">文本域</option>
                    <?php }else if($data['field_type'] == 'input-radio'){?>
                        <option selected value="input-radio">单选框</option>
                        <option  value="input-text">文本框</option>
                        <option  value="input-password">密码框</option>
                        <option  value="textarea">文本域</option>
                    <?php }else if($data['field_type'] == 'input-password'){?>
                        <option value="input-radio">单选框</option>
                        <option  value="input-text">文本框</option>
                        <option  value="input-password">密码框</option>
                        <option selected  value="textarea">文本域</option>
                    <?php }else{?>
                        <option selected value="textarea">文本域</option>
                        <option  value="input-text">文本框</option>
                        <option  value="input-radio">单选框</option>
                        <option  value="input-password">密码框</option>
                    <?php }?>

                    </select>
                </li>
                <li>
                    <span>请填写字段选项：</span>
                    <input type="text" class="filed-name" placeholder="选项1"  value="<?=$data['field_name']?>">
                    <input type="text" class="filed-name" placeholder="选项2"  value="<?=$data['field_name']?>">
                </li>
                <li>
                    <span>是否必填：</span>
                    <?php if ($data['state'] == 1){ ?>
                        <input type="checkbox" value="1" name="state" checked>必填
                    <?php }else{?>
                        <input type="checkbox" value="1" name="state">必填
                    <?php } ?>
                </li>
                <li>
                    <span>请选择验证规则：</span>
                    <select name="rule" id="">
                        <?php if ($data['field_name'] == 'no'){ ?>
                            <option value="no" selected>无</option>
                            <option value="phone">手机号码</option>
                            <option value="length">长度</option>
                        <?php }else if($data['field_name'] == 'phone'){ ?>
                            <option value="phone" selected>手机号码</option>
                            <option value="length">长度</option>
                            <option value="no">无</option>
                        <?php }else{ ?>
                            <option value="length" selected>长度</option>
                            <option value="no">无</option>
                            <option value="phone">手机号码</option>
                        <?php } ?>
                    </select>
                </li>
                <li>
                    <span>请选择填写长度范围：</span>
                    <input class="length" type="text" name="min" placeholder="请输入最小长度"  value="<?=$data['min']?>">
                    ~
                    <input class="length" type="text" name="max" placeholder="请输入最大长度"  value="<?=$data['max']?>">
                </li>
                <li>
                    <input type="submit" class="submit" value="提交">
                </li>
            </ul>
        </form>
    </div>
</div>