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

class AnchorController extends Controller
{
	//主播资料
    public function anchor_info()
    {	
    	$curd = new Curd();
    	$data = $curd->getRow('category','parent_id',0);
        return view('register/anchor_register_to',['cate' => $data]);
    }

    public function anchor_info_add()
    {
    	$curd = new Curd();
    	$data = Input::get();
    	unset($data['_token']);

    	if (session('user_id') != null) {
    		$data['user_id'] = session('user_id');
    	}

    	if ($curd->add('anchor_exa',$data)) {
            echo '<script>alert("保存成功");location.href="/"</script>';
    	}
        echo '<script>alert("保存失败");location.href="anchor_info"</script>';

    }

    
}
