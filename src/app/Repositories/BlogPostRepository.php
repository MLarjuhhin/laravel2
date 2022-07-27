<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
/**
 * Class BlogPostRepository
 *
 * @package App\Repositories
 * @method Model startConditions()
 */
class BlogPostRepository extends CoreRepository
{
    /**
     *  ырнуть все статьи
     *
     *
     * @retrun LenghtAwarePaginator
     */
    public function getAllWithPaginator(){
    
        $perPage = 25;
        $col     = ['id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',];
    
        $result = $this->startConditions()
            ->select($col)
            ->orderBy('id', 'DESC')
            //v1
            //->with(['category','user'])
            //v2
            ->with(['category' => function ($q) {
            
                $q->select(['id',
                    'title']);
            },
                'user:id,name',])
            ->paginate($perPage);
    
        return $result;
    }

    /**
     *
     * @retrun string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
    
    
    public function getEdit($id){
        return $this->startConditions()->find($id);
    }
}
