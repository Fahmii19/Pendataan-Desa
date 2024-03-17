<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class PermissionModel extends SpatiePermission
{
    protected $connection = 'pgsql';
}
