@extends('layouts.main')
@section('content')
    <h1>Welcome to Dashboard, {{ Auth::user()->fname }}
    </h1>
@endsection