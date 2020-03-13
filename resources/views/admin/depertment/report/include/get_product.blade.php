<table class="table table-bordered">
    <thead>
        <tr>
            <td>{{ _lang('Name') }}</td>
            @foreach ($variations as $variation)
            <td>{{ $variation->name }}</td>
            @endforeach
            <td>{{ $depert_name->name }} {{ _lang('Qty') }}</td>
        </tr>
        <tr>
            @foreach ($products as $product)
            <td>
                {{ $product->name }}
                <input type="hidden" name="variation_id[]" value="{{ $product->id }}">
                <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
            </td>
            <td>{{ variation_value($product->variation_value_id)}}</td>
            <td>{{ variation_value($product->variation_value_id_2)}}</td>
            <td>
                <input type="text" class="form-control" name="qty[]" required>
            </td>
            @endforeach
            <input type="hidden" name="flow_type" value="First">
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="{{ $variations->count()+1 }}">
                <select class="form-control select_custom" data-placeholder="Select Work Order" name="send_depertment_id" required>
                    <option value="">Select One</option>
                    @foreach ($depertments as $depertment_value)
                    <option value="{{ $depertment_value->id }}">{{ $depertment_value->name}}</option>
                    @endforeach
                </select>
            </td>
            <td>
                @if ($products->count()>0)
                <button type="submit" class="btn btn-primary" id="submit">{{_lang('Send & Submit Report')}}<i class="fa fa-share-square-o" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                @endif
            </td>
        </tr>
    </tbody>
</table>