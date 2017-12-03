<center>
    <table border="1">
    <tr>
        <td>编号</td>
        <td>姓名</td>
        <td>性别</td>
        <td>操作</td>
    </tr>
    <?php foreach ($data as $key => $value): ?>
    <tr>
        <td><?php echo $value['id'] ?></td>
        <td><?php echo $value['goods_name'] ?></td>
        <td><?php echo $value['goods_price'] ?></td>
        <td>
            <a href="/site/del?id=<?php echo $value['id'] ?>">删除</a>
            <a href="/site/update?id=<?php echo $value['id'] ?>">修改</a>
        </td>
    </tr>
    <?php endforeach ?>
    <tr><td colspan="2"><a href="/site/add/">添加</a></td></tr>
    </table>
</center>