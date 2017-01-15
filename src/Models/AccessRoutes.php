<?php

namespace Zoy\Accessuser\Models;


class AccessRoutes extends AccessModel
{
    protected $fillable = ["access_id", "controller", "action" ,  "name",  "path", "is_ajax", "time"];
}
