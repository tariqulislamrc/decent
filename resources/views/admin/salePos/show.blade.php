@extends('layouts.app', ['title' => _lang('Sale Details'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Purchases for Production."><i class="fa fa-universal-access mr-4"></i> {{_lang('Sale Details')}}</h1>
    </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="row">
                <div class="col-md-4 mx-auto ">
                    <div class="card card-box border border-primary">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-file-powerpoint-o fa-4x" aria-hidden="true"></i>
                                <h4 class="card-title">{{ _lang('Client Details') }}</h4>
                            </div>
                            
                            <p class="card-text font-80pc">
                                <span><b>{{ _lang('Name') }}: </b>{{ $model->client->name }}</span> <br>
                                <span><b>{{ _lang('Email') }}</b> : {{ $model->client->email }}</span> <br>
                                <span><b>{{ _lang('Phone') }}</b> : {{ $model->client->mobile }}</span> <br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto">
                    <div class="card card-box border border-primary">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-file-powerpoint-o fa-4x" aria-hidden="true"></i>
                                <h4 class="card-title">{{ _lang('Sale Details') }}</h4>
                            </div>
                            
                            <p class="card-text font-80pc">
                                <span><b>{{ _lang('Ref No') }}: </b>{{ $model->reference_no }}</span> <br>
                                <span><b>{{ _lang('Date') }}</b> : {{ formatDate($model->date) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mx-auto">
                    <div class="card card-box border border-primary">
                        <div class="card-body">
                            <div class="text-center">
                                <i class="fa fa-file-powerpoint-o fa-4x" aria-hidden="true"></i>
                                <h4 class="card-title">{{ _lang('Payment Details') }}</h4>
                            </div>
                            
                            <p class="card-text font-80pc">
                                <span><b>{{ _lang('Total') }}: </b>{{ $model->net_total }}</span> <br>
                                <span><b>{{ _lang('Paid') }}</b> : {{ $model->paid }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="pill" href="#home">{{ _lang('Sale Item') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#menu1">{{ _lang('Payment History') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#menu2">{{ _lang('Make Payment') }}</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div id="home" class="container tab-pane active"><br>
                                    @include('admin.salePos.partials.sale_item')
                                </div>
                                <div id="menu1" class="container tab-pane fade"><br>
                                    @include('admin.salePos.partials.payment_list')
                                </div>
                                <div id="menu2" class="container tab-pane fade"><br>
                                    @include('admin.salePos.partials.make_payment')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
$('select').select2();
</script>
@endpush