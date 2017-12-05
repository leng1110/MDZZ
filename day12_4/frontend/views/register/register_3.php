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

.check_label{
    width: 600px;
    margin: 0 auto;
    margin-top: 50px;
}

.check_label p{
    width: 550px;
    margin: 0 auto;
    margin-top: 30px;
}

.check_label .intrest_label a{
    padding: 5px;
    border: 1px solid rgba(0, 150, 0, 0.55);
    border-radius: 3px;
    white-space:nowrap;
    display: inline-block;
    margin-top: 10px;
    margin-left: 10px;
    color: #666;
}

.check_label .a_selected{
    background: rgba(0, 150, 0, 0.55);
    color: #fff;
}

.check_label .a_button{
    width: 150px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background: green;
    color: #fff;
    display: inline-block;
    border: 1px solid green;
    border-radius: 5px;
    margin: 0 auto;
}

.handler-button{
    text-align: center;
}
</style>

<div class="top">
    <h2>欢迎注册</h2>
</div>

<div class="main">
    <div class="check_label">
  <!--       <form action="<?php echo Url::to(['register/success'])?>" method="post"> -->
        <h4>请选择您的兴趣标签</h4>
        <input name="_csrf-frontend" type="hidden" id="_csrf-frontend" value="<?= Yii::$app->request->csrfToken ?>">
        <p class="intrest_label">
            <!-- <a class="a_selected" href="javascript:;">乒乓球</a> -->
            <?php foreach($data as $k => $v){?>
                <a href="javascript:;" id="label" data-lid="<?=$v['l_id']?>" ><?=$v['l_name']?></a>
            <?php }?>
        </p>
        <p class="handler-button">
            <a class="a_button" href="<?php echo Url::toRoute(['register/two', 'state' => 1])?>">上一步</a>
            <input class="a_button" type="button" value="完成" id="btn" >
        </p>
    </div> <!--  </form> -->
</div>
<?php $this->beginBlock("aaa") ?>
    $(function(){
        
        $(document).on('click',"#label",function(){
            $(this).toggleClass('a_selected')   
            var str = ''
            $('.a_selected').each(function(v){
                str += $(this).attr('data-lid')+","
            })
        }) 
        $(document).on('click',"#btn",function(){
            var str = ''
            $('.a_selected').each(function(v){
                str += $(this).attr('data-lid')+","
            })
            $.ajax({
                url:"<?php echo Url::toRoute(['register/three_do']) ?>",
                data:{str:str},
                type:"post",
                success:function(msg){
                    if(msg==1){
                       //alert('恭喜你注册成功')
                        $(location).attr('href', "<?php echo Url::toRoute(['register/success']) ?>");
                    }
                }
            })
           
        })
    });
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks["aaa"], \yii\web\View::POS_END); ?>

