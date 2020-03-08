<div class="row">
    {{-- Employee Document Type --}}
    <div class="col-md-6 form-group">
        <label for="employee_document_type_id">{{_lang('Select Employee Document Type')}}  <span class="text-danger">*</span>
        </label>
        <select name="employee_document_type_id" id="employee_document_type_id" required class="form-control select" data-placeholder="Select One">
            <option value="">{{_lang('Select One')}}</option>
            @foreach ($employee_document_types as $item)
                <option value="{{$item->id}}" {{$item->id == $model->employee_document_type_id ? 'selected' : ''}} >{{$item->name}}</option>
            @endforeach
        </select>
    </div>

    {{-- Title --}}
    <div class="col-md-6 form-group">
        <label for="title">{{_lang('Title')}} <span class="text-danger">*</span></label>
        <input type="text" name="title" id="title" class="form-control" placeholder="Enter Document Title" required value="{{$model->title}}"> 
    </div>

    {{-- Description --}}
    <div class="col-md-12 form-group">
        <label for="description">{{_lang('Description')}}</label>
        <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="Enter Document Description" >{{$model->description}}</textarea>
    </div>

    {{-- File --}}
    <div class="col-md-12 form-group">
        <label for="upload_token">{{_lang('Document File')}} <span class="text-danger">*</span></label>
        <input type="file" name="upload_token" class="form-control" id="upload_token">
    </div>

    @if ($model->upload_token != '') 
        <div class="col-md-12">
            <a target="_blank" href="{{asset('storage/document')}}/{{$model->upload_token}}" alt="Document Not Uploaded"><i class="fa fa-folder-open mr-2" aria-hidden="true"></i> The Document File</a>
        </div>
    @endif
</div>

<div class="form-group col-md-12" align="right">
    <input type="hidden" name="employee_id" value="{{$employee_id}}">
    <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Save')}}<i class="icon-arrow-right14 position-right"></i></button>
    <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>