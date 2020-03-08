<div class="card">
    <div class="card-header">
        <h6>{{_lang('Ceate New Employee Document Type')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-document-type.store')}}" method="post" id="content_form">
            @csrf
                <div class="row">
                    {{-- Employee Document Type Name --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Document Type Name')}} <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="name" id="name" class="form-control"
                            placeholder="Enter Employee Document Type Name" required>
                    </div>
                    {{-- Employee Document Type Description --}}
                    <div class="col-md-12 form-group">
                        <label for="name">{{_lang('Document Type Description')}} 
                        </label>
                        <textarea name="description" class="form-control" id="" placeholder="Enter Employee Document Type Description"></textarea>
                        
                    </div>
                    @can('employee_document_type.create')
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