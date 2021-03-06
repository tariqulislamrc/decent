<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Nationality')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.setting.member-setting.nationality.store')}}" method="POST" id="content_form">
            <div class="row">    
                {{-- Nationality Name --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Nationality Name')}} <span class="text-danger">*</span> </label>
                    <input type="text" name="name" id="name" class="form-control" required placeholder="Enter Nationality Name">
                </div>

                {{-- Status --}}
                <div class="col-md-12 form-group">
                    <label for="status">{{_lang('Status')}} <span class="text-danger">*</span></label>
                    <select required name="status" id="status" class="form-control select" data-placeholder="Select One" data-parsley-errors-container="#parsley_error_member_nationality_creae_status">
                        <option value="">{{_lang('Select')}}</option>
                        <option selected value="0">{{_lang('Active')}}</option>
                        <option value="1">{{_lang('Inactive')}}</option>
                    </select>
                    <span id="parsley_error_member_nationality_creae_status"></span>
                </div>

                {{-- Description --}}
                <div class="col-md-12 form-group">
                    <label for="description">{{_lang('Description')}}</label>
                    <textarea name="description" id="description" class="form-control" placeholder="Enter Nationality Description" cols="30" rows="2"></textarea>
                </div>
            </div>

            @can('member_nationality_setting.create')
                <div class="form-group col-md-12" align="right">
                    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            @endcan 
        </form>
    </div>
</div>

<script>
    $('.select').select2({width:'100%'});
</script>