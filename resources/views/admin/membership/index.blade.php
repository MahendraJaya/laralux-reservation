@extends('layouts.dashboard')

@section('content')

<div>
    <a href="{{ route('admin.membership.create') }}" class="btn btn-primary">Add new member</a>
  </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">point</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($memberships as $membership)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $membership->user->name }}</td>
                    <td>{{ $membership->point }}</td>
                    <td><a href="{{ route('admin.membership.edit', $membership) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.membership.destroy', $membership) }}" method="post">
                            @method('DELETE') @csrf <button type="submit" class="btn btn-danger">Delete</button></form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('javascript')
@endsection
