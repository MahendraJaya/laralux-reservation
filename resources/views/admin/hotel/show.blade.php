@extends('layouts.dashboard')
@section("content")

<div class="container">
  <h1>{{ $hotel->name }}</h1>



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
            <img src="{{asset("$hotel->image")}}" class="card-img-top" alt="">
            <div class="card-header p-3 pt-2">
              <div class="text-end pt-1">
                <p><b>Name: {{$hotel->name}}</b></p>
                <p><b>Address: {{$hotel->address}}</b></p>
                <p><b>Telephone: {{$hotel->telephone}}</b></p>
                <p><b>Email: {{$hotel->email}}</b></p>
                <p><b>City: {{$hotel->city}}</b></p>
                <p><b>Rating: {{$hotel->rating}}</b></p>
                <p><b>Type: {{$hotel->typehotel->name}}</b></p>
                <p><b>Owner: {{$hotel->user->name}}</b></p>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
            <a href="{{ route('admin.product.indexAdmin', $hotel) }}" class="btn btn-primary">Product</a>
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