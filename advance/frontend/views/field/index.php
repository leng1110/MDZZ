<?php
// $relativeHomeUrl = Url::home();
// $absoluteHomeUrl = Url::home(true);
// $httpsAbsoluteHomeUrl = Url::home('https');
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use \yii\helpers\Markdown;
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

.top{ width: 100%; background: rgba(14, 196, 210, 0.99); color: #fff; height: 100px; line-height: 150px; text-align: right;}
.top span{ margin-right: 20px}


.left{ width: 260px; float: left; height: 100%; background: rgba(121, 217, 221, 0.4)}
.left ul{ list-style: none; width: 100%;}
.left ul li{ height: 40px; width: 100%; border: 1px solid #ddd; line-height: 40px; text-align: center;}
.left .selected{ background: rgba(14, 196, 210, 0.99);}
.left .selected a{ color: #fff;}


.right{ float: left; width: 1000px;}
.title{ background: rgba(14, 196, 210, 0.99); color: #fff}
.search-box{ width: 900px; margin: 0 auto; margin-top: 100px; }
</style>

<div class="top">
    <span>欢迎管理员：admin</span>
</div>

<div class="left">
    <ul>
        <li ><a href="<?php echo Url::to(['field/add'])?>">添加注册字段</a></li>
        <li class="selected"><a href="<?php echo Url::to(['field/index'])?>">查看注册字段</a></li>
        <li><a href="<?php echo Url::to(['field/upd'])?>">修改注册字段</a></li>
    </ul>
</div>

<div class="right">
    <div class="search-box">
        <table>
            <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
            <tr class="title">
                <td>ID</td>
                <td>字段名</td>
                <td>字段类型</td>
                <td>字段默认值</td>
                <td>是否必填</td>
                <td>验证规则</td>
                <td>字符数限制</td>
                <td>操作</td>
            </tr>
            <?php foreach($data as $k => $v){?>
            <tr>
                <td><?php echo $v['field_id']?></td>
                <td><?php echo $v['field_name']?></td>
                <td>
                    <?php 
                        if($v['field_type']=='input-text') echo "文本框"; 
                        if($v['field_type']=='input-radio') echo "单选框"; 
                        if($v['field_type']=='input-password') echo "密码框"; 
                        if($v['field_type']=='textarea') echo "文本域"; 
                    ?>
                </td>
                <td><?php echo $v['default_value']?></td>
                <td><?php echo $v['state']?></td>
                <td><?php echo $v['rule']?></td>
                <td><?php echo $v['min']?> ~ <?php echo $v['max']?></td>
                <td>
                    <a href="<?=Url::toRoute(['field/upd','id'=>$v['field_id']])?>">编辑</a>
                    | 
                    <a href="<?=Url::toRoute(['field/del','id'=>$v['field_id']])?>">删除</a>
                </td>
            </tr>
            <?php }?>
        </table>
    </div>
</div>