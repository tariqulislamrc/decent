<h3>{{ _lang('Sale Item') }}</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>{{ _lang('Name') }}</th>
      <th>{{ _lang('Qty') }}</th>
      <th>{{ _lang('Price') }}</th>
      <th>{{ _lang('Total') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($model->sell_lines as $sale)
    <tr>
      <td>{{$sale->variation->name }}-{{$sale->product->name }}</td>
      <td>{{ $sale->quantity }}</td>
      <td>{{ $sale->unit_price }}</td>
      <td>
        {{ $sale->total }}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>