<h3 style="text-align: center;">{{_lang('Return Item')}}</h3>

@if($model->returntransaction->count() != 0)
  <h5 style="text-align: left;">
    <b>{{_lang('Date')}}:</b> 
    {{carbonDate($model->returntransaction->first()->created_at)}}
  </h5>
@endif

<table class="table table-bordered ">
  <thead class="table-header-color">
    <th class="text-center">#</th>
    <th class="text-center">{{_lang('Item')}}</th>
    <th class="text-center">{{_lang('Qty')}}</th>
    <th class="text-center">{{_lang('Sub Total')}}</th>
  </thead>
<tbody>
    @foreach($model->returntransaction as $return)
    <tr>
      <td class="text-center">{{$loop->iteration}}</td>
      <td class="text-center">{{$return->sales->variation?$return->sales->variation->name:''}}</td>
      <td class="text-center">{{$return->return_units}}</td>
      <td class="text-center">{{$return->return_amount }}</td>
    </tr>
  @endforeach
</tbody>

  <tfoot>
    <tr>
      <td colspan="3">{{_lang('Return Discount')}}</td>
      <td colspan="2">{{$model->return_parent->sum('discount')}}</td>
    </tr>
        <tr>
      <td colspan="3">{{_lang('Return Amount')}}</td>
      <td colspan="2">{{$model->return_parent->sum('sub_total')-$model->return_parent->sum('discount')}}</td>
    </tr>
  </tfoot>
</table>