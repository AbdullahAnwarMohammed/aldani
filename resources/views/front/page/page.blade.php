@extends('front.layouts.app')
@section('content')
{{-- {{$Page-}} --}}
<div class="container my-4">
    <h3 class="my-2" style="    background: #fbfbfb;
    border: 1px solid #f3f3f3;
    padding: 10px;
    text-align: center;
    width: 50%;
    margin: auto;">{{$Page->name}}</h3>
    {!!$Page->content!!}
</div>
@endsection