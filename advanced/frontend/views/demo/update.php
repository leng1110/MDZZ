<center>
	<form action="/demo/updateto" method="post" accept-charset="utf-8">
		<table>
			<tr>留言内容：<textarea name="content"><?= $res['content']?></textarea><input type="hidden" value="<?= $res['id']?>" name="id" /></tr>
			<tr><input type="submit" value="修改" /></tr>
		</table>
	</form>
</center>