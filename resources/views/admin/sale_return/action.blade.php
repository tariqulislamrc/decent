@can('sale_pos.view')
<a onclick="myFunction('{{ route('admin.sale.return.show',$model->id) }}')"  class="btn btn-info"><i class="fa fa-print" aria-hidden="true"></i>View</a>
@endcan