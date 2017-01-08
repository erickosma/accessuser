<?php

namespace Zoy\Accessuser\Models;


class AccessAgents extends AccessModel
{
    protected $fillable = ["access_id",
        'name',
        'browser',
        'browser_version'];
}
