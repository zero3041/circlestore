@extends('web.layout.layout')

@section('content')
    @include('web.partials.mainSlider')
    <!-- slider -->
    @include('web.partials.mainBrands')
    <!-- brands -->
    @include('web.partials.mainTrending')
    <!-- trending -->
    @include('web.partials.mainFeatures')
    <!-- Features -->
    @include('web.partials.mainBanners')
    <!-- Banner -->
@endsection
