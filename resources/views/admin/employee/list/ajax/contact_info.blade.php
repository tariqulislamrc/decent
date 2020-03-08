<div class="row p-4">
    <div class="col-md-12">
        <form action="{{route('admin.employee.contact_info.update')}}" id="content_form" method="POST" >
            <div class="row">
        
                {{-- Contact Number --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Contact Number')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="contact_number" id="contact_number" class="form-control"
                    placeholder="Enter Contact Number" required maxlength="14" value="{{$model->contact_number}}">
                </div>   
        
                {{-- Alternative Contact Number --}}
                <div class="col-md-6 form-group">
                    <label for="alternate_contact_number">{{_lang('Alternative Contact Number')}}
                    </label>
                    <input type="text" name="alternate_contact_number" id="alternate_contact_number" class="form-control"
                    placeholder="Enter Alternative Contact Number"  maxlength="14" value="{{$model->alternate_contact_number}}">
                </div>  
                
                {{-- Email --}}
                <div class="col-md-6 form-group">
                    <label for="email">{{_lang('Employee Email')}} <span class="text-danger">*</span>
                    </label>
                    <input required type="email" name="email" id="email" class="form-control"
                    placeholder="Enter Employee Email Address" value="{{$model->email}}">
                </div>   
        
                {{-- Alternative Email --}}
                <div class="col-md-6 form-group">
                    <label for="alternate_email">{{_lang(' Alternative Employee Email')}} <span class="text-danger">*</span>
                    </label>
                    <input type="email" name="alternate_email" id="alternate_email" class="form-control"
                    placeholder="Enter Alternative Employee Email Address" value="{{$model->alternate_email}}">
                </div>   
        
                {{-- Emmergency Contact Name --}}
                <div class="col-md-12 form-group">
                    <label for="emergency_contact_name">{{_lang('Emmergency Contact Name')}} <span class="text-danger">*</span>
                    </label>
                    <input required type="text" name="emergency_contact_name" id="emergency_contact_name" class="form-control"
                    placeholder="Enter Employee Emmergency Contact Name" value="{{$model->emergency_contact_name}}">
                </div>   
        
                {{-- Present Address Line 1 --}}
                <div class="col-md-4 form-group">
                    <label for="present_address_line_1">{{_lang('Employee Present Address Line 1')}} <span class="text-danger">*</span>
                    </label>
                    <input required type="text" name="present_address_line_1" id="present_address_line_1" class="form-control"
                    placeholder="Enter Employee Present Address Line 1" value="{{$model->present_address_line_1}}">
                </div>   
        
                {{-- Present Address Line 2 --}}
                <div class="col-md-4 form-group">
                    <label for="present_address_line_2">{{_lang('Employee Present Address Line 2')}} 
                    </label>
                    <input type="text" name="present_address_line_2" id="present_address_line_2" class="form-control"
                    placeholder="Enter Employee Present Address Line 2"  value="{{$model->present_address_line_2}}">
                </div>   
        
                {{-- City --}}
                <div class="col-md-4 form-group">
                    <label for="present_city">{{_lang('Employee Present City')}} 
                    </label>
                    <input required type="text" name="present_city" id="present_city" class="form-control"
                    placeholder="Enter Employee Present City" value="{{$model->present_city}}">
                </div>   
        
                {{-- Statue --}}
                <div class="col-md-4 form-group">
                    <label for="present_state">{{_lang('Employee Present State')}} 
                    </label>
                    <input required type="text" name="present_state" id="present_state" class="form-control"
                    placeholder="Enter Employee Present State"  value="{{$model->present_state}}">
                </div>   
        
                {{-- Zipcode --}}
                <div class="col-md-4 form-group">
                    <label for="present_zipcode">{{_lang('Employee Present Zipcode')}} 
                    </label>
                    <input required type="text" name="present_zipcode" id="present_zipcode" class="form-control"
                    placeholder="Enter Employee Present Zipcode"  value="{{$model->present_zipcode}}">
                </div>   
        
                {{-- Country --}}
                <div class="col-md-4 form-group">
                    <label for="present_country">{{_lang('Employee Present Country')}} 
                    </label>
                    <input required type="text" name="present_country" id="present_country" class="form-control"
                    placeholder="Enter Employee Present Country"  value="{{$model->present_country}}">
                </div>   
        
                {{-- Parmanent Address --}}
                <div class="col-md-12 form-group">
                    <label for="same_as_present_address">Parmanent Address</label>
                    <select data-placeholder="Please Select One" name="same_as_present_address" id="same_as_present_address" class="form-control select" >
                        <option {{$model->same_as_present_address == '1' ? 'selected' : ''}} selected value="1">Yes</option>
                        <option {{$model->same_as_present_address == '0' ? 'selected' : ''}} value="0">No</option>
                    </select>
                </div>
        
                <div class="row" id="present_address" style="display:none;">
                    {{-- Present Address Line 1 --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_address_line_1">{{_lang('Employee Parmanent Address Line 1')}} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="permanent_address_line_1" id="permanent_address_line_1" class="form-control"
                        placeholder="Enter Employee Parmanent Address Line 1" value="{{$model->permanent_address_line_1}}">
                    </div>   
        
                    {{-- Present Address Line 2 --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_address_line_2">{{_lang('Employee Parmanent Address Line 2')}} 
                        </label>
                        <input type="text" name="permanent_address_line_2" id="permanent_address_line_2" class="form-control"
                        placeholder="Enter Employee Parmanent Address Line 2"  value="{{$model->permanent_address_line_2}}">
                    </div>   
        
                    {{-- City --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_city">{{_lang('Employee Parmanent City')}} 
                        </label>
                        <input type="text" name="permanent_city" id="permanent_city" class="form-control"
                        placeholder="Enter Employee Parmanent City" value="{{$model->permanent_city}}">
                    </div>   
        
                    {{-- Statue --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_state">{{_lang('Employee Parmanent State')}} 
                        </label>
                        <input type="text" name="permanent_state" id="permanent_state" class="form-control"
                        placeholder="Enter Employee Parmanent State"  value="{{$model->permanent_state}}">
                    </div>   
        
                    {{-- Zipcode --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_zipcode">{{_lang('Employee Parmanent Zipcode')}} 
                        </label>
                        <input type="text" name="permanent_zipcode" id="permanent_zipcode" class="form-control"
                        placeholder="Enter Employee Parmanent Zipcode"  value="{{$model->permanent_zipcode}}">
                    </div>   
        
                    {{-- Country --}}
                    <div class="col-md-4 form-group">
                        <label for="permanent_country">{{_lang('Employee Parmanent Country')}} 
                        </label>
                        <input type="text" name="permanent_country" id="permanent_country" class="form-control"
                        placeholder="Enter Employee Parmanent Country"  value="{{$model->permanent_country}}">
                    </div>   
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
    _formValidation();
    $('.date').datepicker({
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
    $('.select').select2({ width: '100%' });

            $('#same_as_present_address').change(function() {
                var id = $(this).val();

                if(id == '0') {
                    $('#present_address').fadeIn(1000);
                } else {
                    $('#present_address').fadeOut(1000);
                }
            });

            $(document).ready(function() {
                var id = $('#same_as_present_address').val();
                if(id == 0) {
                    $('#present_address').fadeIn(1000);
                }
            })
</script>