<?php
/**
 * Created by PhpStorm.
 * User: zoy
 * Date: 01/02/17
 * Time: 21:37
 */

namespace Zoy\Accessuser\Bases;


use Zoy\Accessuser\Models\Access;
use Illuminate\Support\Facades\DB;

class Statistic
{

    public static function totalAccess()
    {
        $consolidate = new Consolidates();
        $consolidate->modelAccess();
        return $consolidate->getRepository()
            ->all()
            ->count();
    }

    public static function totalAccessPerDay($month = null,$year=null)
    {
        if (empty($month)) {
            $month = date("m");
        }
        $consolidate = new Consolidates();
        $consolidate->modelAccess();
        return Access::select(
            DB::raw('count(id) as total'),
            DB::raw(self::dayMonth("created_at") . " as daymonth"))
            ->groupby('daymonth')
            ->get();
    }


    public static function totalAccessPerMonth()
    {
        $consolidate = new Consolidates();
        $consolidate->modelAccess();
        return Access::select(
            DB::raw('count(id) as total'),
            DB::raw(self::monthYear("created_at") . " as monthyear"))
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
            return "strftime('%m-%d', {$campo})";
        }
        return "CONCAT_WS('-',DAY({$campo}),MONTH({$campo}))";
    }
}