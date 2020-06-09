@php
    $id = $row;
    $product_name = $product->name;
@endphp

<tr>
    <td width="2%">
        {{ $id }}
        <input type="hidden" name="product_id[]" value="{{ $product->id }}">
    </td>

    <!-- Product Image -->
    <td>
        <img src="{{ $photo != '' ? asset('storage/product'. '/'. $photo) : asset('img/product.jpg') }}" style="width: 100px;" alt="">
    </td>

    <!-- Product Name -->
    <td>
        {{ $product->name }}
    </td>

    <!-- Product Discount Type -->
    <td>
        <select name="discount_type[]" id="discount_type_{{$id}}" class="form-control select" data-placeholder="Select Discount Type" required >
            <option value="">Select Discount Type</option>
            <option value="Percentages">Percentages</option>
            <option value="Addition">Addition</option>
        </select>
    </td>

    <!-- Discount Amount -->
    <td>
        <input type="text" name="discount[]" id="discount_{{$id}}" class="form-control discount_amount" placeholder="Discunt Amount">
    </td>

    <!-- Sell Price -->
    <td>
        {{-- {{ }} --}}
    </td>


</tr>


<script>
    $('.select').select2({width:'100%'});
</script>