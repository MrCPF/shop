@extends('layouts.art')
@section('content')

<h3>{{$data->title}}</h3>

<p><?php echo html_entity_decode($data->content); ?></p>

@endsection