<?php  
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Support\Facades\DB;  
use Sensitive;
class Reg extends Model  
{  
    protected $tableName = 'reg';  
    public function getInfo($input){
        //添加数据
        $data['username']=$input['username'];
        // $data['sex']=$input['sex'];
        // $data['hobby']=implode(',',$input['hobby']);
        // $data['age']=$input['age'];
        $data['descs'] = $input['descs'];
        //进行过滤  字段过滤
        $interference = ['&', '*'];
        $filename = 'D:\phpStudy\WWW\yun\vendor\yankewei\laravel-sensitive\demo\words.txt'; //每个敏感词独占一行
        Sensitive::interference($interference); //添加干扰因子
        Sensitive::addwords($filename); //需要过滤的敏感词
        //重新赋值
        $data['descs'] = Sensitive::filter($data['descs']);
        return DB::table($this->tableName)->insert($data);
        // return $id = DB::table('reg')->insertGetId($data); 
    }
    
    public function showInfo()
    {
        //查询所有数据
        return DB::table($this->tableName)->get();
    }
    public function delRow($id)
    {
        //删除
        return DB::table($this->tableName)->where(['id'=>$id])->delete();
    }


    public function getRow($id){
        //查询一条数据
        $row=DB::table($this->tableName)->where(['id'=>$id])->first();
        // $row->hobby=explode(',', $row->hobby);
        return $row;
    }
    public function saveRow($post){
        //修改数据
        $id=$post['id'];
        $data['username']=$post['username'];
        $data['descs']=$post['descs'];
        // $data['sex']=$post['sex'];
        // $data['hobby']=implode(',',$post['hobby']);
        // $data['age']=$post['age'];
        return DB::table($this->tableName)->where(['id'=>$id])->update($data);
    }
}
?>