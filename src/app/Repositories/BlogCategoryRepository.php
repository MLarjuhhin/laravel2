<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
/**
 *  Class BlogCategoryRepository
 *
 * @package App\Repositories
 */
class BlogCategoryRepository extends CoreRepository
{
    /**
     *  получить модель для редактирвание в админ
     *
     * @param int $id
     *
     * @retrun Model
     */

    public function getEdit($id)
    {
        return $this->startConditions()->find($id);
    }

    /**
     *  получить список категории для выпадающего списка
     *
     * @retrun Collectio
     */
    public function getForComboBox()
    {
        $columns=implode(
            ',',
            ['id','CONCAT(id,". ",title) AS id_title']
        );
      //  $result[]=$this->startConditions()->call();
//        $result[]=$this
//            ->startConditions()
//            ->select('blog_categories.*',
//                DB::raw('id','CONCAT(id,". ",title) AS id_title')
//            )
//            ->toBase()
//            ->get();

            $result=$this
                ->startConditions()
                ->selectRaw($columns)
                ->toBase()
                ->get();

return $result;
    }

    /**
     *  получить категории для выводо по страночно
     *
     * @param int|null $id
     *
     * @retrun Model
     */
    public function getAllWithPaginate($perPage = null)
    {

        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
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
