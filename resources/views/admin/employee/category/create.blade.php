<div class="card">
    <div class="card-header">
        <h6>{{_lang('Add New Employee Category')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-category.store')}}" method="post" id="content_form">
            @csrf
                <div class="row">
                    {{-- Employee Category Name --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Category Name')}} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" autocomplete="off" class="form-control" placeholder="Enter Employee Category Name" required>
                    </div>
                    {{-- Employee Category Description --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Category Description')}}
                        </label>
                        <textarea name="description" class="form-control" id="" placeholder="Enter Employee Category Description"></textarea>
                        
                    </div>
                    <div class="form-group col-md-12" align="right">
                        {{-- <input type="hidden" name="type[]" value=" "> --}}
                        <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </form>
    </div>
</div>
