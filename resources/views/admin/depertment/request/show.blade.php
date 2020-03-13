@extends('layouts.app', ['title' => _lang('Department'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
  <div>
    <h1 data-placement="bottom" title="Department."><i class="fa fa-universal-access mr-4"></i> {{_lang('Department')}}</h1>
  </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<<<<<<< HEAD
<a class="btn btn-danger" href="{!!  url()->previous() !!}"><i class="fa fa-backward" aria-hidden="true"></i>{{ _lang('Go Back') }}</a>
=======
>>>>>>> 2b3e0fa082000a0e5de81a7f6c77d88a37fd5608
<!-- Basic initialization -->
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">
<<<<<<< HEAD
        <h3 class="border border-primary text-center py-2">Store Request</h3>
=======
        <h3 class="bg-info text-center py-2">Store Request</h3>
>>>>>>> 2b3e0fa082000a0e5de81a7f6c77d88a37fd5608
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{ _lang('Date') }}</th>
                <th>{{ _lang('Material') }}</th>
                <th>{{ _lang('Qty') }}</th>
                <th>{{ _lang('Status') }}</th>
                <th>{{ _lang('Action') }}</th>
              </tr>
            </thead>
            <thead>
              @foreach ($model->store_request as $store)
              {{--  {{ dd($category) }} --}}
              <tr>
                <td>{{ formatDate($store->request_date) }}</td>
                <td>
                  {{$store->material?$store->material->name:''}}
                </td>
                <td>{{ $store->qty }}</td>
                <td>
                  {{ $store->status }}
                </td>
                <td>
                  <a href="{{route('admin.request.edit',$store->id)}}" class="btn btn-info btn-sm has-tooltip" data-original-title="null" ><i class="fa fa-check-circle" aria-hidden="true"></i></a>
                  <button id="delete_item" data-id ="{{$store->id}}" data-url="{{route('admin.request.destroy',$store->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
                  data-placement="bottom"><i class="fa fa-trash"></i></button>
                </td>
              </tr>
              @endforeach
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
<script src="{{ asset('js/department/department_details.js') }}"></script>
@endpush