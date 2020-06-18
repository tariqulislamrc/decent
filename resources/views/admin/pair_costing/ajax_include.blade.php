<form action="{{ route('admin.paircosting.store') }}" class="ajax_form" method="post">
	<input type="hidden" name="product_id" value="{{ $model->id }}">
	<div class="row">
	<div class="col-md-12">
		<table class="table bg-green" id="item">
			<thead>
				<tr>
					<th width="20%">{{ _lang('Material Des') }}</th>
					<th width="20%">{{ _lang('Consumstion') }}</th>
					<th width="10%">{{ _lang('Unit') }}</th>
					<th width="15%">{{ _lang('Unit Cost') }}</th>
					<th width="15%">{{ _lang('Cost/PR') }}</th>
					<th width="20%">{{ _lang('Note') }}</th>
				</tr>
			</thead>
			<tbody class="bg-gray">
				@php
					$total =0;
				@endphp
				@foreach ($model->material as $element)
                 <tr>
                 	<td>
                 		<input type="hidden" name="material_id[]" value="{{ $element->material_id }}">
                 		{{ $element->material?$element->material->name:'' }}
                 	</td>
                 	<td>
                 		<input type="text" name="consumstion[]" class="form-control consumstion input_number"  value="{{ $element->qty }}" required />
                 	</td>
                 	<td>{{ $element->material?$element->material->unit->unit:'' }}</td>
                 	<td>
                 		<input type="text" name="unit_cost[]" class="form-control unit_cost input_number" value="{{ $element->unit_price }}" required />
                 	</td>

                 	<td>
                 		<input type="text" name="cost_pr[]" class="form-control cost_pr input_number" readonly value="{{ $element->price }}"/>
                 	</td>

                 	<td>
                 		<textarea name="description[]" class="form-control">{{ $element->description }}</textarea>
                 	</td>
                 </tr>
                 @php
                 	$total+=$element->price;
                 @endphp
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-6"></div>
	<div class="col-md-6">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>{{ _lang('Total Material Cost') }}</th>
					<th>
						<input type="text" name="total_material_cost" class="form-control total_material_cost input_number" id="total_material_cost" readonly value="{{ $total }}" />
					</th>
				</tr>
				<tr>
					<th>
						{{ _lang('Rejection') }}%
						<input type="text" name="rejection" class="form-control w-50 profit input_number d-inline-block ml-2" id="rejection" value="{{ $model->rejection }}" />
					</th>
					<th>
						<input type="text" name="rejection_amt" class="form-control rejection_amt input_number" id="rejection_amt" value="{{ $model->rejection_amt }}"  readonly />
					</th>
				</tr>

				<tr>
					<th>{{ _lang('Overhead') }}</th>
					<th>
						<input type="text" name="overhead" class="form-control overhead input_number" value="{{ $model->overhead }}" id="overhead" />
					</th>
				</tr>

				<tr>
					<th>
					{{ _lang('Profit') }}% 
					<input type="text" name="profit_percent" class="form-control w-50 profit input_number d-inline-block ml-2" value="{{ $model->profit_percent }}" id="profit" />
				   </th>
					<th>
						<input type="text" name="profit_amt" class="form-control profit_amt input_number" value="{{ $model->profit_amt }}" id="profit_amt" readonly />
					</th>
				</tr>
				<tr>
					<th>{{ _lang('Commercial') }}</th>
					<th>
						<input type="text" name="commercial" class="form-control commercial input_number" id="commercial" value="{{ $model->commercial }}" />
					</th>
				</tr>
				<tr>
					<th>{{ _lang('Grand Total CM') }}</th>
					<th>
						<input type="text" name="grand_total" class="form-control grand_total input_number" id="grand_total" readonly value="{{ $model->default_sell_price?$model->default_sell_price:$total }}" />
					</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@can('paircosting.create')
<div class="row mt-2">
    <div class="col-md-6 mx-auto text-center">
        
        <button type="submit" class="btn btn-primary btn-sm w-100" id="submit">{{ _lang('Submit Pair Cost') }}</button>
        <button type="button" class="btn btn-sm btn-info w-100" id="submiting" style="display: none;">
        <i class="fa fa-spinner fa-spin fa-fw"></i>Checking...</button>
    </div>
</div>
@endcan
</form>

<script>
$("#item").delegate(".consumstion,.unit_cost", "keyup", function() {
    var tr = $(this).parent().parent();
    tr.find(".cost_pr").val(tr.find(".consumstion").val() * tr.find(".unit_cost").val());
    calculate();


})

function calculate() {
  
  var total_material_cost=0;

  $(".cost_pr").each(function() {
    total_material_cost = total_material_cost + ($(this).val() * 1);
  })

   grand_total = total_material_cost;
   $(".total_material_cost").val(total_material_cost);

   var rejection =percent(total_material_cost,'rejection');
   $('#rejection_amt').val(rejection);
   grand_total=total_material_cost+rejection;
   var overhead =overheadd();
   grand_total=grand_total+overhead;
   var profit =percent(grand_total,'profit');
   $('#profit_amt').val(profit);
   grand_total=grand_total+profit;
   var commercial =commerciall();
   grand_total=grand_total+commercial;
   $('#grand_total').val(grand_total);
   // console.log(rejection);

}

	function percent(total_amount,type) {
	    var calculation_type = 'percentage';
	    var calculation_amount = __read_number($('#'+type));

	    var parcent = __calculate_amount(calculation_type, calculation_amount, total_amount);
	    return parcent;
	}

	function __read_number(input_element, use_page_currency = false) {
	    return input_element.val();
	}

function __calculate_amount(calculation_type, calculation_amount, amount) {
    var calculation_amount = parseFloat(calculation_amount);
    calculation_amount = isNaN(calculation_amount) ? 0 : calculation_amount;

    var amount = parseFloat(amount);
    amount = isNaN(amount) ? 0 : amount;

    switch (calculation_type) {
        case 'fixed':
            return parseFloat(calculation_amount);
        case 'percentage':
            return parseFloat((calculation_amount / 100) * amount);
        default:
            return 0;
    }
}

function overheadd()
{
  var overhead =parseFloat($('#overhead').val()); 
  return isNaN(overhead) ? 0 : overhead;;
   
}

function commerciall()
{
  var commercial =parseFloat($('#commercial').val()); 
  return isNaN(commercial) ? 0 : commercial;;
   
}


    $("#rejection,#overhead,#profit,#commercial").on('keyup blur change', function () {
       calculate();
    });
</script>