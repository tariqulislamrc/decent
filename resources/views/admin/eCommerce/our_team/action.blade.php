<a class="btn btn-info btn-sm has-tooltip" data-original-title="null"  href="{{route('admin.eCommerce.our-team.edit',$model->id)}}" ><i class="fa fa-edit"></i></a>

<button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.eCommerce.our-team.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
data-placement="bottom"><i class="fa fa-trash"></i></button>

<a class="btn btn-info btn-sm has-tooltip" data-original-title="null"  href="{{route('admin.eCommerce.our-team.show',$model->id)}}" ><i class="fa fa-eye"></i></a>