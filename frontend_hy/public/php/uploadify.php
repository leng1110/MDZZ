<?php

//要储存的文件夹
$targetFolder = '/Image'; 

$token = time().rand(1111,9999);

if (!empty($_FILES)) {
	//获取文件后缀名
	$fix = strstr($_FILES['avatar']['name'],'.');
	//文件临时路径
	$tempFile = $_FILES['avatar']['tmp_name'];
	//新的存放地点
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $token.$fix;

	
	$fileTypes = array('jpg','jpeg','gif','png');
	$fileParts = pathinfo($_FILES['avatar']['name']);

	$namePath = $targetFolder.'/'.$token.$fix;
	if (file_exists($tempFile)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $namePath;
	} else {
		echo 'Invalid file type.';
	}
}

	//移动文件
	// move_uploaded_file($path,$targetPath);

	//移动文件 原文件将移动到新地址 原地址没有了
	// rename($tempFile,$targetFile);
	//复制文件
	// copy($tempFile,$targetFile);
	
