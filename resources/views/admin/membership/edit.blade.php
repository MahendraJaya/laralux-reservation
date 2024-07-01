@extends('layouts.dashboard')

@section('content')
    <div>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Back</a>
    </div>

    <div>
        <form action="{{ route('admin.membership.update', $membership) }}" method="POST">
            @method('PUT')
            @csrf
            {{-- @dd($hotel) --}}
            <div class="input-group input-group-outline mb-3">

                <select class="form-select p-2" aria-label="Default select example" name="user" id="user">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user', $membership->user_id) == $user->id)>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="input-group input-group-outline mb-3">
                <label class="form-label">Point</label>
                <input type="number" id="point" name="point" value="{{ old('point', $membership->point) }}"
                    class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

@section('javascript')
@endsection
