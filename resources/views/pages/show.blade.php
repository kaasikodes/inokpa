@extends('layouts.app')
@section('title')
  {{$page->title}}

    
@endsection

@section('content')
@include('inc.messages')
  <!-- Extra Navigation--> 
  <div class="container mb-5">
    
    <a href="{{url()->previous()}}" class="float-right">Go back</a>
    
  </div>

  <!-- Main Section -->
  <div class="container py-4 text-center">
    
    <h1 style="text-transform: capitalize;">{{$page->title}}</h1>

    <div class="container-fluid my-4">
      {!!$page->content!!}
    </div>
    
  </div>
    
@endsection
    
