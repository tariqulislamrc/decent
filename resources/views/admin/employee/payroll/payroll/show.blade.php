<div class="row">

    <div class="col-md-4">

        <table class="table bordered table-striped">

            @php

                $attendance_types = App\models\employee\EmployeeAttendanceType::where('is_active', 1)->get();

            @endphp

            @foreach ($attendance_types as $item)

                @php
                    
                    $present = 0;
                    $absent = 0;
                    $holiday = 0;
                    $default_holiday = 0;

                @endphp

                <tr>

                    <td>

                        {{$item->name}} ( {{$item->alias}} ) 

                        <span class="float-right">

                            @php


                                $dt = Carbon\Carbon::create($start_date);
                                $dt2 = Carbon\Carbon::create($end_date);

                                $period = Carbon\CarbonPeriod::create($dt , $dt2);
                                
                                foreach($period as $date) {
                                    if($date->isWeekend()) {
                                        $query = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->where('date_of_attendance', $date)->where('employee_attendance_type_id', 1)->first();
                                        if(!$query) {
                                            $default_holiday = $default_holiday + 1;
                                        }
                                    }
                                }

                                $holiday = $holiday + $default_holiday;

                            
                                $query = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->whereBetween('date_of_attendance', [$start_date, $end_date])->where('employee_attendance_type_id', $item->id)->where('employee_attendance_type_id', '!=', 3)->count();

                                // check present date
                                $check_present = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->whereBetween('date_of_attendance', [$start_date, $end_date])->where('employee_attendance_type_id', 1)->count();

                                // check the default holiday


                                $present = $check_present + $present;

                                // check holiday

                                $check_holiday = App\models\holiday\Holiday::whereBetween('date', [$start_date, $end_date])->get();

                                // check employee is present on the holiday

                                foreach($check_holiday as $holi) {

                                    $holiday_date = $holi->date;

                                    $check = App\models\employee\EmployeeAttendance::where('employee_id', $salary->employee_id)->where('date_of_attendance', $holiday_date)->first();

                                    if(!$check) {

                                        $holiday = $holiday + 1;
                                    
                                    }

                                }

                            @endphp

                            @if ($item->type != 'Holiday')
                                {{$query}}
                            @endif

                            @if ($item->type == 'Holiday')
                                {{$holiday}}
                            @endif

                           
                        </span>

                    </td>

                </tr>

            @endforeach

        </table>

    </div>

    <div class="col-md-8">
        
        <table class="table table-bordered table-striped">

            <tr>

                <th colspan="2" class="text-center">Name</th>

                <td colspan="2" class="text-center">{{find_employee_name_using_employee_id($salary->employee_id)}}</td>

            </tr>

            <tr>

                <th colspan="2" class="text-center">Designation</th>
                
                <td colspan="2" class="text-center">{{employee_designation($salary->employee_id)}} ( <strong>{{employee_department($salary->employee_id)}}</strong> )</td>

            </tr>

            <tr>

                <th colspan="2" class="text-center">From - To</th>

                <td colspan="2" class="text-center">{{carbonDate($start_date)}} - {{carbonDate($end_date)}}</td>

            </tr>

        </table>

        <div class="row">

            <div class="col-md-6 table-responsive">

                <table class="table table-bordered table-striped">
                    
                    <tr>

                        <th width="25%" class="text-center">Earning</th>

                        <th width="25%" class="text-center">Amount</th>

                    </tr>

                    @php

                        $total_paid_amount = 0;
                        $total_earning = 0;
                        $total_deduction = 0;

                        $items = App\models\employee\EmployeeSalaryDetail::where('employee_salary_id', $salary->id)->get();

                        $start_date = Carbon\Carbon::parse($start_date);
                        $end_date = Carbon\Carbon::parse($end_date);
                        $date_diff = $start_date->diffInDays($end_date);
                        $date_diff = $date_diff + 1;

                    @endphp

                    @foreach ($items as $item)
                        @if ($item->amount != '')

                            @php
                                $template_id = $item->payroll_template_detail_id;
                                $templaate_details =App\models\employee\PayrollTemplateDetail::where('id', $template_id)->first();

                                if($templaate_details) {
                                    $pay_head_id = $templaate_details->pay_head_id;
                                    $template = App\models\employee\PayHead::where('id', $pay_head_id)->where('type', 'Earning')->first();
                                }
                            @endphp

                            @if ($template)
                                @php

                                    $total_amount = $item->amount;
                                    $per_day_amount = $total_amount / $date_diff ;

                                    $total_present = $present + $holiday;

                                    $amount = $total_present * $per_day_amount ;
                                    $amount = number_format($amount, 2);

                                    $total_earning = $total_earning + $amount;

                                @endphp
                                <tr>
                                    <td class="text-center text-success" width="25%">{{$template->name}}</td>
                                    <td class="text-center" width="25%"> {{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$amount}}</td>
                                </tr>
                            @endif

                        @endif
                    @endforeach

                </table>
            </div>
    
            <div class="col-md-6 table-responsive">

                <table class="table table-bordered table-striped">

                    <tr>

                        <th width="25%" class="text-center">Deduction</th>

                        <th width="25%" class="text-center">Amount</th>

                    </tr>

                    @php

                        $items = App\models\employee\EmployeeSalaryDetail::where('employee_salary_id', $salary->id)->get();
                    @endphp

                    @foreach ($items as $item)
                        @if ($item->amount != '')

                            @php
                                $template_id = $item->payroll_template_detail_id;
                                $templaate_details =App\models\employee\PayrollTemplateDetail::where('id', $template_id)->first();

                                if($templaate_details) {
                                    $pay_head_id = $templaate_details->pay_head_id;
                                    $template = App\models\employee\PayHead::where('id', $pay_head_id)->where('type', 'Deduction')->first();
                                }
                            @endphp

                            @if ($template)
                                @php

                                    $total_amount = $item->amount;
                                    $per_day_amount = $total_amount / $date_diff ;

                                    $total_present = $present + $holiday;

                                    $amount = $total_present * $per_day_amount ;
                                    $amount = number_format($amount, 2);

                                    $total_deduction = $total_deduction + $amount;

                                @endphp
                                <tr>
                                    <td class="text-center text-danger" width="25%">{{$template->name}}</td>
                                    <td class="text-center" width="25%"> {{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$amount}}</td>
                                </tr>
                            @endif

                        @endif

                    @endforeach
                        
                </table>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 table-responsive">

                <table class="table table-bordered table-striped">

                    <tr>

                        <th width="50%" class="text-center">Total Earning</th>

                        <th with="50%" class="text-center">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_earning}}</th>

                    </tr>

                </table>

            </div>

            <div class="col-md-6 table-responsive">

                <table class="table table-bordered table-striped">

                    <tr>

                        <th width="50%" class="text-center">Total Deduction</th>

                        <th with="50%" class="text-center">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_deduction}}</th>

                    </tr>

                </table>

            </div>

        </div>
    
        <div class="col-md-12 table-responsive">

            <table class="table table-bordered table-stringped">

                <tr>

                    <th width="50%" class="text-center">Net Salary</th>

                    <th with="50%" class="text-center">{{get_option('currency') && get_option('currency') != '' ? get_option('currency') : 'BDT' }} {{$total_earning + $total_deduction}}</th>

                </tr>

            </table>

        </div>
    
    </div>

</div>
