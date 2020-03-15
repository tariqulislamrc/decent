 @foreach ($models as $model)

 @php
 $product = App\models\Production\Product::with('photo_details', 'variation')->findOrFail($model->id);
 @endphp
 <div class="row border">
     <div class="col-xs-12 col-sm-2">
         <div class="img-holder">
             <img src="{{$product->photo?asset('storage/product/'.$product->photo):'http://placehold.it/105x105'}}"
                 alt="image description">
         </div>
     </div>
     <div class="col-xs-12 col-sm-4">
         <strong class="product-name">{{$model->name}}</strong>
     </div>
     <div class="col-xs-12 col-sm-2">
         <strong class="price"><i class="fa fa-eur"></i> {{$model->price}}</strong>
     </div>
     <div class="col-xs-12 col-sm-2">
         <form action="#" class="qyt-form">
             <fieldset>
                 <input type="hidden" id="cart-id" value="{{$model->id}}">
                 <input type="number" data-url="{{route('shopping-cart-qty')}}" class="form-control" id="cart-qty"
                     value="{{$model->quantity}}">
             </fieldset>
         </form>
     </div>
     <div class="col-xs-12 col-sm-2">
         <strong class="price"><i class="fa fa-eur"></i> {{Cart::getTotal()}}</strong>
         <a href="#"><i class="fa fa-close"></i></a>
     </div>
 </div>
 @endforeach
