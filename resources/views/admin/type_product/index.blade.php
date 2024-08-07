@extends('layouts.dashboard')
@section('content')
    @can('delete-typehotel', Auth::user())
    <div>
        <a href="{{ route('admin.typeproduct.create') }}" class="btn btn-primary">Add new type</a>
    </div>
    @endcan
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
                @foreach ($typeProducts as $typeProduct)
                <tr class="">
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $typeProduct->name }}</td>
                    @can('delete-typehotel', Auth::user())
                    <td><a href="{{ route('admin.typeproduct.edit', ['typeproduct' => $typeProduct]) }}" class="btn btn-primary">Edit</a></td>
                    @endcan
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('javascript')
@endsection
