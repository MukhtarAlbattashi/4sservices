@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12 text-center">
            <img class="logo" src="{{asset('images/logo.png')}}" alt="logo">
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-dark text-white text-center fs-3">
                        {{ __('public.dashboard') }}
                    </div>
                    <div class="card-body fs-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input placeholder="{{ __('public.email')}}" id="email" type="email" class="text-center form-control fs-6 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback fs-6" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <input placeholder="{{ __('public.password')}}" id="password" type="password" class="text-center form-control fs-6 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-warning fs-6">
                                        {{ __('public.login') }}
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            @if(app()->getLocale()=='en')
                            <a href="{{ url('/language/ar')}}" class="badge bg-info m-2 fs-6 text-decoration-none text-white">
                                {{ __('public.arabic') }}
                            </a>
                            @else
                            <a href="{{ url('/language/en')}}" class="badge bg-info m-2 fs-6 text-decoration-none text-white">
                                {{ __('public.english') }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
