<?php

namespace App\Repositories;

use App\Models\BlogCategoty as Model;
use Illuminate\Database\Eloquent\Collection;

class BlogCategoryRepository extends CoreRepository
{
    
    protected function getModelClass()
    {
        
        return Model::class;
    }
    
    public function getEdit($id)
    {
        
        return $this->startCondition()
            ->find($id);
    }
    
    public function getForComboBox()
    {
        
//        return $this->startCondition()
//            ->all();
        
        
        $fields=implode(",",['id','CONCAT(id, ". ", title) as id_title']);
     
        $result=$this->startCondition()
            ->selectRaw($fields)
            ->toBase()
            ->get();
        
      
            return $result;
    }
    
    public function getAllWithPaginate($perPage = null)
    {
        
        $col = [
            'id',
            'title',
            'parent_id'
        ];
        
        $result = $this->startCondition()
            ->select($col)
            ->paginate($perPage);
        
        
        return $result;
    }
}