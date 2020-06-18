<div class="card">
    <div class="card-header">
        <h6>{{_lang('View Product Rating - ')}} </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.eCommerce.product-rating.status_change', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="row">

                {{-- Select Status --}}
                <div class="form-group col-md-6">
                    <label>{{_lang('Rating Comment:')}} </label> <br>
                    {{$model->comment}}
                </div>

                <div class="form-group col-md-6">
                    <label>{{_lang('Select Status')}} <span class="text-danger">*</span></label>
                    <select required data-placeholder="Select Status" name="status" class="form-control select">
                        <option value="1" {{$model->status == '1'?'selected':''}}>Active</option>
                        <option value="0" {{$model->status == '0'?'selected':''}}>InActive</option>
                    </select>
                </div>
                     
                @can('product_rating.update')
                    <div class="form-group col-md-12" align="right">
                        {{-- <input type="hidden" name="type[]" value=" "> --}}
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                                class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endcan
            </div>
        </form>        
    </div>
</div>
<script>
    $('.select').select2();

</script>
<script src="{{ asset('js/eCommerce/rating.js') }}"></script>