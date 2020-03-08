@foreach ($models as $item)
    <tr>
	<td>
		<input type="hidden" name="raw_material[]" value="{{ $item->id }}" class="pid">
		{{ $item->product->name }}({{ $item->product->articel }})
	</td>
	<td>
        <input type="text" class="form-control qty qty" id="qty" name="qty[]"
            value="{{ $item->qty }}">
    </td>
	<td>
        <input type="hidden" class="form-control" name="unit_id[]" value="{{ $item->unit->id }}">{{ $item->unit->unit }}
        @if ($item->unit->child_unit)
            / {{$item->unit->child_unit}}
        @endif
	</td>
	<td>
        <input type="text" class="form-control unit_price" id="unit_price" name="unit_price[]" value="{{ $item->unit_price }}">
    </td>
    <td>
        <input type="text" class="form-control price" id="price" readonly name="price[]"
            value="{{ $item->price }}">
    </td>
    <td>
        <input type="number" class="form-control waste" maxlength="2" id="waste" name="waste[]"
            value="{{ $item->waste }}">
    </td>
    <td>
        <input type="text" readonly class="form-control uses" id="uses" name="uses[]"
            value="{{ $item->uses }}">
    </td>
	<td>
		<button type="button" name="remove" class="btn btn-danger btn-sm remmove">X</button>
	</td>
</tr>
@endforeach
