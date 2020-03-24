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
        {{-- User Count Card --}}
        <div class="col-md-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Total User</h4>
                    <p><b>
                    @php
                        $users = App\User::get();
                        echo count($users) - 1;
                    @endphp
                    </b></p>
                </div>
            </div>
        </div>
        
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

<!-- /basic initialization -->
@stop

