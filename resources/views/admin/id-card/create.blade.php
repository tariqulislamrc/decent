<form action="{{route('admin.id-card-template.store')}}" method="post" id="content_form">
    @csrf
    <div class="row">
        {{-- Template Name --}}
        <div class="col-md-6 form-group">
            <label for="name">{{_lang('Template Name')}} <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control"
                placeholder="Enter Employee Template Name" required>
        </div>
        {{-- Width --}}
        <div class="col-md-6 form-group">
            <label for="width">{{_lang('Width')}}
            </label>
            <div class="input-group"><input type="text" required name="width" placeholder="Width" class="form-control"> <div class="input-group-append"><span class="input-group-text">mm</span></div></div>
        </div>
        {{-- Height --}}
        <div class="col-md-6 form-group">
            <label for="height">{{_lang('Height')}}
            </label>
            <div class="input-group"><input type="text" required name="height" placeholder="Height" class="form-control"> <div class="input-group-append"><span class="input-group-text">mm</span></div></div>
        </div>

        {{-- No of Id Cards shown Per Page --}}
        <div class="col-md-6 form-group">
            <label for="show_per_page">{{_lang('No of Id Cards shown Per Page')}}
            </label>
            <input type="text" name="show_per_page" id="show_per_page" class="form-control"
                placeholder="Enter No of Id Cards shown Per Page" required>
        </div>
        
        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
    </div>
</form>

<script>
    $('.select').select2({  width: '100%' });
</script>