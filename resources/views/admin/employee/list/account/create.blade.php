<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Account for Employee')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.account.store',$id) }}" method="post" id="content_form">
            @csrf
            <div class="row">
            <input type="hidden" name="uuid" value="{{$model->uuid}}">
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Account Name')}} </label> <input required type="text" name="name"
                            placeholder="Account Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Account Number')}}</label> <input required type="text" name="account_number"
                            placeholder="Account Number" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Bank Name')}}</label> <input required type="text" name="bank_name"
                            placeholder="Bank Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="form-group"><label for="">{{_lang('Branch Name')}}</label> <input required type="text" name="branch_name"
                            placeholder="Branch Name" class="form-control">
                    </div>
                </div>
                <div class="col-12 col-sm-12">
                    <div class="form-group"><label for="">{{_lang('Bank Identification Code')}}</label> <input required type="text"
                            name="bank_identification_code" placeholder="Bank Identification Code" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">{{_lang('Description')}}</label>
                <textarea rows="2" placeholder="Description" name="description" class="form-control"
                   ></textarea>
            </div> 
            @can('employee_account.create')
                <div class="form-group col-md-12" align="right">
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}<img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            @endcan
        </form>
    </div>
</div>
