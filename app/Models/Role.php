<?php

namespace App\Models;

use App\Services\Authorization\Traits\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, HasPermission;

    protected $guarded = [];
}
