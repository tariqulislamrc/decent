@foreach ($models->wop_material as $item)
@php
	$exit_prev =App\models\depertment\StoreRequest::where('work_order_id',$item->wo_id)->where('raw_material_id',$item->raw_material_id)->sum('qty');
@endphp
  <tr>
	<td>
		<input type="hidden" name="raw_material_id[]" value="{{ $item->raw_material_id }}" class="pid">
		{{ $item->work_order_product->product->name }}({{ $item->raw_material->name }})
	</td>
	
	<td>
		<input type="text" class="form-control" value="{{ $exit_prev }}" readonly>
	</td>

	<td>
        <input type="text" class="form-control qty qty_{{$item->id}}" id="{{$item->id}}" name="qty[]"
            value="{{ $item->qty }}" required>
    </td>
	<td>
		<button type="button" name="remove" class="btn btn-danger btn-sm remmove">X</button>
   </td>
</tr>
@endforeach
