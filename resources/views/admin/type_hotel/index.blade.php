@extends('layouts.dashboard')
@section('content')
    <div>
        <a href="{{ route('admin.typehotel.create') }}" class="btn btn-primary">Add new type</a>
    </div>
    <div class="table-responsive">
        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($typeHotels as $typeHotel)
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $typeHotel->name }}</td>
                    <td><a href="{{ route('admin.typehotel.edit', ['typehotel' => $typeHotel]) }}" class="btn btn-primary">Edit</a></td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('javascript')
@endsection
