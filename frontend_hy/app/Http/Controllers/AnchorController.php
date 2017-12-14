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

    
}
