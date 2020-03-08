<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Employee Department')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee.department.store')}}" method="post" id="content_form">
            @csrf
                <div class="row">
                    {{-- Employee Department Name --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Department Name')}} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter Employee Department Name" required>
                    </div>
                    {{-- Employee Department Description --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Department Description')}}
                        </label>
                        <textarea name="description" class="form-control" id="" placeholder="Enter Employee Department Description"></textarea>
                        
                    </div>
                    @can('employee_departmeent.create')
                        <div class="form-group col-md-12" align="right">
                            {{-- <input type="hidden" name="type[]" value=" "> --}}
                            <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Save')}}<i class="icon-arrow-right14 position-right"></i></button>
                            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    @endcan
                </div>
        </form>
    </div>
</div>