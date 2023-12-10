@extends('user_template.layouts.homeTemplate')
@section('main-part')
  <h2>Add to cart</h2>

  @if (session()->has('message'))
  <div class="alert alert-success">
    {{ session()->get('message')}}
  </div>
  @endif

@endsection
