<div class="card">
    <div class="card-header">
        <h6>{{_lang('Create New Qualification for the Employee')}} \</h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-qua.store')}}" method="post" id="content_form" enctype="multipart/form-data">
            @csrf
            @include('admin.employee.list.qualification-history.form')
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
</script>