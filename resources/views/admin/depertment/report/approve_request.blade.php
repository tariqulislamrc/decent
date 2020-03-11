@extends('layouts.app', ['title' => _lang('Approve Request'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
  <div>
    <h1 data-placement="bottom" title="Approve Request."><i class="fa fa-universal-access mr-4"></i> {{_lang('Approve Request')}}</h1>
  </div>
</div>
@stop
{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
  <div class="col-md-12">
    <div class="tile">
      <div class="tile-body">

        <h3 class="bg-info text-center py-2">Store Request</h3>
        <form action="{{route('admin.report.material_store')}}" method="post" class="ajax_form"
    enctype="multipart/form-data">
        <div class="row">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>{{ _lang('Material Name') }}</th>
                <th>{{ _lang('Request Qty') }}</th>
                <th>{{ _lang('Approve Qty') }}</th>
                <th>{{ _lang('Total Use') }}</th>
                <th>{{ _lang('Send Qty') }}</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($model->store_request as $element)
                <tr>
                  <td>
                    {{ $element->material->name }}
                    <input type="hidden" name="raw_material_id[]" value="{{ $element->raw_material_id }}">
                    <input type="hidden" name="depertment_id[]" value="{{ $element->depertment_id }}">
                    <input type="hidden" name="store_request_id[]" value="{{ $element->id }}">
                  </td>
                  <td>
                    {{ $element->qty }}
                  </td>
                  <td>
                    <input type="hidden" name="approve_qty[]" value="{{ $element->approve_store_item->sum('qty') }}">
                    {{ $element->approve_store_item->sum('qty') }}
                  </td>
                  <td>
                    <input type="text" name="total_use_qty[]" class="form-control" value="{{ rawMaterialUseQty($element->id) }}" readonly>
                  </td>
                  <td>
                    <input type="text" name="qty[]" class="form-control" value="{{$element->approve_store_item->sum('qty')- rawMaterialUseQty($element->id) }}" required>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <td colspan="5">
                <button type="submit" class="btn btn-primary" id="">{{_lang('Send & Submit Report')}}<i class="fa fa-share-square-o" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </form>
      </div>
    </div>

  </div>
</div>
<!-- /basic initialization -->
@stop
{{-- Script Section --}}
@push('scripts')
<script>
  _classformValidation();
</script>
@endpush