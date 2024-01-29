@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="demo3 mb-25 t-thead-bg">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('page_title.dashboard') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="uil uil-estate"></i>{{ trans('page_title.dashboard') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('admin_homepage') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            @if(auth()->user() && is_null(auth()->user()->hotel_id))
           @if(auth()->user())
                @php
                    $pendingInvite = \App\Models\Invite::where('user_id', auth()->user()->id)
                        ->where('accepted', false)
                        ->first();
                @endphp

                @if($pendingInvite)
                    @include('components.dashboard.admin_homepage.invitation')
                @endif
            @endif
            @endif

            @if(auth()->user() && auth()->user()->hotel_id)
            @include('components.dashboard.admin_homepage.recent_deals')
            @include('components.dashboard.admin_homepage.last_reservations')
            @include('components.dashboard.demo_two.overview_cards')
            
            @endif
                  
        </div>
    </div>
</div>
@endsection