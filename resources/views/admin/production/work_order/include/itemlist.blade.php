@foreach( $variations as $variation)
<tr>
    <td class="text-center">
        <i class="fa fa-trash text-danger remove" aria-hidden="true"></i>
    </td>
    <td>
        {{ $product->name }} {{ $variation->name }} ({{$variation->sub_sku}})

        <input type="hidden" name="product_id[]" class="product_id" value="{{$product->id}}" data-variation="{{$variation->id}}">
    	<input type="hidden" name="variation_id[]" class="variation_id" value="{{$variation->id}}">
    	<input type="hidden" class="form-control code" id="code_{{$row}}" data-id="{{$row}}" value="{{$product->id}}">
    </td>

    <td>
    	<input type="text" autocomplete="off" name="quantity[]" class="form-control qty" id="qty_{{$row}}" value="1">
    </td>
    <td>
    	<input type="text" autocomplete="off" name="price[]" class="form-control price" value="{{$variation->default_sell_price}}">
    </td>
    <td>
        <input type="hidden" name="sub_total[]" class="sub_total" value="{{1*$variation->default_sell_price}}">
    	<span id="sub_total_{{$row}}" class="sub_total_text">{{1*$variation->default_sell_price}}</span>
	</td>
    
</tr>
@endforeach
