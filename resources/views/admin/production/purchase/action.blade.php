<div class="dropdown">
    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
        {{ _lang('Action') }}
    </button>
    <div class="dropdown-menu">
        @can('production_purchase.update')
        <a class=" dropdown-item cursourp" data-original-title="null"
            href="{{route('admin.production-purchase.edit',$model->id)}}"><i class="fa fa-edit"></i> {{_lang('Edit')}}</a>
        @endcan
        @can('production_purchase.view')
        <a class=" dropdown-item cursourdata-original-title="null"
            href="{{route('admin.production-purchase.details',$model->id)}}"><i class="fa fa-asterisk"></i> {{_lang('Details')}}</a>
        @endcan
        @can('production_purchase.delete')
        <button id="delete_item" data-id="{{$model->id}}"
            data-url="{{route('admin.production-purchase.destroy',$model->id)  }}"
            class=" dropdown-item cursour" data-original-title="null" data-placement="bottom"><i
                class="fa fa-trash"></i> {{_lang('Delete')}}</button>
        @endcan

        @if ($model->due > 0)
        @can('production_purchase.payment')
        <button class=" dropdown-item cursour "
            id="content_managment" data-url="{{route('admin.production-purchase.payment',$model->id)}}"><i
                class="fa fa-credit-card"></i> {{_lang('Add Payment')}}</button>
        @endcan
        @endif
    </div>
</div>
