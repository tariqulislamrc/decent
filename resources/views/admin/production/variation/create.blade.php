<div class="card">
    <div class="card-header">
        <h6>{{_lang('Add New Production Variation Template')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.production-variation.store')}}" method="post" id="content_form">
            @csrf
                <div class="row">
                    {{-- Variation Name --}}
                    <div class="col-md-6 form-group">
                        <label for="name">{{_lang('Variation Name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Variation Name" required>
                    </div>

                    {{-- Variation Status --}}
                    <div class="col-md-6 form-group">
                        <label for="status">{{_lang('Variation Status')}} <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-control select" data-placeholder="Select Status" required >
                            <option value="">{{_lang('Select Status')}}</option>
                            <option selected value="1">{{_lang('Active')}}</option>
                            <option value="0">{{_lang('Inactive')}}</option>
                        </select>
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="value">{{_lang('Variation Value')}} <span class="text-danger">*</span></label>
                        <input type="text" name="value[]" id="value" class="form-control" placeholder="Enter Variation Value" required>
                    </div>

                    <div id="data" class="col-md-12 form-group"></div>
                    <input type="hidden" name="number" id="number" value="0">
                
                    <button data-url="{{route('admin.production-variation.addmore')}}" type="button" class="btn btn-info"  id="add">{{_lang('Add More')}}<i class="icon-arrow-right14 position-right"></i></button> 
                </div>
            <div class="text-right">
                <button type="submit" class="btn btn-primary"  id="submit">{{_lang('Create')}}<i class="icon-arrow-right14 position-right"></i></button>
                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>

<script>

    $('.select').select2();
    // add One More Subcatagory
    $('#add').click(function() {
        var variation = $('#value').val();
        if (variation == '') {
            toastr.warning('Please Select Variation Value First');
        } else {
            var url = $(this).data('url');
            var type = $('#number').val();
            type = parseInt(type);
            row = type + 1;
            $('#number').val(row);
            if (row > 4) {
                toastr.info('You already make 15 Variation Value. It is not possible to make more...');
            } else {
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'html',
                    data: {
                        row: row
                    },
                    success: function(data) {
                        $('#data').append(data);
                        _componentSelect2Normal();
                    }
                });
            }
        }
    });

    // delete the row
    $("#data").on('click', '.closeAddMore', function() {
        var row_id = $(this).data('id');
        $("." + row_id).fadeOut('slow').remove();
    });
</script>