<?php

namespace App\models\employee;

use Illuminate\Database\Eloquent\Model;

class PayrollTransaction extends Model
{
<<<<<<< HEAD
    //
=======
    // Relation with payroll
    public function payroll() {
        return $this->belongsTo(Payrolls::class, 'payroll_id', 'id');
    }

    // Relation with Employee
    public function employee() {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
>>>>>>> cc56cbbef62decc173aa33e4aa6b615c608bc4c1
}
