<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 03/01/17
 * Time: 21:13
 */

namespace Zoy\Accessuser\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


abstract class AccessModel extends Model
{


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Prefix table
     *
     * @var
     */
    protected  $prefix;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection;

    public function __construct(array $attributes = []){
        parent::__construct($attributes);
        $this->connection = config('accessuser.database.connection');
        $this->setTable(app('accessuser.prefix'));
    }
    /**
     * @param string $table
     */
    public function setTable($prefix='')
    {
        $this->prefix =$prefix;
        $name = str_replace('\\', '', Str::snake(Str::plural(class_basename($this))));
        $tableName = $prefix.$name;
        $this->table = $tableName;
    }


    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return static
     */
    public static function create(array $attributes = [])
    {
        $model = new static($attributes);
        $model->setTable(app('accessuser.prefix'));
        $model->save();
        return $model;
    }

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale(config('app.locale'));
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone'))
            ->format("d/m/Y H:i:s")
        ;
    }


}