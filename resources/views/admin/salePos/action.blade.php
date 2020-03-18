<div class="dropdown">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	{{ _lang('Action') }}
	</button>
	<div class="dropdown-menu">
		<a href="{{route('admin.sale.pos.show',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ _lang('View') }}</a>
        <a href="{{route('admin.sale.return_sale',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-reply-all" aria-hidden="true"></i>{{ _lang('Return') }}</a>
        <a href="{{route('admin.sale.pos.print',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-print" aria-hidden="true"></i>{{ _lang('Print') }}</a>
		<a class="dropdown-item cursour" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.sale.pos.destroy',$model->id)  }}"><i class="fa fa-trash"></i>{{ _lang('Trash') }}</a>
	</div>
</div>