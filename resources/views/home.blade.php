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

<!-- /basic initialization -->
@stop

