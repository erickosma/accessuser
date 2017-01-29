<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 18/12/16
 * Time: 14:49
 */

namespace Zoy\Accessuser\Bases\Repository;



use Zoy\Accessuser\Models\Access;


class AccessRepository extends BaseRepository
{


    /**
     * @return string
     */
    public function model()
    {
        return Access::class;
    }


    public function getFields()
    {
        if (property_exists($this->model, 'fields')) {
            return $this->model->fields;
        }
        return [];
    }

    /**
     * @param array $columns
     * @param null $sort
     * @param null $filter
     * @param null $perPage
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function show($columns = [], $sort = null, $filter = null, $perPage=null)
    {
        // handle sort option
        if (!empty($sort)) {
            list($sortCol, $sortDir) = explode('|', $sort);
            $query = $this->model->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->model->orderBy('id', 'asc');
        }
        if (empty($columns)) {
            $columns = $this->model->getFillable();
        }

        if (!empty($filter) && !empty($columns)) {
            $query->where(function ($q) use ($filter, $columns) {
                $value = "%{$filter}%";
                $q->where(array_shift($columns), 'like', $value);

                if (!empty($columns)) {
                    foreach ($columns as $field) {
                        $q->orWhere($field, 'like', $value);
                    }
                }
            });
        }
        $perPage = !empty($perPage) ? (int)$perPage : null;
        return $query->paginate($perPage);
    }


}