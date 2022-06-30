@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
        <h2>Welcome, <span>{{ Auth::user()->name }}</span>!</h2>
    </div>

    @if ($users->count() > 0)
        <div id="userList" class="user-list">
            {{-- Load each `user` in `users` --}}
            @foreach ($users as $user)
                <a class="user-item card shadow-sm" href="{{ route('users.show', ['user' => $user]) }}">
                    <div class="card-body">
                        <p class="card-title fs-5">{{ $user->name }}</p>
                        <span class="card-text">{{ $user->email }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center border p-4 bg-light">
            <p class="text-muted mb-0">There are not any users</p>
        </div>
    @endif
</div>
@endsection
