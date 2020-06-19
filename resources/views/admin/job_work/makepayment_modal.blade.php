@if($transaction->net_total - $transaction->paid > 0)
<h3>{{ _lang('Make Payment') }}</h3>
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.job_work.post_payment') }}"  method="post" id="content_form">

            <input type="hidden" name="type" value="Debit">
            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
            <div class="row">
                <div class="col-md-12">
                    <label for="payment_date">
                        {{ _lang('Date') }}
                    </label>
                    <input type="text" class="form-control date" name="payment_date" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-12">
                    <label for="method">{{ _lang('Method') }} </label>
                    <select name="method" class="form-control select method" style="width: 100%">
                        <option value="cash">Cash</option>
                        <option value="check">Check</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="col-md-12 reference_no" style="display:none">
                    <label for="">Reference No</label>
                    <input type="text" name="check_no" class="form-control">
                </div>
                <div class="col-md-12">
                    <label for="amount">
                        {{ _lang('Amount') }}
                    </label>
                    <input type="text" class="form-control" name="amount" id="amount" value="{{ $transaction->due }}" required>
                     <p id="message" style="color: red;"></p>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="due">{{ _lang('Pay Account') }} </label>
                        <select name="investment_account_id" id="investment_account_id" class="form-control select">
                            <option value="">Select Account</option>
                            @foreach ($inves_account as $element)
                                <option value="{{ $element->id }}">{{ $element->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="note">
                        {{ _lang('Note') }}
                    </label>
                    <textarea name="note" class="form-control" id="" placeholder="Description"></textarea>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-6 mx-auto text-center">
                    <button type="submit" class="btn btn-primary btn-sm w-100" id="submit">{{ _lang('Payment') }}</button>
                    <button type="button" class="btn btn-primary btn-sm w-100" id="submiting" style="display: none;" disabled="">{{ _lang('Submiting') }}  <i class="fa fa-spinner fa-spin" style="font-size: 20px" aria-hidden="true"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
@else
 <div class="alert alert-success text-light">
  <strong>{{ _lang('This Transection has No Due') }}</strong>.
</div>
@endif

<br>
<h4>@lang('Payment Info')</h4>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
        <table class="table bg-gray">
            <tbody>
                <tr class="bg-green text-light">
                    <th>#</th>
                    <th> @lang('Date')</th>
                    <th> @lang('Reference No')</th>
                    <th> @lang('Amount')</th>
                    <th> @lang('Payment mode')</th>
                    <th> @lang('Payment note')</th>
                    <th> @lang('Print')</th>
                </tr>
                @foreach ($payments as $pay)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $pay->payment_date }}</td>
                    <td>{{ $pay->payment_ref_no }}</td>
                    <td>{{ $pay->amount }}</td>
                    <td>{{ $pay->method }}</td>
                    <td>{{ $pay->note }}</td>
                    <td><button class="btn btn-sm btn-primary" onclick="myFunction('{{ route('admin.job_work.printpayment',$pay->id) }}')"><i class="fa fa-print" aria-hidden="true"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>

<script>
 $(document).on('change','.method',function(){
        var method =$(".method").val();
        if (method=='cash') {
            $('.reference_no').hide(300);
        }
        else
        {
          $('.reference_no').show(400);  
        }
   });

    function myFunction(url) {
    window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=auto,left=auto,width=700,height=400");
    }
</script>