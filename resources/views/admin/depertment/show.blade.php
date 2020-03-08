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
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                  <div class="row">
                      <div class="col-md-5">
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>{{ _lang('Department Name') }}</th>
                                      <th>{{ $model->name }}</th>
                                  </tr>
                                  <tr>
                                      <th>{{ _lang('Department Head') }}</th>
                                      <th>{{ $model->employee->name }}</th>
                                  </tr>
                                  <tr>
                                      <th>{{ _lang('Description') }}</th>
                                      <th>{{ $model->description }}</th>
                                  </tr>
                                  <tr>
                                      <th>{{ _lang('Store Request') }}</th>
                                      <th>
                                          <a href="{{ route('admin.request.department',$model->id) }}" class="btn btn-success" target="_blank">{{ _lang('Request') }}
                                          </a>
                                      </th>
                                  </tr>
                              </thead>
                          </table>
                      </div>
                      <div class="col-md-7">
                        <button data-placement="bottom" title="Create New Department" type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.depertment_new_employee',$model->id) }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('New Employee')}}</button>
                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>{{ _lang('Employee Name') }}</th>
                                      <th>{{ _lang('Designation') }}</th>
                                      <th>{{ _lang('Action') }}</th>
                                  </tr>
                                  @foreach ($model->depertment_employee as $element)
                                     <tr>
                                         <td>{{ $element->employee->name }}</td>
                                         <td>{{ $element->designation }}</td>
                                         <td>
                                             <a href="" data-id ="{{$element->id}}" data-url="{{route('admin.depertment.employee.delete',$element->id)  }}" id="delete_item" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ _lang('Remove') }}</a>
                                         </td>
                                     </tr> 
                                  @endforeach
                              </thead>
                          </table>
                      </div>
                  </div>
                  <h3 class="bg-info text-center py-2">Production ingredients category</h3>
                  <div class="row">
                      <button data-placement="bottom" title="Create New Department" type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.depertment_new_category',$model->id) }}">
                        <i class="fa fa-plus-square mr-2" aria-hidden="true"></i>
                      {{_lang('New ingredients category')}}
                    </button>
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>{{ _lang('Category') }}</th>
                                  <th>{{ _lang('Action') }}</th>
                              </tr>
                          </thead>
                          <thead>
                              @foreach ($model->igcategory as $category)
                             {{--  {{ dd($category) }} --}}
                                <tr>
                                    <td>{{ $category->ingcategory->name }}</td>
                                     <td>
                                      <a href="" class="btn btn-danger btn-sm" data-id ="{{$category->id}}" data-url="{{route('admin.depertment.category.delete',$category->id)  }}" id="delete_item"><i class="fa fa-trash"></i> {{ _lang('Remove') }}</a>
                                     </td>
                                </tr>
                              @endforeach
                          </thead>
                      </table>
                  </div>

                  <h3 class="bg-info text-center py-2">Store Request</h3>
                  <div class="row">
                      <table class="table table-bordered">
                          <thead>
                              <tr>
                                  <th>{{ _lang('Date') }}</th>
                                  <th>{{ _lang('Material') }}</th>
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
                                     <td>
                                       {{ $store->status }}
                                     </td>
                                     <td>
                                      @if ($store->status=='Approve')
                                        <a href="{{ route('admin.department.flow',$store->id) }}" class="btn btn-success btn-sm">{{ _lang('Flow') }}</a>
                                      @endif
                                       <a href="" data-id ="{{$store->id}}" data-url="{{route('admin.request.destroy',$store->id)  }}" id="delete_item" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ _lang('Remove') }}
                                       </a>
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

