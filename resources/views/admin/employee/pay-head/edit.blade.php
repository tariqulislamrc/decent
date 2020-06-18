<div class="card">
    <div class="card-header">
        <h6>{{_lang('Edit Employee Pay Head - ')}} <span class="badge badge-primary">{{$model->name}}</span></h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-pay-head.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="row">
                {{-- Employee Pay Head Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Pay Head Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Pay Head Name"
                        required value="{{$model->name}}">
                </div>
        
                {{-- Alias --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Alias')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="alias" id="alias" class="form-control" placeholder="Enter Alias" required
                        value="{{$model->alias}}">
                </div>
        
                {{-- Type --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Type')}} <span class="text-danger">*</span>
                    </label>
                    <select data-placeholder="Select Employee Pay Head Type" name="type" class="form-control select" id="type" required>
                        <option value="">Select Employee Pay Head Type</option>
                        <option value="Earning" {{$model->type == "Earning" ? "Selected":""}}>Earning</option>
                        <option value="Deduction" {{$model->type == "Deduction" ? "Selected":""}}>Deduction</option>
                    </select>
        
                </div>
        
                {{-- Active Status --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Is Active ?')}} <span class="text-danger">*</span>
                    </label>
                    <select data-placeholder="Enter Active Status" name="is_active" class="form-control select" id="is_active" required>
                        <option value="">Enter Active Status</option>
                        <option value="1" {{$model->is_active == 1 ? "Selected":""}}>Active</option>
                        <option value="0" {{$model->is_active == 0 ? "Selected":""}}>Inactive</option>
                    </select>
                </div>
        
                {{-- Pay Head Description --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Description')}} <span class="text-danger">*</span>
                    </label>
                    <textarea name="description" class="form-control" id=""
                        placeholder="Enter Pay Head Description">{{$model->description}}</textarea>
        
                </div>
        
                @can('employee_payhead.update')
                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
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