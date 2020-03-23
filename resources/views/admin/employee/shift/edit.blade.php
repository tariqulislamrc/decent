<div class="card">
    <div class="card-header">
        <h6 class="text-center"> Edit Employee Shift - <span class="badge badge-primary">{{$model->name}} </span> </h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employee-shift.update',$model->id) }}" method="POST" id="content_form">
            @method('PATCH')
            <div class="row">

                {{-- Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Employee Shift Name')}}</label>
                    <input value="{{$model->name}}" type="text" name="name" id="name" class="form-control" autocomplete="off" placeholder="Enter Shift Name" required>
                </div>

                {{-- Status --}}
                <div class="col-md-6 form-group">
                    <label for="status">{{_lang('Shift Status')}}</label>
                    <select name="status" id="status" class="form-control select" data-placeholder="Select Shift Status" required>
                        <option value="">{{_lang('Select Shift Status')}}</option>
                        <option {{$model->status == 1 ? 'selected' : ''}} value="1">{{_lang('Active')}}</option>
                        <option {{$model->status == 0 ? 'selected' : ''}} value="0">{{_lang('Inctive')}}</option>
                    </select>
                </div>

                {{-- Start Time --}}
                <div class="col-md-6 form-group">
                    <label for="start_time">{{_lang('Start Time')}}</label>
                    <input value="{{$model->start_time}}" type="text" name="start_time" id="start_time" class="form-control timepicker" required placeholder="Enter Start Time">
                </div>

                {{-- End Time --}}
                <div class="col-md-6 form-group">
                    <label for="end_time">{{_lang('End Time')}}</label>
                    <input value="{{$model->end_time}}" type="text" name="end_time" id="end_time" class="form-control timepicker" required placeholder="Enter End Time">
                </div>

                <div class="col-md-12 form-group">
                    <label for="note">{{_lang('Note')}}</label>
                    <textarea name="note" id="note" class="form-control" cols="30" rows="2" placeholder="Enter Note Here">{{$model->note}}</textarea>
                </div>
            </div>

            <div class="form-group col-md-12" align="right">
                {{-- <input type="hidden" name="type[]" value=" "> --}}
                <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Save')}}<i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('backend/js/time.min.js')}}"></script>

<script>
    $('.select').select2();

    $('.timepicker').mdtimepicker();
</script>