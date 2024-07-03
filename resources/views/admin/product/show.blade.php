@extends('layouts.dashboard')
@section("content")

<div class="container">
  <h1>{{ $product->name }}</h1>



  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Center Card</title>
  </head>

  <body>
    <div class="container-fluid py-4">
      <div class="row justify-content-center">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <img src="{{asset("$product->image")}}" class="card-img-top" alt="">
            <div class="card-header p-3 pt-2">
              <div class="text-end pt-1">
                <p><b>Price: {{$product->price}}</b></p>
                <p><b>Capacity: {{$product->capacity}}</b></p>
                <p><b>Available Room: {{$product->available_room}}</b></p>
                <p><b>Hotel: {{$product->hotel->name}}</b></p>
                <p><b>Type: {{$product->typeproduct->name}}</b></p>
                <p><b>Owner: {{$hotel->user->name}}</b></p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            <a href="{{ route('admin.facility.index', $hotel) }}" class="btn btn-primary">Facilities</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  </html>

  @endsection

  @section("javascript")
  @endsection