<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<h2>展示留言</h2>
	<form action="/demo/add" method="post" accept-charset="utf-8">
	<table>
		<tr><textarea name="content"></textarea></tr>
		<tr><input type="submit" value="发表"></tr>
    	<?php foreach ($res as $key => $value): ?>	
		<tr>
			<th><?=$value['name'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<th><?=$value['content'] ?>&nbsp;&nbsp;&nbsp;&nbsp;</th>
			<td><?= date('Y/m/d',$value['time'])?></td>
			<td>
				<a href="/demo/del?id=<?=$value['id']?>">删除</a>
				<a href="/demo/update?id=<?=$value['id']?>">修改</a>
			</td>
		</tr>
    	<?php endforeach ?>
	</table>
	<div class="pagination-part">
	    <nav>
	        <?php
	        echo yii\widgets\LinkPager::widget([ 
    			'pagination' => $data['pages'], 
    			'nextPageLabel' => '下一页', 
    			'prevPageLabel' => '上一页', 
			]);
	        ?>
	    </nav>
	</div>
	</form>
</center>	
</body>
</html>