@extends('layouts.frontend')

@section('title', 'Membership Points')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Membership Points</h2>
                </div>
                <div class="card-body">
                    @if ($membership)
                        <p>You have <strong>{{ $membership->point }}</strong> points.</p>
                    @else
                        <p>You are not a member yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
@endsection
