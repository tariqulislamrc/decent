<div class="row p-4">
    <div class="col-md-12">
        <form action="{{route('admin.employee.basic_info.update')}}" id="content_form" method="POST">
            @csrf 
        
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="prefix">{{_lang('Prefix & Code')}} <span class="text-danger">*</span>
                    </label>
                    <div class="row">
                        <div class="col-md-4"><input readonly type="text" name="prefix" id="prefix" class="form-control" placeholder="Prefix" value="{{$model->prefix}}"  required></div>
                        <div class="col-md-8"> <input readonly type="text" name="code" id="code" class="form-control" placeholder="Code Here" required value="{{$model->code}}"></div>
                    </div>
                </div>
        
                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" id="name" class="form-control"
                    placeholder="Enter Name" required value="{{$model->name}}">
                </div>

                {{-- Shift --}}
                <div class="col-md-6 form-group">
                    <label for="shift">{{_lang('Shift')}} <span class="text-danger">*</span>
                    </label>
                    @php
                        $shifts = App\Models\Employee\EmployeeShift::where('status', 1)->get();
                    @endphp
                    <select name="shift" id="shift" class="form-control select" data-placeholder="Select Shift" required>
                        <option value="">{{_lang('Select Shift')}}</option>
                        @foreach ($shifts as $item)
                            <option {{$item->id == $model->shift_id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
        
                {{-- Date Of Birth --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Birth')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" autocomplete="off" readonly="" name="date_of_birth" id="date_of_birth" class="form-control date"  value="{{$model->date_of_birth}}">
                </div>
        
                {{-- Date Of Anniversary --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Date Of Anniversary')}}
                    </label>
                    <input type="text" name="date_of_anniversary" autocomplete="off" readonly="" id="date_of_anniversary" class="form-control date"  value="{{$model->date_of_anniversary}}">
                </div>
        
                {{-- Gender --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Gender')}} <span class="text-danger">*</span>
                    </label>
                    
                    <select data-placeholder="Please Select One" name="gender" id="gender" class="form-control select" required>
                        <option value="">Please Select One..</option>
                        <option {{$model->gender == 'Male' ? 'selected' : ''}} value="Male">Male</option>
                        <option {{$model->gender == 'Female' ? 'selected' : ''}} value="Female">Female</option>
                    </select>
                </div>    
        
                {{-- Marital Status --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang(' Marital Status')}}
                    </label>
                    
                    <select data-placeholder="Please Select One" name="marital_status" id="marital_status" class="form-control select" >
                        <option value="">Please Select One..</option>
                        <option {{$model->marital_status == 'Unmarried' ? 'selected' : ''}} value="Unmarried">Unmarried</option>
                        <option {{$model->marital_status == 'Married' ? 'selected' : ''}} value="Married">Married</option>
                        <option {{$model->marital_status == 'Separete' ? 'selected' : ''}} value="Separete">Separete</option>
                        <option {{$model->marital_status == 'Divorced' ? 'selected' : ''}} value="Divorced">Divorced</option>
                        <option {{$model->marital_status == 'Widow' ? 'selected' : ''}} value="Widow">Widow</option>
                    </select>
                </div>
                
                {{-- Nationality --}}
                <div class="col-md-6 form-group">
                    <label for="nationality">{{_lang('Nationality')}} 
                    </label>
                    <input type="text" name="nationality" id="nationality" class="form-control"
                    placeholder="Enter Employee Nationality"  value="{{$model->nationality}}">
                </div>   
        
                {{-- Mother Tongue --}}
                <div class="col-md-6 form-group">
                    <label for="mother_tongue">{{_lang('Mother Tongue')}}
                    </label>
                    <input type="text" name="mother_tongue" id="mother_tongue" class="form-control"
                    placeholder="Enter Employee Mother Tongue"  value="{{$model->mother_tongue}}">
                </div>   
        
        
                {{-- Father Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Father Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="father_name" id="father_name" class="form-control"
                    placeholder="Enter Father Name" required value="{{$model->father_name}}">
                </div>
        
                {{-- Mother Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Mother Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="mother_name" id="mother_name" class="form-control"
                    placeholder="Enter Mother Name" required value="{{$model->mother_name}}" >
                </div>
        
                <div class="form-group col-md-12" align="right">
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </div>
                
            </div>
        </form>
    </div>
</div>

<script>
    $('.select').select2({ width: '100%' });
    _formValidation();
    _componentDatefPicker();
</script>