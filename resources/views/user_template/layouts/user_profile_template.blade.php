@extends('user_template.layouts.homeTemplate')
@section('main-part')
  <h2 class="text-center">Welcome : {{Auth::user()->name}}</h2>
  <div class="container">
    <div class="row">
        <div class="col-lg-4">
            <div class="box_main">
                <ul>
                    <li><a href="{{route('userprofile')}}">Dashboard</a></li>
                    <li><a href="{{route('pendingOrder')}}">Pending Order</a></li>
                    <li><a href="{{route('history')}}">History</a></li>
                    <li><a href="">Log out</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-8">
           <div class="box_main">
             @yield('profile_content')
           </div>
        </div>
    </div>
  </div>
@endsection

