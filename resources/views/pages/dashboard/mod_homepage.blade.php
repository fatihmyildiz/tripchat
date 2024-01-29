@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="crm mb-25">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('page_title.dashboard') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>{{ trans('page_title.dashboard') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('page_title.mod_homepage') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @include('components.dashboard.mod_homepage.overview_cards')
            @include('components.dashboard.mod_homepage.sales_report')
            @include('components.dashboard.mod_homepage.sales_growth')
            @include('components.dashboard.mod_homepage.sales_location')
            @include('components.dashboard.mod_homepage.top_sale_products')
            @include('components.dashboard.mod_homepage.browser_state')
            
        </div>
    </div>
</div>
@endsection