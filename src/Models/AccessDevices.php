<?php

namespace Zoy\Accessuser\Models;


class AccessDevices extends AccessModel
{

    protected $fillable = ["access_id", "kind", "model", "platform", "platform_version", "is_mobile", "is_robot"];

}
