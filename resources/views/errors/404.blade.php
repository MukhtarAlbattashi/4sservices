@extends('layouts.app')

@section('title', '403 Unauthorized Action')

@section('content')
    <div class="container d-flex align-items-center justify-content-center full-page">
        <div class="text-center fs-1">
            <span class="fas fa-question-circle text-center"></span>
            <h3>Not Found</h3>
            <a href="{{route('home')}}" class="btn btn-warning text-dark">
                {{__('public.dashboard')}}
            </a>
        </div>
    </div>
@endsection
