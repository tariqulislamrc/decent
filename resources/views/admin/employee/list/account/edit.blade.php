<div class="card">
    <div class="card-header">
        <h6>{{_lang('Edit Employee Account Information')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.account.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <input type="hidden" name="uuid" value="{{$model->employee->uuid}}">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Account Name')}}</label> <input value="{{$model->name}}" required type="text" name="name"
                            placeholder="Account Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Account Number')}}</label> <input value="{{$model->account_number}}" required type="text" name="account_number"
                            placeholder="Account Number" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Bank Name')}}</label> <input value="{{$model->bank_name}}" required type="text" name="bank_name"
                            placeholder="Bank Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Branch Name')}}</label> <input value="{{$model->branch_name}}" required type="text" name="branch_name"
                            placeholder="Branch Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="form-group"><label for="">{{_lang('Bank Identification Code')}}</label> <input value="{{$model->bank_identification_code}}" required type="text"
                            name="bank_identification_code" placeholder="Bank Identification Code" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">{{_lang('Description')}}</label>
                <textarea required rows="2" placeholder="Description" name="description" class="form-control">{{$model->description}}</textarea>
            </div> 
            @can('employee_account.update')
                <div class="form-group col-md-12" align="right">
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            @endcan
        </form>
    </div>
</div>

<script type="text/javascript">
    $('.date').datepicker({
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
    $('.select').select2({
        width: '100%'
    });
</script>
