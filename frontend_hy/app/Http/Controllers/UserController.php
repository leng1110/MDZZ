<?php

namespace App\Http\Controllers;
//接入数据库
use DB;
//接值Input
use Illuminate\Support\Facades\Input;
// //接入redis
// use Illuminate\Support\Facades\Redis;

//引入model
use App\Http\Models\Curd;

use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //用户注册
    public function user_register()
    {
        return view('register/register');
    }

    public function user_register_to()
    {	
        $curd = new Curd();
    	//获取值
    	$data = Input::get();

    	if($data['user_pwd'] == null OR $data['user_name'] == null){
			echo "<script>alert('账号密码不得为空');location.href='user_register'</script>";
		}

        $n_data = $curd->getRow('user','user_name',$data['user_name']);
    	if($n_data != null){
    		echo "<script>alert('该手机号已经注册');location.href='user_register'</script>";
    	}

		if($data['user_pwd'] != $data['user_pwd_to']){
			echo "<script>alert('两次输入的密码不一致');location.href='user_register'</script>";
		}

    	unset($data['_token']);
    	unset($data['user_pwd_to']);
        $sql = DB::table('user')->insert($data);
        if($sql){
            echo '<script>alert("注册成功");location.href="/"</script>';
        }else{
            echo '有问题，快修改一下！';
        }
    }

    //用户登录
    public function user_login()
    {
    	return view('login/login');
    }

    public function user_login_to()
    {

        $curd = new Curd();

    	$data = Input::get();

        $n_data = $curd->getRow('user','user_name',$data['user_name']);
    	if($n_data == null){
    		echo '<script>alert("账号不正确");</script>';
	        return view('login/login');
    	}
    	
        $p_data = $curd->getRow('user','user_pwd',$data['user_pwd']);
    	if($p_data == null){
    		echo '<script>alert("密码不正确");location.href="user_login"</script>';
    	}
    	//登陆后个人信息的展示
        $n_data = $curd->getRow('info','user_id',$p_data[0]['user_id']);
    	if($n_data == null){
    		session(['user_id' => $p_data[0]['user_id']]);
    	}else{
    		session(['user_id' => $n_data[0]['nickname']]);
    	}
    	echo '<script>location.href="/"</script>';
    }

    //用户退出
    public function user_del()
    {
    	session()->forget('user_id');
    	echo '<script>location.href="/"</script>';
    }

    //用户信息
    public function userinfo_add()
    {
    	$data = Input::get();
    	unset($data['_token']);
    	$data['user_id'] = session('user_id');
    	// var_dump($data);die;
        $sql = DB::table('info')->insert($data);
        if($sql){
    		echo '<script>alert("保存成功");location.href="/"</script>';
        }

    }


}
