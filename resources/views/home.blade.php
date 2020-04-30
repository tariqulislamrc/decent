@extends('layouts.app', ['title' => 'Dahsboard', 'modal' => false])

{{-- Header Option --}}
@section('page.header')
    <div class="app-title">
        <div>
            <h1 data-toggle="tooltip" data-placement="bottom" title="Decent Footware Management Software Dashboard"><i class="fa fa-dashboard mr-4"></i>{{_lang('Dashboard')}}</h1>
            <p>{{_lang('Dashboard for Decent Footware')}} </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('home') }}</li>
        </ul>
    </div>
@stop

@section('content')
<!-- Basic initialization -->

    <div class="row">
        
    </div>

    <div class="card border border-danger">
        <div class="card-header text-center"><h4>{{_lang('Employee Section')}} </h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-anchor fa-3x"></i>
                        <div class="info">
                            <h4>{{_lang('Total Employee Category')}} </h4>
                            <p><b>
                            @php
                                $category = App\Models\Employee\EmployeeCategory::get();
                                echo count($category);
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>
                <!-- Short Question -->
                <div class="col-md-4">
                    <div class="widget-small info coloured-icon"><i class="icon fa fa-university fa-3x"></i>
                        <div class="info">
                            <h4>Total Employee Department</h4>
                            <p><b>
                            @php
                                $users = App\Models\Employee\Department::get();
                                echo count($users);
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>
                        
                <!-- True False -->
                <div class="col-md-4">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-user-o fa-3x"></i>
                        <div class="info">
                            <h4>Total Employee</h4>
                            <p><b>
                            @php
                                $users = App\Models\Employee\Employee::get();
                                echo count($users);
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border border-danger mt-3">
        <div class="card-header text-center"><h4>{{_lang('eCommerce Section')}} </h4></div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-calendar-plus-o fa-3x"></i>
                        <div class="info">
                            <h4>{{_lang('Today Sale')}} </h4>
                            <p><b>
                            @php
                                $count = App\models\Production\Transaction::where('created_at', Carbon\Carbon::today())->where('ecommerce_status', '!=', null)->sum('net_total');
                                echo (get_option('currency') ? get_option('currency') : 'BDT' ). ' '. $count;
                                echo '<br>';
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>
                <!-- Short Question -->
                <div class="col-md-4">
                    <div class="widget-small info coloured-icon"><i class="icon fa fa-calendar-check-o fa-3x"></i>
                        <div class="info">
                            <h4>This Month's Sales</h4>
                            <p><b>
                            @php
                                $count = App\models\Production\Transaction::whereMonth('created_at', date('m'))->where('ecommerce_status', '!=', null)->sum('net_total');
                                echo (get_option('currency') ? get_option('currency') : 'BDT' ). ' '. $count;
                                echo '<br>';
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>
                        
                <!-- True False -->
                <div class="col-md-4">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-calendar fa-3x"></i>
                        <div class="info">
                            <h4>This Year's Sales</h4>
                            <p><b>
                            @php
                                $count = App\models\Production\Transaction::whereYear('created_at', date('Y'))->where('ecommerce_status', '!=', null)->sum('net_total');
                                echo (get_option('currency') ? get_option('currency') : 'BDT' ). ' '. $count;
                                echo '<br>';
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>

                <!-- True False -->
                <div class="col-md-4">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-archive fa-3x"></i>
                        <div class="info">
                            <h4>Total Products</h4>
                            <p><b>
                            @php
                                $count = App\models\Production\Product::where('status', 'Active')->where('title', '!=', null)->get();
                                echo count($count);
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>

                <!-- True False -->
                <div class="col-md-4">
                    <div class="widget-small info coloured-icon"><i class="icon fa fa-user fa-3x"></i>
                        <div class="info">
                            <h4>Total Customers</h4>
                            <p><b>
                            @php
                                $count = App\models\Client::get();
                                echo count($count);
                            @endphp
                            </b></p>
                        </div>
                    </div>
                </div>

                <!-- True False -->
                <div class="col-md-4">
                    <div class="widget-small danger coloured-icon"><i class="icon fa fa-newspaper-o fa-3x"></i>
                        <div class="info">
                            <h4>Newsletter SUBSCRIBER</h4>
                            <p><b>
                            
                            </b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- /basic initialization -->
@stop

