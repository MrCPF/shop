@extends('layouts.art')
@section('content')

<h3>{{session('title')}}</h3>

<p>{{ session()->get('content') }}</p>

@endsection