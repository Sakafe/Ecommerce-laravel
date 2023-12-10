@extends('user_template.layouts.homeTemplate')
@section('main-part')
  {{-- <h2> - ({{$category->product_count}})</h2> --}}

  <div class="fashion_section">
    <div id="main_slider" class="carousel slide" data-ride="carousel">

             <div class="container">
                <h1 class="fashion_taital mt-3">{{$category->category_name}} - ({{$category->product_count}})</h1>
                <div class="fashion_section_2">
                   <div class="row">
                    @if ($category->product_count < 1)
                    <h2 style="margin: auto; color:red">No products found</h2>
                    @else
                        @foreach ($products as $product)
                        <div class="col-lg-4 col-sm-4">
                        <div class="box_main">
                            <h4 class="shirt_text">{{$product->product_name}}</h4>
                            <p class="price_text">{{$product->price}}<span style="color: #262626;">$ 30</span></p>
                            <div class="tshirt_img"><img src="{{asset($product->product_img)}}"></div>
                            <div class="btn_main">
                                <form action="{{route('addproductTocart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <input type="hidden" value="{{$product->price}}" name="price">
                                    <input type="hidden" value="1" name="quantity">
                                  <input class="btn btn-warning" type="submit" value="Buy Now">
                                </form>
                                <div class="seemore_bt"><a
                                    href="{{route('singleproduct',[$product->id,$product->slug])}}">See More</a></div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                    @endif


                   </div>
                </div>
             </div>
    </div>
 </div>
@endsection
