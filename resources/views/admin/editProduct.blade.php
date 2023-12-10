@extends('admin.layouts.template')
@section('page_title')
    Ecommerce-Edit-Product
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Edit Product</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Product</h5>
            <small class="text-muted float-end">Input information</small>
          </div>
          <div class="card-body">
            <form action="{{route('updateProduct')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$productallinfo->id}}" name="product_id" id="product_id">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="product_name"
                  name="product_name" value="{{$productallinfo->product_name}}" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Price</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" id="price" name="price" value="{{$productallinfo->price}}" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Product Quantity</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" value="{{$productallinfo->quantity}}" id="quantity" name="quantity" placeholder="123" />
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Short Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="product_short_description"
                  id="product_short_description" cols="30" rows="10">{{$productallinfo->product_short_description}}</textarea>
                </div>
              </div>

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Long Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="product_long_description"
                  id="product_long_description" cols="30" rows="10">{{$productallinfo->product_long_description}}</textarea>
                </div>
              </div>

               <div class="row justify-content-end pb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
              </div>
            </form>

              </div>

          </div>
        </div>
      </div>
</div>
@endsection

