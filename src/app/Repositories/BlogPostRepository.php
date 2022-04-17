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
     *  получить модель для редактирвание в админ
     *
     * @param int $id
     *
     * @retrun Model
     */


    /**
     *
     * @retrun string
     */
    protected function getModelClass()
    {
        return Model::class;
    }
}
