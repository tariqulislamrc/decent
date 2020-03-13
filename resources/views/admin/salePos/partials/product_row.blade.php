<tr>
	<td>
		<input type="text"  class="form-control" value="{{ $data->vari_name }}" readonly>
		<input type="hidden" name="variation[{{ $row }}][part_id]" class="form-control" value="{{ $data->product_id }}">
		<input type="hidden" id="code_{{$row}}" data-id="{{$row}}"  class="code" value="{{$data->sku}}" readonly/>
	</td>
	<td>
		<input type="text" class="form-control input_number qty" id="qty_{{$row}}" name="variation[{{ $row }}][qty]" placeholder="Quantity" value="{{ $quantity }}" required>
	</td>
	<td>
		<input type="text" name="variation[{{ $row }}][sell_price]" class="form-control input_number sell_price" value="{{ $data->sale_price }}">
	</td>
	<td>
		<span class="amt" id="amt_{{$row}}">{{$data->sale_price }}</span>
	</td>
	<td>
		<button type="button" name="remove" class="btn btn-danger btn-sm btn_remove">X</button>
	</td> 
</tr>