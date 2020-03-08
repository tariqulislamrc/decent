<div class="card">
    <div class="card-header">
        <h6>{{_lang('Add New Employee')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-list.store')}}" method="post" id="content_form">
            @csrf
            <div class="row">
        
                <div class="col-md-6 form-group">
                    <label for="prefix">{{_lang('Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-4"><input type="text" name="prefix" id="prefix" class="form-control" placeholder="Prefix" value="{{$code_prefix}}"  required></div>
                        <div class="col-md-8"> <input type="text" name="code" id="code" class="form-control" placeholder="Code Here" required value="{{$uniqu_id}}"></div>
                    </div>
                </div>
        
                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control"
                    placeholder="Enter Name" required>
                </div>
        
        
        
                {{-- Designation --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Designation')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_designation_for_creating_new_employee" name="designation" data-placeholder="Please Select One.." class="form-control select" id="designation" required>
                        <option value="">Please Select One..</option>
                        @foreach($designations as $designation){
                        <option value="{{$designation->id}}">{{$designation->name}}</option>
                    }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_designation_for_creating_new_employee"></span>
                </div>
        
        
                 {{-- Department --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Department')}} <span class="text-danger">*</span>
                    </label>
                    <select data-parsley-errors-container="#parsley_error_select_department_for_creating_employee" name="department" data-placeholder="Please Select One.." class="form-control select" id="department" required>
                        <option value="">Please Select One..</option>
                         @foreach($departments as $department){
                        <option value="{{$department->id}}">{{$department->name}}</option>
                    }
                        @endforeach
                    </select>
                    <span id="parsley_error_select_department_for_creating_employee"></span>
                </div>  
        
        
                {{-- Father Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Father Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="father_name" id="father_name" class="form-control"
                    placeholder="Enter Father Name" required>
                </div>
        
                {{-- Mother Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Mother Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control"
                    placeholder="Enter Mother Name" required>
                </div>
        
                {{-- Contact Number --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Contact Number')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control"
                    placeholder="Enter Contact Number" required maxlength="14">
                </div>   
        
                {{-- Gender --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Gender')}} <span class="text-danger">*</span>
                    </label>
                    
                    <select data-parsley-errors-container="#parsley_error_select_gender_for_creating_new_employee" data-placeholder="Please Select One" name="gender" id="gender" class="form-control select" required>
                        <option value="">Please Select One..</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                    <span id="parsley_error_select_gender_for_creating_new_employee"></span>
                </div>    
        
                {{-- Date Of Birth --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Birth')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" autocomplete="off" name="date_of_birth" id="date_of_birth" class="form-control date" required>
                </div>
        
                {{-- Date Of Joining --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Joining')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="joining_date" autocomplete="off" id="joining_date" class="form-control date" required>
                </div>
        
                @can('employee_list.create')
                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endcan
            </div>
        </form>
        <script type="text/javascript">
            $('.select').select2({ width: '100%' });
        </script>
    </div>
</div>