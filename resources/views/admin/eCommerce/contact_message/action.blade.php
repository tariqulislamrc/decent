@can('contact.create')
    <button class="btn btn-success btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.eCommerce.contact-msg.edit',$model->id)}}" ><span>Replay</span></button>
@endcan
@can('production_work_order.view')
    <a class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.eCommerce.contact-msg.show',$model->id)}}" ><i class="fa fa-eye"></i></a>
@endcan 
@can('product_brand.delete')
    <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.eCommerce.contact-msg.destroy',$model->id)  }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"
    data-placement="bottom"><i class="fa fa-trash"></i></button>
@endcan

