<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
public function run() {
		$data = [
			// user permission
			['name' => 'employee.view'],

			// employee_attendance
			['name' => 'employee_attendance.view'],
			['name' => 'employee_attendance.create'],
			['name' => 'employee_attendance.update'],
			['name' => 'employee_attendance.delete'],

			// employee_payroll
			['name' => 'employee_payroll.view'],

			// employee_payroll_transection
			['name' => 'employee_payroll_transection.view'],
			['name' => 'employee_payroll_transection.create'],
			['name' => 'employee_payroll_transection.update'],
			['name' => 'employee_payroll_transection.delete'],

			// employee_payroll_init
			['name' => 'employee_payroll_init.view'],
			['name' => 'employee_payroll_init.create'],
			['name' => 'employee_payroll_init.update'],
			['name' => 'employee_payroll_init.delete'],
			['name' => 'employee_payroll_init.print'],

			// employee_payroll_salary_structure
			['name' => 'employee_payroll_salary_structure.view'],
			['name' => 'employee_payroll_salary_structure.create'],
			['name' => 'employee_payroll_salary_structure.update'],
			['name' => 'employee_payroll_salary_structure.delete'],

			// employee_payroll_template
			['name' => 'employee_payroll_template.view'],
			['name' => 'employee_payroll_template.create'],
			['name' => 'employee_payroll_template.update'],
			['name' => 'employee_payroll_template.delete'],

			// holiday
			['name' => 'holiday.view'],
			['name' => 'holiday.create'],
			['name' => 'holiday.update'],
			['name' => 'holiday.delete'],

			// user permission
			['name' => 'user.view'],
			['name' => 'user.create'],
			['name' => 'user.update'],
			['name' => 'user.delete'],

			// Language Permission
			['name' => 'language.view'],
			['name' => 'language.create'],
			['name' => 'language.update'],
			['name' => 'language.delete'],

			// Role Permission
			['name' => 'role.view'],
			['name' => 'role.create'],
			['name' => 'role.update'],
			['name' => 'role.delete'],

			// Employee Permission
			['name' => 'employee.view'],

			// Employee Department Permission
			['name' => 'employee_departmeent.view'],
			['name' => 'employee_departmeent.create'],
			['name' => 'employee_departmeent.update'],
			['name' => 'employee_departmeent.delete'],

			// Emplooyee Document Permission
			['name' => 'employee_document.view'],
			['name' => 'employee_document.create'],
			['name' => 'employee_document.update'],
			['name' => 'employee_document.delete'],

			// Setting Permission
			['name' => 'setting.view'],
			['name' => 'setting.update'],

			// System Configuration Permission
			['name' => 'system_configuration.view'],
			['name' => 'system_configuration.update'],

			// Mail Configuration Permission
			['name' => 'mail_configuration.view'],
			['name' => 'mail_configuration.update'],

			// SMS Configuration Permission
			['name' => 'sms_configuration.view'],
			['name' => 'sms_configuration.update'],

			// Module Configuration Permission
			['name' => 'module_configuration.view'],
			['name' => 'module_configuration.update'],

			// Database Backup Permission
			['name' => 'backup.view'],

			// Employee Catagory 
			['name' => 'employee_category.view'],
			['name' => 'employee_category.create'],
			['name' => 'employee_category.update'],
			['name' => 'employee_category.delete'],

			// Employee Designation
			['name' => 'employee-designation.view'],
			['name' => 'employee-designation.create'],
			['name' => 'employee-designation.update'],
			['name' => 'employee-designation.delete'],

			// Employee Document Type
			['name' => 'employee_document_type.view'],
			['name' => 'employee_document_type.create'],
			['name' => 'employee_document_type.update'],
			['name' => 'employee_document_type.delete'],

			// Employee Leave Type
			['name' => 'employee_leave_type.view'],
			['name' => 'employee_leave_type.create'],
			['name' => 'employee_leave_type.update'],
			['name' => 'employee_leave_type.delete'],

			// Employee Leave
			['name' => 'employee_leave.view'],
			['name' => 'employee_leave.create'],
			['name' => 'employee_leave.update'],
			['name' => 'employee_leave.delete'],

			// Employee Leave Allocation
			['name' => 'employee_leave_allocation.view'],
			['name' => 'employee_leave_allocation.create'],
			['name' => 'employee_leave_allocation.update'],
			['name' => 'employee_leave_allocation.delete'],

			// Employee Leave Request
			['name' => 'employee_leave_request.view'],
			['name' => 'employee_leave_request.create'],
			['name' => 'employee_leave_request.update'],
			['name' => 'employee_leave_request.delete'],

			// Employee Attendance Type
			['name' => 'employee_attendance_type.view'],
			['name' => 'employee_attendance_type.create'],
			['name' => 'employee_attendance_type.update'],
			['name' => 'employee_attendance_type.delete'],

			// Employee ID Card 
			['name' => 'employee_id_card.view'],
			['name' => 'employee_id_card.create'],
			['name' => 'employee_id_card.update'],
			['name' => 'employee_id_card.delete'],


			//  Employee Payhead	
			['name' => 'employee_payhead.view'],
			['name' => 'employee_payhead.create'],
			['name' => 'employee_payhead.update'],
			['name' => 'employee_payhead.delete'],

			//  Employee List
			['name' => 'employee_list.view'],
			['name' => 'employee_list.create'],
			['name' => 'employee_list.update'],
			['name' => 'employee_list.delete'],
			['name' => 'employee_list.action'],

			// Document
			['name' => 'document.view'],
			['name' => 'document.create'],
			['name' => 'document.update'],
			['name' => 'document.delete'],

			// Qualification
			['name' => 'qualification.view'],
			['name' => 'qualification.create'],
			['name' => 'qualification.update'],
			['name' => 'qualification.delete'],

			// Employee Account
			['name' => 'employee_account.view'],
			['name' => 'employee_account.create'],
			['name' => 'employee_account.update'],
			['name' => 'employee_account.delete'],

			// Employee Designation
			['name' => 'designation.view'],
			['name' => 'designation.create'],
			['name' => 'designation.update'],
			['name' => 'designation.delete'],


		];

		$insert_data = [];
		$time_stamp = Carbon::now();
		foreach ($data as $d) {
			$d['guard_name'] = 'web';
			$d['created_at'] = $time_stamp;
			$insert_data[] = $d;
		}
		Permission::insert($insert_data);
	}
}
