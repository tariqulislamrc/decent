<table class="table table-hover table-bordered content_managment_table">
    <thead>
        <tr>
            <th>{{_lang('ID')}}</th>
            <th>{{_lang('Payment Type')}}</th>
            <th>{{_lang('Track Code')}}</th>
            <th>{{_lang('Subtotal')}}</th>
            <th>{{_lang('Shipping Name')}}</th>
            <th>{{_lang('Phone')}}</th>
            <th>{{_lang('Total')}}</th>
            <th>{{_lang('Date')}}</th>
            <th>{{_lang('Status')}}</th>
            <th>{{_lang('Action')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($models as $model)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td>{{$model->payment_status}}</td>
                <td>{{$model->reference_no}}</td>
                <td>{{get_option('currency') ? 'BDT' : get_option('currenct') }} {{$model->sub_total}}</td>
                <td>{{get_client_name($model->client_id)}}</td>
                <td>{{get_client_phone($model->client_id)}}</td>
                <td>{{get_option('currency') ? 'BDT' : get_option('currenct') }} {{$model->net_total}}</td>
                <td>{{formatDate($model->created_at)}}</td>
                <td>
                    @if ($model->ecommerce_status == 'pending')
                        {{_lang('Pending')}}
                    @elseif( $model->ecommerce_status == 'confirm')
                        {{_lang('Confirm')}}
                    @elseif( $model->ecommerce_status == 'progressing')
                        {{_lang('In Progressing')}}
                    @elseif( $model->ecommerce_status == 'shipment')
                        {{_lang('In Shipment')}}
                    @elseif( $model->ecommerce_status == 'success')
                        {{_lang('Success')}}
                    @else 
                        {{_lang('Cancel')}}
                    @endif
                </td>
                <td>
                    <button class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{route('admin.eCommerce.order.show',$model->id)}}" ><i class="fa fa-shopping-bag"></i></button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script>

    // Setting datatable defaults

    $('.content_managment_table').DataTable({
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'copy',
            className: 'btn btn-primary glyphicon glyphicon-duplicate'
        }, {
            extend: 'csv',
            className: 'btn btn-primary glyphicon glyphicon-save-file'
        }, {
            extend: 'excel',
            className: 'btn btn-primary glyphicon glyphicon-list-alt'
        }, {
            extend: 'pdf',
            className: 'btn btn-primary glyphicon glyphicon-file'
        }, {
            extend: 'print',
            className: 'btn btn-primary glyphicon glyphicon-print'
        }],

        order: [0, 'asc']

    });


</script>