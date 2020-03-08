@foreach ($models as $item)
 <tr>
	<td>
		<input type="hidden" name="raw_material_id[]" class="raw_material_id" value="{{ $item->id }}">
		{{ $item->name }})
	</td>
	<td></td>
	<td>
        <input type="text" class="form-control qty qty_{{$item->id}}" id="{{$item->id}}" name="qty[]" value="" required>
    </td>
	<td>
		<button type="button" name="remove" class="btn btn-danger btn-sm remmove">X</button>
	</td>
</tr>
@endforeach
