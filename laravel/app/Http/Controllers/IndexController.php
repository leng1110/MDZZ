<?php

namespace App\Http\Controllers;
//接入数据库
use DB;
//接值Input
use Illuminate\Support\Facades\Input;
//接入redis
use Illuminate\Support\Facades\Redis;


use App\User;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //登陆展示页面
    public function index()
    {
        return view('demo/index');
    }

    //添加
    public function add()
    {
        $data = Input::get();
        $data['addtime'] = time();
        
        $sql = DB::table('laravel_one')->insert($data);
        if($data){
            $data = json_encode($data);
            Redis::lpush('rizhi',$data);
            echo '<script>alert("成功添加");location.href="'.'show'.'"</script>';
        }else{
            echo '有问题，快修改一下！';
        }
        return view('demo/show');

    }

    //展示
    public function show()
    {   
        $data = Redis::rpop('rizhi');
        $res = json_decode($data,true);
        var_dump($res);
        $sql = DB::table('laravel_one')->get();
        return view('demo/show',['data'=>$sql]);
    }


}
