@extends('frontend.layout.app')

@section('meta')
    <title>My Dashboard - {{ trans('app.meta.short_title') }}</title>
@endsection

@section('styles')

@endsection

@section('content')
    <div role="main" class="main">
        <div class="container">
            <div class="row mt-lg">
                <div class="col-md-12 center">
                    <h1 class="mb-sm">My Dashboard</h1>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="featured-boxes">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Calculate Shipping</h4>


                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xlg">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Calculate Shipping</h4>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xs">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Calculate Shipping</h4>


                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="featured-box featured-box-primary align-left mt-xs">
                                    <div class="box-content">
                                        <h4 class="heading-primary text-uppercase mb-md">Calculate Shipping</h4>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection