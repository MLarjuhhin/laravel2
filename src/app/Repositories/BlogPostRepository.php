<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
/**
 *  Class BlogCategoryRepository
 *
 * @package App\Repositories
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
        $perPage=25;
        $col=[
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];

        $result=$this->startConditions()
            ->select($col)
            ->orderBy('id','DESC')
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
}
