<?php

namespace App\Model;
use DB;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];
    //

    public function addCategories(Array $data) 
    {
        try {
            $rs = [];
            $table = $this->getTable();
            foreach ($data as $key => $value) {
                $id = DB::table($table)->insertGetId($value);
                array_push($rs,$id);
            }
            return $rs;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
