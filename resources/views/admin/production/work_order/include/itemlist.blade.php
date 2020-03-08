<tr>
    <td>
        {{$model->name}}
    	<input type="hidden" name="product_id[]" class="form-controll product_id" value="{{$model->id}}">
    	<input type="hidden" class="form-controll code" id="code_{{$row}}" data-id="{{$row}}" value="{{$model->id}}">
    </td>
    
    <td>
    	<input type="text" name="quantity[]" class="form-control qty" id="qty_{{$row}}" value="{{$quantity}}">
    </td>
    <td>
    	<input type="text" name="price[]" class="form-control price" value="{{$price}}">
    </td>
    <td>
        <input type="hidden" name="sub_total[]" class="sub_total" value="{{$quantity*$price}}">
    	<span id="sub_total_{{$row}}" class="sub_total_text">{{$quantity*$price}}</span>
	</td>
	<td>
        <input type="hidden" name="net_total[]" class="net_total" value="{{$quantity*$price}}">
    	<span id="net_total_{{$row}}" class="net_total_text">{{$quantity*$price}}</span>
    </td>
    <td>
        <button type="button" class="btn btn-info remove">X</button>
    </td>
</tr>