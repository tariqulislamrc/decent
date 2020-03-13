@extends('layouts.report', ['title' => _lang('Details Raw Material Report'),'report_title'=>_lang('Details Raw Material Report')])

@section('content')
 <div class="container-fluid px-4 pt-4">

        <div class="row">
            <div class="col-md-6">
                <p class="h5 text-uppercase"><b> {{ _lang('Details Raw Material Report') }} </b></p>
                <p><b>{{ _lang('Date Range') }}: </b> {{ formatDate($sDate) }} <b>To</b>{{ formatDate($eDate) }} </p>
            </div>
            <div class="col-md-6 text-right">
                <p class="mb-0"> Printing Date : {{ formatDate(date('Y-m-d')) }}</p>
                <p class="mb-0">
                    Time : {{ date('H:i') }}</p>
            </div>
        </div>

        <div class="row mt-2 px-4">

            <div class="page-header-space"></div>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">{{ _lang('Depertment') }}</th>
                        <th scope="col">{{ _lang('Material') }}</th>
                        <th scope="col">{{ _lang('Done Quantity') }}</th>
                        <th scope="col">{{ _lang('Waste Qty') }}</th>
                        <th scope="col">{{ _lang('Done By') }}</th>
                        <th scope="col">{{ _lang('Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($result as $element)
                	<tr>
                        <th>{{ $element->depertment->name }}</th>
                        <th>{{ $element->material->name }}</th>
                        <td>{{ $element->qty  }} {{ $element->material->unit->unit }}</td>
                        <td> 
                          {{ $element->waste }}
                          {{ $element->material->unit->unit }}
                        </td>
                        <td>
                           {{ $element->accept_by->email }}
                        	
                        </td>
                        <td>{{ formatDate($element->date) }}</td>
                    </tr>
                	@endforeach
                </tbody>
            </table>

            <div class="page-footer-space"></div>
        </div>
  
        <div class="row mt-5 mb-3 text-center">
            <div class="col-md-3">
                <p class="border-top border-dark h4"> Received By </p>
            </div>
            <div class="col-md-3">
                <p class="border-top border-dark h4 text-color"> Prepared By </p>
            </div>
            <div class="col-md-3">
                <p class="border-top border-dark h4 text-color"> Checked By </p>
            </div>
            <div class="col-md-3">
                <p class="border-top border-dark h4 text-color"> Authorized By </p>
            </div>
        </div>
    </div>

@endsection