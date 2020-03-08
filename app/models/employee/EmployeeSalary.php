<?php

namespace App\models\employee;

use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function payroll_template() {
        return $this->belongsTo(PayrollTemplate::class);
    }
}
