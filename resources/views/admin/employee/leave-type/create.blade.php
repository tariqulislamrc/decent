<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Employee Leave Type')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-leave-type.store')}}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- Employee Leave Type Name --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Leave Type Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Leave Type Name"
                        required>
                </div>
        
                {{-- Alias --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Alias')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="alias" id="alias" class="form-control" placeholder="Enter Alias" required>
                </div>
        
                {{-- Active Status --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Is Active ?')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_errors_active_status_for_adding_new_leave_type" data-placeholder="Select Active Status" name="is_active" class="form-control select" id="is_active" required>
                        <option value="">Select Active Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span id="parsley_errors_active_status_for_adding_new_leave_type"></span>
                </div>
        
                {{-- Leave Type Description --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Description')}}
                    </label>
                    <textarea name="description" class="form-control" id=""
                        placeholder="Enter Leave Type Description"></textarea>
        
                </div>
        
                @can('employee_leave_type.create')
                    <div class="form-group col-md-12" align="right">
                        {{-- <input type="hidden" name="type[]" value=" "> --}}
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}<img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endcan
            </div>
        </form>
    </div>
</div>
<script>
    $('.select').select2();
</script>