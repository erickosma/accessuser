<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 01/02/17
 * Time: 21:37
 */

namespace Zoy\Accessuser\Bases;


use Illuminate\Support\Facades\Cache;
use Zoy\Accessuser\Models\Access;
use Illuminate\Support\Facades\DB;
use Zoy\Accessuser\Models\AccessRoutes;

class Statistic
{


    public static function all(){
        $statistics = [];
        $statistics['unique'] = self::totalUniqueAccess();
        $statistics['visits'] = self::totalVisits();
        $statistics['access_unique_day'] = self::totalUniqueAccessDay()->toArray();
        $statistics['access_visits_day'] = self::totalVisitsDay()->toArray();
        $statistics['access_unique_month'] = self::totalUniqueAccessMonth()->toArray();
        $statistics['access_visits_month'] = self::totalVisitsMonth()->toArray();
        return $statistics;
    }

    /**
     * Count total unis access
     *
     * @return mixed
     */
    public static function totalUniqueAccess()
    {
        $result = Cache::remember('totalUniqueAccess', 10, function () {
            $consolidate = new Consolidates();
            $consolidate->modelAccess();
            return  $consolidate->getRepository()
                ->all()
                ->count();
        });
        return $result;
    }


    /**
     * Total visits
     *
     * @return mixed
     */
    public static function totalVisits(){
        $consolidate = new Consolidates();
        $consolidate->modelRoute();
        return $consolidate->getRepository()
            ->all()
            ->count();
    }


    public static function totalUniqueAccessDay($month = null,$year=null){
        $consolidate = new Consolidates();
        $consolidate->modelAccess();
        return self::totalPerDay(Access::class,$month,$year);
    }

    public static function totalUniqueAccessMonth($year =null){
        $consolidate = new Consolidates();
        $consolidate->modelAccess();
        return self::totalPerMonth(Access::class,$year);
    }

    public  static function totalVisitsDay($month = null,$year=null){
        $consolidate = new Consolidates();
        $consolidate->modelRoute();
        return self::totalPerDay(AccessRoutes::class,$month,$year);
    }

    public  static function totalVisitsMonth($year =null){
        $consolidate = new Consolidates();
        $consolidate->modelRoute();
        return self::totalPerMonth(AccessRoutes::class,$year);
    }



    public  static function totalVisitsController(){
        $consolidate = new Consolidates();
        $consolidate->modelRoute();
        return AccessRoutes::select(
            DB::raw('count(id) as total'),
            DB::raw("controller"))
            ->groupby('controller')
            ->get();
    }

    public static function totalPerDay($model,$month = null,$year=null)
    {
        if (empty($month)) {
            $month =str_pad(date("m"),2,"0",STR_PAD_LEFT);
        }
        if (empty($year)) {
            $year = date("Y");
        }
        return $model::select(
            DB::raw('count(id) as total'),
            DB::raw(self::dayMonth("updated_at") . " as daymonth"))
            ->groupby('daymonth')
            ->whereMonth('updated_at', '=', $month)
            ->whereYear('updated_at', '=', $year)
            //->toSql();
            ->get();
    }


    public static function totalPerMonth($model,$year=null)
    {
        if (empty($year)) {
            $year = date("Y");
        }
        return $model::select(
            DB::raw('count(id) as total'),
            DB::raw(self::monthYear("updated_at") . " as monthyear"))
            ->whereYear('updated_at', '=', $year)
            ->groupby('monthyear')
            ->get();
    }

    protected static function monthYear($campo)
    {
        $drive = DB::connection()->getDriverName();
        if ($drive == "sqlite") {
            return "strftime('%Y-%m', {$campo})";
        }
        return "CONCAT_WS('-',MONTH({$campo}),YEAR({$campo}))";
    }

    protected static function dayMonth($campo)
    {
        $drive = DB::connection()->getDriverName();
        if ($drive == "sqlite") {
            return "strftime('%d-%m', {$campo})";
        }
        return "CONCAT_WS('-',DAY({$campo}),MONTH({$campo}))";
    }
}