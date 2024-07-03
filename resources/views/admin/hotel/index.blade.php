@extends("layouts.dashboard")
@section("content")
<h1>Hello, {{Auth::user()->name}}</h1>
<div>
  <a href="{{ route('admin.hotel.createAdmin') }}" class="btn btn-primary">Create Hotel</a>
</div>


<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">telephone</th>
        <th scope="col">owner</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($hotels as $hotel)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $hotel->name }}</td>
        <td>{{ $hotel->telephone }}</td>
        <td>{{ $hotel->user->name }}</td>
        <td><a href="{{ route('admin.hotel.showAdmin', $hotel) }}" class="btn btn-primary">Detail</a> || <a href="{{ route('admin.hotel.editAdmin', $hotel) }}" class="btn btn-secondary">Edit</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection

@section("javascript")

@endsection
