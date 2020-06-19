<?php

namespace App\models\employee;

use Illuminate\Database\Eloquent\Model;

class Payrolls extends Model
{
<<<<<<< HEAD
    //
=======
    // relation with salary structure
    public function salary() {
        return $this->belongsTo(EmployeeSalary::class, 'employee_salary_id', 'id');
    }
>>>>>>> cc56cbbef62decc173aa33e4aa6b615c608bc4c1
}
