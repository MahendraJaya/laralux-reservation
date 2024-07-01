@extends('layouts.dashboard')
@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.typeproduct.store') }}" method="post">
            @csrf
            <div class="input-group input-group-outline my-3">
                <label class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('javascript')
@endsection
