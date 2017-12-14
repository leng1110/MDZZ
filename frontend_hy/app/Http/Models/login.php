<?php  
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Support\Facades\DB;  
use Sensitive;
class Login extends Model  
{  
    public $tableName = ""; 

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
    
    //查询所有数据
    public function showInfo()
    {
        return DB::table($this->dbname)->get();
    }

    //删除
    public function delRow($id)
    {
        return DB::table($this->dbname)->where(['id'=>$id])->delete();
    }

    //查询一条数据
    public function getRow($id)
    {
        $row=DB::table($this->dbname)->where(['id'=>$id])->first();
        return $row;
    }

    //修改数据
    public function saveRow($post)
    {
        $id=$post['id'];
        $data['username']=$post['username'];
        $data['descs']=$post['descs'];
        // $data['sex']=$post['sex'];
        // $data['hobby']=implode(',',$post['hobby']);
        // $data['age']=$post['age'];
        return DB::table($this->dbname)->where(['id'=>$id])->update($data);
    }

    /**
     * 数组转换对象
     *
     * @param $e 数组
     * @return object|void
     */
    public function arrayToObject($e)
    {

        if (gettype($e) != 'array') return;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object')
                $e[$k] = (object)$this->arrayToObject($v);
        }
        return (object)$e;
    }

    /**
     * 对象转换数组
     *
     * @param $e StdClass对象实例
     * @return array|void
     */
    public function objectToArray($e)
    {
        $e = (array)$e;
        foreach ($e as $k => $v) {
            if (gettype($v) == 'resource') return;
            if (gettype($v) == 'object' || gettype($v) == 'array')
                $e[$k] = (array)$this->objectToArray($v);
        }
        return $e;
    }

}