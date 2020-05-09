<div class="dropdown">
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
	{{ _lang('Action') }}
	</button>
	<div class="dropdown-menu">
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.edit',$model->id)}}"><i class="fa fa-edit"></i>{{ _lang('Edit') }}</a>
		@if ($model->total_invoice + $model->opening_balance - $model->invoice_received - $model->opening_balance_paid>0)
         <a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client_pay_due',[$model->id,'type'=>'Sale'])}}"><i class="fa fa-money"></i>{{ _lang('Pay Due') }}</a>
		@endif
		@if($model->total_sell_return - $model->sell_return_paid > 0)
          <a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client_pay_due',[$model->id,'type'=>'sale_return'])}}"><i class="fa fa-money"></i>{{ _lang('Pay Return Due') }}</a>
		@endif
		<a class="dropdown-item cursour" href="{{route('admin.client.show',$model->id)}}"><i class="fa fa-edit"></i>{{ _lang('View') }}</a>
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.mail',$model->id)}}"><i class="fa fa-envelope" aria-hidden="true"></i>{{ _lang('Send Mail') }}</a>
		<a class="dropdown-item cursour" id="content_managment" data-url="{{route('admin.client.sms',$model->id)}}"><i class="fa fa-commenting" aria-hidden="true"></i>{{ _lang('Send Sms') }}</a>
		<a class="dropdown-item cursour" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.client.destroy',$model->id)  }}"><i class="fa fa-trash"></i>{{ _lang('Trash') }}</a>
	</div>
</div>