<center>
	<form action="/site/updateto" method="post" accept-charset="utf-8">
		<table>
			<tr>姓名：<input type="text" name="goods_name" value="<?= $res['goods_name']?>" /><input type="hidden" value="<?= $res['id']?>" name="id" /></tr>
			<tr>性别：<input type="text" name="goods_price" value="<?= $res['goods_price']?>" /></tr>
			<tr><input type="submit" value="修改" /></tr>
		</table>
	</form>
</center>