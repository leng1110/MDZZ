<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
<h3>日志展示</h3>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<th>日志详情</th>
		<th>添加人</th>
		<th>添加时间</th>
		<th>执行时间</th>
		<th>日志状态</th>
	</tr>
	@foreach($data as $key => $val)
	<tr>
		<th>{{$val->content}}</th>
		<th>{{$val->name}}</th>
		<th><?= date('Y/m/d H:i:s',$val->addtime) ?></th>
		<th><?= date('Y/m/d H:i:s',$val->endtime) ?></th>
		<th>{{$val->status == 0 ? '开启' : '关闭' }}</th>
	</tr>
	@endforeach
</table>
</center>
</body>
</html>
