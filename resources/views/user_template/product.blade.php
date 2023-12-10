@extends('user_template.layouts.homeTemplate')
@section('main-part')
  <div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main">
                <div class="electronic_img"><img src="{{asset($product->product_img)}}"></div>
            </div>
        </div>
        <div class="col-lg-8 mt-5">
           <div class="box_main">
            <div class="product_info">
                <h4 class="shirt_text text-left">{{$product->product_name}}</h4>
                <p class="price_text text-left">Start Price  <span style="color: #262626;">{{$product->price}}</span></p>
               </div>
               <div class="my-3 product_details">
                <p class="lead">{{$product->product_long_description}}</p>
                <ul class="p-2 bg-light my-2">
                    <li>Categoriy - {{$product->product_category_name}}</li>
                    <li>SubCategoriy - {{$product->product_subcategory_name}}</li>
                    <li>Available Quantity - {{$product->quantity}}</li>
                </ul>
               </div>
               <div class="btn_main">
                <form action="{{route('addproductTocart')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$product->id}}" name="product_id">
                    <input type="hidden" value="{{$product->price}}" name="price">
                    <input type="hidden" value="1" name="quantity">
                    <div class="from-group">
                        <input type="hidden" value="{{$product->price}}" name="price">
                    <label for="quantity">How many pics?</label>
                    <input type="number" min="1" name="quantity" placeholder="1"><br/>
                    </div>
                  <input class="btn btn-warning" type="submit" value="Add to cart">
                </form>
                {{-- <div class="btn btn-warning"><a href="#">Add to cart</a></div> --}}
             </div>
           </div>
        </div>
    </div>

    <div class="fashion_section">
        <div id="main_slider" class="carousel slide" data-ride="carousel">
           {{-- <div class="carousel-inner"> --}}
              {{-- <div class="carousel-item active"> --}}
                 <div class="container">
                    <h1 class="fashion_taital">Related Products</h1>
                    <div class="fashion_section_2">
                       <div class="row">
                        @foreach ( $relatedProducts as $relatedProduct)
                            <div class="col-lg-4 col-sm-4">
                             <div class="box_main">
                                <h4 class="shirt_text">{{$relatedProduct->product_name}}</h4>
                                <p class="price_text">product-price : <span style="color: #262626;">{{$relatedProduct->price}}</span></p>
                                <div class="tshirt_img"><img src="{{asset($relatedProduct->product_img)}}"></div>
                                <div class="btn_main">
                                    <form action="{{route('addproductTocart')}}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{$product->id}}" name="product_id">
                                      <input class="btn btn-warning" type="submit" value="Buy Now">
                                    </form>
                                      <div class="seemore_bt">
                                         <a href="{{route('singleproduct',[$relatedProduct->id,$relatedProduct->slug])}}">See More</a>
                                       </div>
                                </div>
                             </div>
                          </div>
                          @endforeach
                    </div>
                </div>
             </div>
            </div>
        </div>


  </div>
@endsection
