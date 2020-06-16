@php

    $find_shiping_address = App\models\eCommerce\ClientShippingAddress::where('transaction_id', $model->id)->first();
    if($find_shiping_address) {
        $x = 1;
    } else {
        $x = 0;
    }

    function get_product_code($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            if($query->prefix != '' ) {
                $prefix = $query->prefix;
            } else {
                $prefix = '';
            }

            if($query->code != '' ) {
                $code = $query->code;
            } else {
                $code = '';
            }

            $name = $prefix . '-' . $code;

        } else {
            $name = 'No Product Found';
        }

        return $name;

    }

    function get_product_name($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            $name = $query->name;

        } else {
            $name = 'No Product Found';
        }

        return $name;
    }

    function get_product_image($id) {
        $query = App\models\Production\Product::where('id', $id)->first();
        if($query) {

            $name = '<img width="100px;" alt="Product Image" src="/storage/product/'.$query->photo.'">';

        } else {
            $name = 'No Product Found';
        }

        return $name;
    }

    function get_product_color($id) {
        $query = App\models\Production\Variation::where('id', $id)->first();
        if($query) {
            $variation_value_id = $query->variation_value_id_2;
            $find = App\models\Production\VariationTemplateDetails::where('id', $variation_value_id)->first();

            if($find) {
                $name = $find->name;
            } else {
                $name = 'Color Not Found';
            }
        } else {
            $name = 'No Color Found';
        }

        return $name;
    }

    function get_product_size($id) {
        $query = App\models\Production\Variation::where('id', $id)->first();
        if($query) {
            $variation_value_id = $query->variation_value_id;
            $find = App\models\Production\VariationTemplateDetails::where('id', $variation_value_id)->first();

            if($find) {
                $name = $find->name;
            } else {
                $name = 'Color Not Found';
            }
        } else {
            $name = 'No Color Found';
        }

        return $name;
    }
