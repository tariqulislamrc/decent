@can('store_request.view')
    <a href="{{route('admin.request.show',$model->id)}}" class="btn btn-info btn-sm has-tooltip" data-original-title="null" >{{ _lang('Request Details') }}</a>
@endcan
@can('store_request.delete')
    <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.mainrequest.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
    data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan
