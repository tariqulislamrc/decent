<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Designation')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.designation.store')}}" method="post" id="content_form">
            @csrf
            <div class="row">
                {{-- Employee Designation Name --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Designation Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Employee Designation Name"
                        required>
                </div>
        
                {{-- Category --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Category')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_add_designation_catagory" data-placeholder="Please Select One" name="employee_category_id" id="employee_category_id" class="form-control select" required>
                        <option value="">Please Select One</option>
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    <span id="parsley_add_designation_catagory"></span>
                </div>
        
                {{-- Top Designation --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Top Designation')}} 
                    </label>
                    <select data-placeholder="Please Select One" name="top_designation_id" id="top_designation_id" class="form-control select" >
                        <option value="">Please Select One</option>
                        @foreach ($designations as $designation)
                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                        @endforeach
                    </select>
                </div>
        
        
                {{-- Designation Description --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Description')}}
                    </label>
                    <textarea name="description" class="form-control" id=""
                        placeholder="Enter Designation Description"></textarea>
        
                </div>
        
                <div class="form-group col-md-12" align="right">
                    {{-- <input type="hidden" name="type[]" value=" "> --}}
                    @can('employee-designation.create')
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                                class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                    @endcan
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $('.select').select2({width: '100%'});
</script>