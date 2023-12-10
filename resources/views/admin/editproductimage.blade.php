@extends('admin.layouts.template')
@section('page_title')
    Ecommerce-Edit-Product-image
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Edit Product Image</h4>
    <div class="col-xxl">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="mb-0">Edit Product Image</h5>
            <small class="text-muted float-end">Input information</small>
          </div>
          <div class="card-body">
            <form action="{{route('updateProductImg')}}" method="POST" enctype="multipart/form-data">
                @csrf

              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Previous Image</label>
                <div class="col-sm-10">
                    <img src="{{asset($productInfo->product_img)}}" alt="productImage">
                </div>
              </div>
                <input type="hidden" value="{{$productInfo->id}}" name="product_id" id="product_id">
              <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Upload Product Image</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="product_img" name="product_img" />
                </div>
              </div>

               <div class="row justify-content-end pb-3">
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Update image</button>
                </div>
              </div>
            </form>

              </div>

          </div>
        </div>
      </div>
</div>
@endsection

