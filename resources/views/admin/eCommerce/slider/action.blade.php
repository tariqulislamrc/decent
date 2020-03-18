
    @can('slider.update')
        <button class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.eCommerce.slider.edit',$model->id)}}" ><i class="fa fa-edit"></i></button>
    @endcan
    @can('slider.delete')
        <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.eCommerce.slider.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
    data-placement="bottom"><i class="fa fa-trash"></i></button>
    @endcan


