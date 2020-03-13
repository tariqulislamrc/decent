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
                  <th>{{ _lang('Material') }}</th>
                  <th>{{ _lang('Request') }}</th>
                  <th>{{ _lang('Approve') }}</th>
                  <th>{{ _lang('Total Waste') }}</th>
                  <th>{{ _lang('Total Use') }}</th>
                  <th>{{ _lang('Remain') }}</th>
                  <th>{{ _lang('Waste') }}</th>
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
                    {{ $element->material->unit->unit }}
                  </td>
                  <td>
                    <input type="hidden" name="approve_qty[]" value="{{ $element->approve_store_item->sum('qty') }}">
                    {{ $element->approve_store_item->sum('qty') }}
                    {{ $element->material->unit->unit }}
                  </td>
                    <td>
                    <input type="hidden" name="total_waste[]" value="{{ rawMaterialUseQty($element->id)->sum('waste') }}">
                    {{ rawMaterialUseQty($element->id)->sum('waste') }}
                    {{ $element->material->unit->unit }}
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" name="total_use_qty[]" class="form-control" value="{{ rawMaterialUseQty($element->id)->sum('qty') }}" readonly>
                      <div class="input-group-append">
                        <span class="input-group-text">{{ $element->material->unit->unit }}</span>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="input-group mb-3">
                      <input type="text" name="qty[]" class="form-control" value="{{$element->approve_store_item->sum('qty')- (rawMaterialUseQty($element->id)->sum('qty')+rawMaterialUseQty($element->id)->sum('waste')) }}" required>
                      <div class="input-group-append">
                        <span class="input-group-text">{{ $element->material->unit->unit }}</span>
                      </div>
                    </div>
                   
                  </td>
                  <td>
                     <input type="text" name="waste[]" class="form-control" value="">
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <td colspan="7">
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