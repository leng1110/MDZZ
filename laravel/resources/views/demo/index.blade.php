<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
	<h3>添加日志</h3>
<form action="add" method="get" accept-charset="utf-8">
	<table border="1" cellpadding="0" cellspacing="0">
		<tr>
			<th>日志详情：</th>
			<th><textarea name="content"></textarea></th>
		</tr>
    <tr>
        <th>添加人：</th>
        <th><input type="text" name="name"></th>
    </tr>
		<tr>
			<th>提醒时间：</th>
			<th>
				<input placeholder="请输入日期" class="laydate-icon" name="endtime" onClick="laydate({istime: true, format: 'YYYY-MM-DD hh:mm:ss'})">
			</th>
		</tr>
		<tr>
			<th>状态：</th>
			<th>
				<input type="radio" name="status" value="0">开启
				<input type="radio" name="status" value="1">关闭
			</th>
		</tr>
		<tr>
			<th colspan="2"><input type="submit" value="提交"></th>
		</tr>
	</table>
</form>
</center>
</body>
<script src="{{ URL::asset('js/laydate.js') }}"></script>
<script type="text/javascript">
!function(){
	laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
	laydate({elem: '#demo'});//绑定元素
}();

//日期范围限制
var start = {
    elem: '#start',
    format: 'YYYY-MM-DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};

var end = {
    elem: '#end',
    format: 'YYYY-MM-DD',
    min: laydate.now(),
    max: '2099-06-16',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，充值开始日的最大日期
    }
};
laydate(start);
laydate(end);

//自定义日期格式
laydate({
    elem: '#test1',
    format: 'YYYY年MM月DD日',
    festival: true, //显示节日
    choose: function(datas){ //选择日期完毕的回调
        alert('得到：'+datas);
    }
});

//日期范围限定在昨天到明天
laydate({
    elem: '#hello3',
    min: laydate.now(-1), //-1代表昨天，-2代表前天，以此类推
    max: laydate.now(+1) //+1代表明天，+2代表后天，以此类推
});
</script>

</html>
