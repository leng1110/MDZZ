<?php

//要储存的文件夹
$targetFolder = '/Image'; 
//文件名字
$token = time().rand(1111,9999);

if (!empty($_FILES)) {
	//文件路径
	$name = $_FILES['avatar']['name'];
	$path = $_FILES['avatar']['tmp_name'];
	$tempFile = $path.'/'.$name;

	//要存储的文件夹路径
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $token.'.jpg';

	$fileTypes = array('jpg','jpeg','gif','png');
	$fileParts = pathinfo($_FILES['avatar']['name']);

	// if (in_array($fileParts['avatar']['tmp_name'],$fileTypes)) {
		move_uploaded_file($name,$targetFile);
	// 	echo '1';
	// } else {
	// 	echo 'Invalid file type.';
	// }

	//移动文件
	// move_uploaded_file($name,$targetFile);

	//移动文件 原文件将移动到新地址 原地址没有了
	// rename($tempFile,$targetFile);
	//复制文件
	// copy($tempFile,$targetFile);
	
}
