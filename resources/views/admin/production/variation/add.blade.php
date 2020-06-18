{{-- This page is for Add one more catagory dynamically --}}
<div id="hello" class="row_{{$row}} mt-2">
    <div class="row">
        <div class="col-md-10 form-group">
            <input type="text" required name="value[]" id="value" class="form-control" placeholder="Enter Variation Value">
        </div>
        <div class="col-md-2 form-group">
            <button class="btn btn-danger closeAddMore text-center" data-id="row_{{$row}}"  type="button"><i class="fa fa-trash fa-3x"></i></button>
        </div>
        {{-- Delete Row Button --}}
    </div>
</div>
