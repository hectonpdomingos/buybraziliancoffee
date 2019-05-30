@extends('layouts.app')

@section('content')

<div class="container-flex" style="margin: 30px;">
     
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
        <market-place></market-place>
</div>
@endsection
