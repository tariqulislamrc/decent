@can('production_department.view')
    <a href="{{route('admin.department.show',$model->id)}}" class="btn btn-info btn-sm has-tooltip" data-original-title="null" > <i class="fa fa-eye-slash" aria-hidden="true"></i></a>
@endcan
@can('production_department.update')
    <a href="" class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.department.edit',$model->id)}}"  ><i class="fa fa-edit"></i></a>
@endcan
@can('production_department.delete')
    <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.department.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
    data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan
