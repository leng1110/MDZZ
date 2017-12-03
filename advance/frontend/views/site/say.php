<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<table border="8">
	<tr>
		<td>cheng</td>
		<td>时间</td>
		<td>操作</td>
	</tr>
	<?php foreach($data as $k => $v){?>
	<tr>
		<td><?php echo $v['name']?></td>
		<td><?php echo $v['addtime']?></td>
		<td><a href="<?= Url::toRoute(['say/del','id'=>$['id']])?>">删除</a></td>
		<td><a href="<?= Url::toRoute(['say/upd','id'=>$['id']])?>">修改</a></td>
	</tr>
	<?php }?>
</table>
</body>
</html>
