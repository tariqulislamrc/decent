<h3>{{ _lang('Payment History') }}</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      <th>{{ _lang('Date') }}</th>
      <th>{{ _lang('Method') }}</th>
      <th>{{ _lang('Amount') }}</th>
      <th>{{ _lang('Note') }}</th>
      <th>{{ _lang('Action') }}</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($model->payment as $pay)
    <tr>
      <td>{{ $pay->payment_date }}</td>
      <td>{{ $pay->method }}</td>
      <td>{{ $pay->amount }}</td>
      <td>{{ $pay->note }}</td>
      <td>
        <a href="{{ route('admin.sale.pos.printpayment',$pay->id) }}" class="btn btn-primary">Print</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>