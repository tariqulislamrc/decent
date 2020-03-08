<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Employee Designation')}}</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.designation.store_designation')}}" method="post" id="content_form" enctype="multipart/form-data">
            @csrf
            @include('admin.employee.list.designation-history.form')
        </form>
    </div>
</div>
<script type="text/javascript">
    $('.date').datepicker({
        format: "yyyy/mm/dd",
        autoclose: true,
        todayHighlight: true
    });
    $('.select').select2({ width: '100%' });

    $(document).ready(function () {
        $(document).on('change','#document',function () {
           // get the file name, possibly with path (depends on browser)
        var filename = $(this).val();
        // Use a regular expression to trim everything before final dot
        var extension = filename.replace(/^.*\./, '');
        if (extension == filename) {
            extension = '';
        } else {
            extension = extension.toLowerCase();
        }
        if (extension == 'ppt' || extension == 'doc' || extension == 'docx' || extension == 'pdf') {
            console.log("Sohag");
        }else{
            $(this).val("");
            toastr.error('Allowed File File Formates: "doc","docx","pdf" and "ppt". But you Have Selecte Formate:"'+extension+'".');
        }
        });
    });
</script>