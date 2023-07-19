@extends('layout.master')

@section('title', 'Dashboard')

@section('customStyle')

@endsection

@section('content')

    @include("components.dashboard.count-tiles")
    @include("components.dashboard.sales-analytics")

@endsection

@section('customJs')
    <script src="{{URL::asset('custom/js/component/dashboard.js?v=6')}}"></script>
@endsection
