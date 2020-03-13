<hr>
<div class="row">
<div class="col-md-12">
    <div class="card">
    <div class="card-body">
      <table class="table table-bordered example">
        <thead>
          <tr>
            <th>{{ _lang('Date') }}</th>
            <th>{{ _lang('Status') }}</th>
            <th>{{ _lang('Total Materials Qty') }}</th>
            <th>{{ _lang('Action') }}</th>
          </tr>
        </thead>
        <thead>
          @foreach ($materials as $store)
          {{--  {{ dd($category) }} --}}
          <tr>
            <td>{{ formatDate($store->request_date) }}</td>
            <td>
              {{ $store->status }}
            </td>
            <td>
              {{ $store->store_request->sum('qty') }}
            </td>
            <td>
              <a href="{{ route('admin.report.approve_request',$store->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i>{{ _lang('View') }}
              </a>
              <a href="" data-id ="{{$store->id}}" data-url="{{route('admin.mainrequest.destroy',$store->id)  }}" id="delete_item" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{ _lang('Remove') }}
              </a>
            </td>
          </tr>
          @endforeach
        </thead>
      </table>
    </div>
  </div>
</div>
</div>