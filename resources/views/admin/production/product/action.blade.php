@can('production_product.update')
    <a class="btn btn-warning btn-sm has-tooltip" data-original-title="null"  href="{{route('admin.production-product.edit',$model->id)}}" ><i class="fa fa-edit"></i></a>
@endcan
@can('production_product.view')
    <a class="btn btn-info btn-sm has-tooltip" data-original-title="null"  href="{{route('admin.production-product.show',$model->id)}}" ><i class="fa fa-eye"></i></a>
@endcan
@can('production_product.delete')
    <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.production-product.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
    data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan


