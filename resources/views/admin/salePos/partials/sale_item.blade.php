<h3>{{ _lang('Sale Item') }}</h3>
<table class="table table-bordered">
  <thead class="bg-green text-light">
    <tr>
      <th>{{ _lang('Name') }}</th>
      @can('view_sale.qty')
      <th>{{ _lang('Qty') }}</th>
      @endcan
      @can('view_sale.sale_price')
      <th>{{ _lang('Price') }}</th>
      <th>{{ _lang('Total') }}</th>
      @endcan
    </tr>
  </thead>
  <tbody>
    @foreach ($model->sell_lines as $sale)
    <tr>
      <td>{{$sale->variation->name }}-{{$sale->product->name }}</td>
      @can('view_sale.qty')
      <td>{{ $sale->quantity }}</td>
      @endcan
      @can('view_sale.sale_price')
      <td>{{ $sale->unit_price }}</td>
      <td>
        {{ $sale->total }}
      </td>
      @endcan
    </tr>
    @endforeach
  </tbody>
</table>