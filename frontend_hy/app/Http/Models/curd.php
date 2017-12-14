<?php  
namespace App\Http\Models;
use Illuminate\Database\Eloquent\Model;  
use Illuminate\Support\Facades\DB;  
use Sensitive;
class Curd extends Model  
{  
    public $tableName = ""; 

    
    
    //添加
    public function add($dbname,$data)
    {
        return DB::table($dbname)->insert($data);

    }

    //删除
    public function delRow($id)
    {
        return DB::table($this->dbname)->where(['id'=>$id])->delete();
    }

    //where条件查询
    public function getRow($dbname,$name,$id)
    {
        $row=DB::table($dbname)->where([''.$name.''=>$id])->get();
        $data = $row->toArray();
    	$n_data = array_map('get_object_vars', $data);
        return $n_data;
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