@endphp
<div class="card">
    <div class="card-header">
        <h6 class="text-center">{{_lang('OrDer Details -')}} <span class="badge badge-primary">{{$model->reference_no}}</span> </h6>
    </div>
    <div class="card-body">
        <div class="row">
            {{-- Order Detailse --}}
            <div class="col-md-6 table-responsive">
                <h6 class="text-center">{{_lang('Order Details')}}</h6>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="50%">{{_lang('Name')}}</th>
                        <td>{{get_client_name($model->client_id)}}</td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Phone')}}</th>
                        <td>{{get_client_phone($model->client_id)}}</td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Payment')}}</th>
                        <td> 
                            @if ($model->payment_status == 'cash_on_delivery')
                                {{_lang('Cash Or Delivery')}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Payment ID')}}</th>
                        <td>{{$model->invoice_no}}</td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Total')}}</th>
                        <td>{{$model->net_total}}</td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Month')}}</th>
                        <td>{{$model->created_at->format('F')}}</td>
                    </tr>
                    <tr>
                        <th width="50%">{{_lang('Date')}}</th>
                        <td>{{formatDate($model->created_at)}}</td>
                    </tr>
                    @if ($model->discount_type == 'Coupon')
                        <tr>
                            <td>Coupon Amount</td>
                            <td>{{ number_format($model->discount, 2) }} </td>
                        </tr>
                    @endif
                </table>
            </div>

            {{-- Shipping Details --}}
            <div class="col-md-6 table-responsive">
                <h6 class="text-center">{{_lang('Shipping Details')}}</h6>
                <form action="{{route('admin.eCommerce.order.change_ship_address')}}" method="POST" id="content_form">
                    @csrf
                    <input type="hidden" name="id" value="{{$model->id}}">
                    @if ($x != 1)
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="50%">{{_lang('Name')}}</th>
                                <td> 
                                    <div class="name_show">{{get_client_name($model->client_id)}}</div>
                                    <div style="display:none;" class="name_hide"> <input required type="text" name="client_name" class="form-control" value="{{get_client_name($model->client_id)}}"> </div>    
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Phone')}}</th>
                                <td>
                                    <div class="phone_show">{{get_client_phone($model->client_id)}}</div>
                                    <div style="display:none;" class="phone_hide"><input required type="text" name="client_phone" class="form-control" value="{{get_client_phone($model->client_id)}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Email')}}</th>
                                <td>
                                    <div class="email_show">{{get_client_email($model->client_id)}}</div>
                                    <div style="display:none;" class="email_hide"> <input required type="email" name="client_email" class="form-control" value="{{get_client_email($model->client_id)}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Address')}}</th>
                                <td>
                                    <div class="address_show">{{get_client_address($model->client_id)}}</div>
                                    <div style="display:none;" class="address_hide"><textarea required name="client_address" class="form-control" cols="30" rows="2">{{get_client_address($model->client_id)}}</textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('City')}}</th>
                                <td>
                                    <div class="city_show">{{get_client_city($model->client_id)}}</div>
                                    <div style="display:none;" class="city_hide"><input required type="text" name="client_city" class="form-control" value="{{get_client_city($model->client_id)}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Status')}}</th>
                                <td>
                                    <span id="order_status">
                                        @if ($model->ecommerce_status == 'pending')
                                            {{_lang('Pending')}}
                                        @elseif( $model->ecommerce_status == 'confirm')
                                            {{_lang('Confirm')}}
                                        @elseif( $model->ecommerce_status == 'progressing')
                                            {{_lang('In Progressing')}}
                                        @elseif( $model->ecommerce_status == 'shipment')
                                            {{_lang('In Shipment')}}
                                        @elseif( $model->ecommerce_status == 'success')
                                            {{_lang('Success')}}
                                        @else 
                                            {{_lang('Cancel')}}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Tracking Code')}}</th>
                                <td>{{$model->reference_no}} </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Note')}}</th>
                                <td>
                                    <div class="note_show">{{$model->sell_note}}</div>
                                    <div style="display:none;" class="note_hide"><textarea name="note" id="note" class="form-control" cols="30" rows="2">{{$model->sell_note}}</textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" colspan="2">
                                    <a href="{{ route('admin.eCommerce.update_invoice', $model->id) }}" target="_blank"><button type="button" class="btn btn-primary btn-sm">Update The Invoice</button></a>
                                </th>
                            </tr>
                        </table>
                    @else 
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th width="50%">{{_lang('Name')}}</th>
                                <td> 
                                    <div class="name_show">{{$find_shiping_address->client_name}}</div>
                                    <div style="display:none;" class="name_hide"> <input required type="text" name="client_name" class="form-control" value="{{$find_shiping_address->client_name}}"> </div>    
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Phone')}}</th>
                                <td>
                                    <div class="phone_show">{{$find_shiping_address->client_phone}}</div>
                                    <div style="display:none;" class="phone_hide"><input required type="text" name="client_phone" class="form-control" value="{{$find_shiping_address->client_phone}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Email')}}</th>
                                <td>
                                    <div class="email_show">{{$find_shiping_address->client_email}}</div>
                                    <div style="display:none;" class="email_hide"> <input required type="email" name="client_email" class="form-control" value="{{$find_shiping_address->client_email}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Address')}}</th>
                                <td>
                                    <div class="address_show">{{$find_shiping_address->client_address}}</div>
                                    <div style="display:none;" class="address_hide"><textarea required name="client_address" class="form-control" cols="30" rows="2">{{$find_shiping_address->client_address}}</textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('City')}}</th>
                                <td>
                                    <div class="city_show">{{$find_shiping_address->client_city}}</div>
                                    <div style="display:none;" class="city_hide"><input required type="text" name="client_city" class="form-control" value="{{$find_shiping_address->client_city}}"> </div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Status')}}</th>
                                <td>
                                    <span id="order_status">
                                        @if ($model->ecommerce_status == 'pending')
                                            {{_lang('Pending')}}
                                        @elseif( $model->ecommerce_status == 'confirm')
                                            {{_lang('Confirm')}}
                                        @elseif( $model->ecommerce_status == 'progressing')
                                            {{_lang('In Progressing')}}
                                        @elseif( $model->ecommerce_status == 'shipment')
                                            {{_lang('In Shipment')}}
                                        @elseif( $model->ecommerce_status == 'success')
                                            {{_lang('Success')}}
                                        @else 
                                            {{_lang('Cancel')}}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Tracking Code')}}</th>
                                <td>{{$model->reference_no}} </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Note')}}</th>
                                <td>
                                    <div class="note_show">{{$find_shiping_address->note}}</div>
                                    <div style="display:none;" class="note_hide"><textarea name="note" id="note" class="form-control" cols="30" rows="2">{{$find_shiping_address->note}}</textarea></div>
                                </td>
                            </tr>
                            <tr>
                                <th width="50%">{{_lang('Edit Information')}}</th>
                                <td>
                                    <div class="button_show"><button class="btn btn-info btn-block" type="button" id="edit">Edit  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> </div>
                                    <div style="display:none;" class="button_hide">
                                        <div class="row">
                                            <div class="col-md-6 mt-2">
                                                <button class="btn btn-primary btn-block " type="submit" id="submit">Save</button> 
                                                <button type="button" class="btn btn-primary btn-blick" disabled  id="submiting" style="display: none;">{{_lang('Saving')}} <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></button>

                                            </div>
                                            <div class="col-md-6 mt-2">
                                                <button class="btn btn-danger btn-block" type="button" id="cancel">Cancel </button> 
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    @endif
                </form>
            </div>

            {{-- Product Details --}}
            <div class="col-md-12 my-3 table-responsive">
                <h6 class="text-center">{{_lang('Product Details')}} </h6>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{_lang('Product Code')}}</th>
                            <th>{{_lang('Product Name')}}</th>
                            <th>{{_lang('Product Image')}}</th>
                            <th>{{_lang('Color')}}</th>
                            <th>{{_lang('Size')}}</th>
                            <th>{{_lang('Quantity')}}</th>
                            <th>{{_lang('Unit Price')}}</th>
                            <th>{{_lang('Total')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($products) > 0)
                            @foreach ($products as $item)
                                <tr>
                                    <td>{{get_product_code($item->product_id)}}</td>
                                    <td>{{get_product_name($item->product_id)}}</td>
                                    <td class="text-center">{!!get_product_image($item->product_id)!!}</td>
                                    <td>{{get_product_color($item->variation_id)}}</td>
                                    <td>{{get_product_size($item->variation_id)}}</td>
                                    <td>{{round($item->quantity)}}</td>
                                    <td>{{round($item->unit_price)}} </td>
                                    <td>{{round($item->total)}} </td>
                                </tr>
                            @endforeach
                        @else 
                            <td colspan="8">{{_lang('No Product Found!!!')}} </td>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Order Note --}}
            <div class="col-md-12 form-group">
                <label for="order_note">Order Note</label>
                <textarea name="order_note" id="order_note" class="form-control" cols="30" rows="2" placeholder="Enter Order Note">{{ $model->sell_note }}</textarea>
            </div>

            {{-- Change Order Status --}}
            <div class="col-md-6 form-group">
                <div class="text-center" id="show_loader_1" style="display:none;">
                    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                </div>
                <input type="hidden" name="id" id="id" value="{{$model->id}}">
                <label for="change_status">{{_lang('Change Order Status')}} </label>
                <select data-url="{{route('admin.eCommerce.order.change_status')}}" name="change_status" id="change_status" class="form-control select">
                    <option {{$model->ecommerce_status == 'pending' ? 'selected' : ""}} value="pending">{{_lang('Pending')}}</option>
                    <option {{$model->ecommerce_status == 'confirm' ? 'selected' : ""}} value="confirm">{{_lang('Confirm')}}</option>
                    <option {{$model->ecommerce_status == 'progressing' ? 'selected' : ""}} value="progressing">{{_lang('In Progressing')}}</option>
                    <option {{$model->ecommerce_status == 'shipment' ? 'selected' : ""}} value="shipment">{{_lang('In Shipment')}}</option>
                    <option {{$model->ecommerce_status == 'success' ? 'selected' : ""}} value="success">{{_lang('Success')}}</option>
                    <option {{$model->ecommerce_status == 'cancel' ? 'selected' : ""}} value="cancel">{{_lang('Cancel')}}</option>
                </select>
            </div>

            {{-- Get An Invoice --}}
            <div class="col-md-6">
                <label for="">{{_lang('Generate An Invoice')}} </label>
                <a href="{{route('admin.eCommerce.order.pdf',$model->reference_no)}}" target="blank"><button type="button" class="btn btn-primary btn-block text-center">{{_lang('Print Invoice')}}</button></a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var change_status = $("#change_status").val();
        if(change_status =="success"){
            $('#change_status').prop('disabled', true);
        }else{
            $('#change_status').prop('disabled', false);
        }
    });
    $('#change_status').change(function() {
        var val = $(this).val();
        var id = $('#id').val();
        var note = $('#order_note').val();
        var url = $(this).data('url');
        $.ajax({
            type: 'GET',
            url: url,
            data: {
                id: id, val: val, note:note
            },
            beforeSend: function() {
                $('#show_loader_1').fadeIn();
            }, 
            success: function (data) {
                if(data.status == 'success') {
                    toastr.success(data.message);
                    if(data.html) {
                        $('#order_status').html(data.html);
                    }
                }
                if(data.status == 'danger') {
                    toastr.error(data.message);
                }
                $('#show_loader_1').fadeOut();
            }
        });
    });

    $('#edit').click(function() {
        $('.name_show').fadeOut();
        $('.name_hide').fadeIn();
        $('.phone_show').fadeOut();
        $('.phone_hide').fadeIn();
        $('.email_show').fadeOut();
        $('.email_hide').fadeIn();
        $('.address_show').fadeOut();
        $('.address_hide').fadeIn();
        $('.city_show').fadeOut();
        $('.city_hide').fadeIn();
        $('.note_show').fadeOut();
        $('.note_hide').fadeIn();
        $('.button_show').fadeOut();
        $('.button_hide').fadeIn();
    });

    $('#cancel').click(function() {
        $('.name_show').fadeIn();
        $('.name_hide').fadeOut();
        $('.phone_show').fadeIn();
        $('.phone_hide').fadeOut();
        $('.email_show').fadeIn();
        $('.email_hide').fadeOut();
        $('.address_show').fadeIn();
        $('.address_hide').fadeOut();
        $('.city_show').fadeIn();
        $('.city_hide').fadeOut();
        $('.note_show').fadeIn();
        $('.note_hide').fadeOut();
        $('.button_show').fadeIn();
        $('.button_hide').fadeOut();
    });
</script>