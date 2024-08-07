@extends('layouts.dashboard')
@section('content')

<table class="table">
    @can('create-product', Auth::user())
    <a href="{{ route('admin.facility.create', $hotel) }}" class="btn btn-primary">Add Facilities</a>
    @endcan
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
            <th scope="col">product</th>
            @can('delete-product', Auth::user())
            <th scope="col">Action</th>
            @endcan
        </tr>
    </thead>
    <tbody>
        {{-- @dd($facilities) --}}
        @foreach ($facilities as $facility)
        <tr>
            <th scope="row">{{ $loop->iteration }}</th>

            <td>{{ $facility->name }}</td>
            <td>{{ $facility->product->name }}</td>
            <td>
                <form action="{{ route('admin.facility.destroy', ['hotel' => $hotel, 'facility' => $facility->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection