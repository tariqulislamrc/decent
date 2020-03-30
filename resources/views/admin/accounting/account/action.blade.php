<div class="dropdown">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	{{ _lang('Action') }}
	</button>
	<div class="dropdown-menu">
		<a id="content_managment" data-url="{{route('admin.accounting.account.edit',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-edit"></i>{{ _lang('Edit') }}</a>
		<a href="{{route('admin.accounting.account.show',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ _lang('Details') }}</a>
		<a id="content_managment" data-url="{{route('admin.accounting.account.getDeposit',$model->id)}}" class="dropdown-item cursour"><i class="fa fa-eye-slash" aria-hidden="true"></i>{{ _lang('Deposit') }}</a>

		<a class="dropdown-item cursour" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.accounting.account_closed',$model->id)  }}"><i class="fa fa-trash"></i>{{ _lang('Close') }}</a>
	</div>
</div>