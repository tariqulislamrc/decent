<table class="table table-bordered">
    <thead>
        <tr>
            <td>{{ _lang('Name') }}</td>
            @foreach ($variations as $variation)
            <td>{{ $variation->name }}</td>
            @endforeach
            <td>{{ _lang('Request Qty') }}</td>
            <td>{{ _lang('Done Qty') }}</td>
            <td>{{ $depert_name->name }} {{ _lang('Qty') }}</td>
        </tr>
            @foreach ($products as $product)
        <tr>
            <td>
                {{ $product->variation->name }}
                <input type="hidden" name="variation_id[]" value="{{ $product->variation_id }}">
                <input type="hidden" name="product_id[]" value="{{ $product->product_id }}">
                <input type="hidden" name="done_depertment_id[]" value="{{ $product->id }}">
            </td>
            <td>{{ variation_value($product->variation->variation_value_id)}}</td>
            <td>{{ variation_value($product->variation->variation_value_id_2)}}</td>
            <td>
                <input type="text" class="form-control" value="{{ $product->qty  }}" readonly name="req_qty[]">
            </td>
            <td>
               <input type="text" class="form-control" name="done_qty[]" value=" {{ report_product_flow($depert_name->id,$product->work_order_id,$product->variation_id,$product->id) }}" readonly>
            </td>
            <td>
                <input type="text" class="form-control" name="qty[]" value="{{ $product->qty-report_product_flow($depert_name->id,$product->work_order_id,$product->variation_id,$product->id ) }}" required>
            </td>
        </tr>
            @endforeach
            <input type="hidden" name="flow_type" value="middle">
    </thead>
    <tbody>
        <tr>
            <td colspan="{{ $variations->count()+3 }}">
                <select class="form-control select_custom" data-placeholder="Select Depertment" name="send_depertment_id" required>
                    <option value="">Select One</option>
                    @foreach ($depertments as $depertment_value)
                    <option value="{{ $depertment_value->id }}">{{ $depertment_value->name}}
                    </option>
                    @endforeach
                </select>
            </td>
            <td>
                @if ($products->count()>0)
                <button type="submit" class="btn btn-primary" id="submit">{{_lang('Send & Submit Report')}}<i class="fa fa-share-square-o" aria-hidden="true"></i></button>
                <button type="button" class="btn btn-info" id="submiting" style="display: none;">{{_lang('Processing')}}
                <i class="fa fa-spinner fa-spin" style="font-size: 20px" aria-hidden="true"></i></button>
                @endif
            </td>
        </tr>
    </tbody>
</table>