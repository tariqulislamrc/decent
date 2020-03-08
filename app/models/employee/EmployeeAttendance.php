<?php

namespace App\models\employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeAttendance extends Model
{
    use SoftDeletes;
}
