<div class="dropdown">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	{{ _lang('Action') }}
	</button>
	<div class="dropdown-menu">
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.edit',$model->id)}}"><i class="fa fa-edit"></i>{{ _lang('Edit') }}</a>
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.mail',$model->id)}}"><i class="fa fa-envelope" aria-hidden="true"></i>{{ _lang('Send Mail') }}</a>
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.sms',$model->id)}}"><i class="fa fa-commenting" aria-hidden="true"></i>{{ _lang('Send Sms') }}</a>
		<a class="dropdown-item cursour" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.client.destroy',$model->id)  }}"><i class="fa fa-trash"></i>{{ _lang('Trash') }}</a>
	</div>
</div>