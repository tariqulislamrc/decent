<div class="col-md-6 mx-auto text-center mb-3 border bg-light border-info">
    <b>Create New Special Offer</b>
</div>
{{ dd($document)}}

<form action="{{ route('admin.eCommerce.special-offer.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Offer Name --}}
    <div class="col-md-12 form-group">
        <label for="name">Offer Name <span class="text-danger">*</span></label>
        <input type="text" autocomplete="off" id="name" class="form-control" value="" placeholder="Enter Offer Name" required>
    </div>

    {{-- Cover Image --}}
    <div class="col-md-12 form-group">
        <label for="cover_image">Cover Image <span class="text-danger">*</span></label>
        <input type="file" name="cover_iamge" id="cover_image" class="form-control dropify" required>
        <span class="text-danger">Please Make Sure The Cover Image Must be (WIDTH x HEIGHT) (415 X 225) pixel size.</span>
    </div>

    {{-- Select Product --}}
    <div class="col-md-12 form-group">
        <label for="select_product">Select Product</label>
        <select data-url="{{ route('admin.eCommerce.add_to_special_offer_row') }}" name="" id="select_product" class="form-control select add-row" data-placeholder="Select Product for Special Offer" required>
            <option value="">Select Product for Special Offer</option>
            @foreach ($document as $item)
                <option value="{{ $item->product_id }}">{{ $item->pro_name }} - {{ $item->variation }} ({{ $item->sku}} ) </option>
            @endforeach
        </select>
    </div>

    <input type="hidden" id="number" value="0">

    <div class="table-responsive">
        <table class="table special_offer_table table-bordered table-striped">
            <thead class="table-info">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>D. Type</th>
                    <th>D. Amount</th>
                    <th>S. Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</form>

<script>
    $('.select').select2({width:'100%'});
</script>
<script>
    var products = [];
    $(".add-row").change(function(){
        var id = $(this).val();
        var url = $(this).data('url');
        var type = $('#number').val();
        var product_id = $(this).val();
        type = parseInt(type);
        row = type + 1;
        if( products.includes( $(this).data('id') ) ) {
            var qty = $('.update_qty_'+id).val();
            var refresh_qty = parseInt(qty) + 1;
            $('.update_qty_'+id).val(refresh_qty);
            calc();
            toastr.warning('Product Quantity is Updated Successfully');
        } else {
            products.push(product_id);
            $('#number').val(row);
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                data: {
                    row: row, product_id:product_id
                },
                success: function(data) {
                    $(".special_offer_table tbody").append(data);
                    toastr.success('Product is added into Cart Successfully');
                    calc();
                }
            });
        }

        // $('.pay_now').attr('id', 'content_managment');
        // $('.hold').attr('id', 'content_managment');
    });

$('.sell_table tbody').on('keyup change',function(){
calc();
});

function calc()
{
$('.sell_table tbody tr').each(function(i, element) {
    var html = $(this).html();
    if(html!='')
    {
        var qty = $(this).find('.qty').val();
        var sell_price = $(this).find('.sell_price').val();
        $(this).find('.net_total').val((qty*sell_price).toFixed(2));
        
        calc_total();
    }
});
}

function calc_total()
{
sub_total=0;
$('.net_total').each(function() {
    sub_total += parseInt($(this).val());
});
$('.sub_total').html(sub_total.toFixed(2)); 
$('#subtotal').val(sub_total.toFixed(2)); 

tax_sum=sub_total/100*$('#order_tax').val();
$('#total').val((tax_sum+sub_total).toFixed(2));
$('#shiping_charge').val(0);
$('#other_charge').val(0);
$('#discount').val(0);

var discount = parseInt($('#discount').val());
var other = parseInt($('#other_charge').val());
var ship = parseInt($('#shiping_charge').val());
var sub_total = parseInt($('#subtotal').val());
var tax = parseInt($('#order_tax').val());
var tax_amount = (sub_total * tax) / 100;
var total = sub_total + ship + tax_amount + other - discount;
$('.total').html(total.toFixed(2));
$('#total').val(total);
}
</script>