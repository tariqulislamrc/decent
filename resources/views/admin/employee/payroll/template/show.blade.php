<div class="mb-2">{{$model->description}}</div>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Pay Head</th>
                    <th>Category</th>
                    <th>Computation Formula</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model->details as $item)
                <tr>
                    <td class="{{$item->payhead->type== 'Earning'?'text-success':'text-danger'}}">{{$item->payhead?$item->payhead->name:''}}</td>
                    <td>
                        {{$item->category}}
                    </td>
                    <td>
                        {{$item->computation}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>
    <p><i class="far fa-clock"></i> <small>Created at {{$model->created_at}}</small> <span class="pull-right"><i
                class="far fa-clock"></i> <small>Last Updated at {{$model->updated_at}}</small></span></p>
