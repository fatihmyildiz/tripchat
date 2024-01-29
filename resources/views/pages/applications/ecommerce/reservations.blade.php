@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.ecommerce-orders') }}</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.ecommerce-menu-title') }}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.ecommerce-orders') }}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="userDatatable orderDatatable global-shadow py-30 px-sm-30 px-20 radius-xl w-100 mb-30">
                            <div class="project-top-wrapper d-flex justify-content-between flex-wrap mb-25 mt-n10">
                                <div class="d-flex align-items-center flex-wrap justify-content-center">
                                    <div class="project-search order-search  global-shadow mt-10">
                                       <form action="{{ route('reservation.reservationsearch', ['language' => app()->getLocale()]) }}" method="get" class="order-search__form">
                                        <img src="{{ asset('assets/img/svg/search.svg') }}" alt="search" class="svg">
                                        <input name="search" class="form-control me-sm-2 border-0 box-shadow-none" type="search" placeholder="Ad Soyad veya #Rez.No aratın" aria-label="Search">
                                        <button type="submit" class="btn"><i class="la la-search"></i></button>
                                    </form>

                                    </div><!-- End: .project-search -->
                                    <div class="project-category d-flex align-items-center ms-md-30 mt-xxl-10 mt-15">
                                        <div class="project-tap order-project-tap global-shadow">
                                         <ul class="nav px-1" id="ap-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === null ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale()]) }}">Hepsi</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === '0' ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale(), 'status' => '0']) }}">Giriş Bekleniyor</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === '1' ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale(), 'status' => '1']) }}">Giriş Yaptı</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === '3' ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale(), 'status' => '3']) }}">İşletme İptali</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === '2' ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale(), 'status' => '2']) }}">Müşteri İptali</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link{{ $status === '4' || $status === '5' ? ' active' : '' }}" href="{{ route('reservation.reservations', ['language' => app()->getLocale(), 'status' => '4']) }}">Tamamlandı</a>
                                        </li>
                                    </ul>
                                        </div>
                                    </div><!-- End: .project-category -->
                                </div><!-- End: .d-flex -->
                                <div class="content-center mt-10">
                                    <div class="button-group m-0 mt-xl-0 mt-sm-10 order-button-group">
                                        
                                    </div>
                                </div><!-- End: .content-center -->
                            </div><!-- End: .project-top-wrapper -->
                                <div class="tab-content" id="ap-tabContent">
                                    <div class="tab-pane fade show active" id="ap-overview" role="tabpanel" aria-labelledby="ap-overview-tab">
                                        <!-- Start Table Responsive -->
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-hover table-borderless border-0">
                                                <thead>
                                                    <tr class="userDatatable-header">
                                                        <th>
                                                            <div class="d-flex align-items-center">

                                                                <div class="bd-example-indeterminate">
                                                                    <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                        
                                                                        <label for="check-23e">
                                                                            <span class="checkbox-text ms-3">
                                                                                Rez. id

                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Müşteri</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Durum</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Fiyat</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Oda</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Kişi</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title float-end">Check-in</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title float-end">Check-out</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title float-end">İşlem Yap</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                   @foreach($Reservations as $reservation)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="me-3 d-flex align-items-center">
                                                                        <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                    </div>
                                                                    <div class="orderDatatable-title">
                                                                        <p class="d-block mb-0">
                                                                            #{{ $reservation->reservation_no }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $reservation->customer->name }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                            <div class="orderDatatable-status d-inline-block">
                                                                @if($reservation->status == '0')
                                                                   <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                                @elseif($reservation->status == '1')
                                                                 <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                    @elseif($reservation->status == '2')
                                                                    <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                    @elseif($reservation->status == '3')
                                                                    <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                                @else
                                                                    <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                                @endif
                                                            </div>
                                                        </td>

     
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ number_format($reservation->subtotal, 2) }} ₺
                                                                </div>
                                                            </td>
                                                            <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                            <td>
                                                                <div class="orderDatatable-title">
                                                                    {{ $reservation->room->room_name }}
                                                                </div>
                                                            </td>
                                                             <td>
                                                                <div class="orderDatatable-title">
                                                                    (<i class="la la-male"> {{ $reservation->adult }}</i>)(<i class="la la-child"> {{ $reservation->children }}</i>)
                                                                </div>
                                                            </td>  
                                                            <td>
                                                                <div class="orderDatatable-title float-end">
                                                                    {{ \Carbon\Carbon::parse($reservation->checkin_date)->format('d/m/Y') }}
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="orderDatatable-title float-end">
                                                                    {{ \Carbon\Carbon::parse($reservation->checkout_date)->format('d/m/Y') }}
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                    <li>
                                                                        <a href="" class="edit">
                                                                            <i class="uil uil-comment-dots"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                            <i class="la la-file-invoice"></i>
                                                                        </a>
                                                                    </li>

                                                                    
                                                                <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                    <div class="modal-dialog modal-sm modal-info" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <div class="modal-info-body d-flex">
                                                                                    <div class="modal-info-icon warning">
                                                                                        <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                    </div>

                                                                                    <div class="modal-info-text">
                                                                                        <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <form id="statusForm-{{ $reservation->id }}" method="get" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
                                                                        @csrf
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
                                                                                <i class="uil uil-times"></i> Rezervasyonu İptal Et
                                                                            </button>
                                                                            <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
                                                                                <i class="uil uil-check-circle"></i> Giriş Yap
                                                                            </button>
                                                                            <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
                                                                        </div>
                                                                    </form>

                                                                    <script>
                                                                        function updateStatus(reservationId, newStatus) {
                                                                            document.getElementById('statusInput-' + reservationId).value = newStatus;
                                                                            document.getElementById('statusForm-' + reservationId).submit();
                                                                        }
                                                                    </script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                          <li>
                                                            @if($reservation->status == 0)
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-edit"></i>
                                                                </a>
                                                            @elseif($reservation->status == 1)
                                                                <a>
                                                                    <i class="uil uil uil-check-circle"></i> 
                                                                </a>
                                                            @elseif($reservation->status == 2 || $reservation->status == 3)
                                                                <a>
                                                                    <i class="uil uil uil-minus"></i> 
                                                                </a>
                                                            @else
                                                                <a>
                                                                    <i class="uil uil-check"></i> 
                                                                </a>
                                                            @endif
                                                        </li>


                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach



                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>
                                <div class="tab-pane fade" id="bekleniyor" role="tabpanel" aria-labelledby="timeline-tab">
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                                    <th>
                                                        <div class="d-flex align-items-center">

                                                            <div class="bd-example-indeterminate">
                                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                    <label for="check-23u">
                                                                        <span class="checkbox-text ms-3">
                                                                             Rez. id

                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </th>
                                                   <th>
                                                        <span class="userDatatable-title">Müşteri</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Durum</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Fiyat</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Oda</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Kişi</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-in</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-out</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">İşlem Yap</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               @foreach($Reservations as $reservation)
                                               @if($reservation->status == 0)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3 d-flex align-items-center">
                                                                    <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                </div>
                                                                <div class="orderDatatable-title">
                                                                    <p class="d-block mb-0">
                                                                        #{{ $reservation->reservation_no }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->customer->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="orderDatatable-status d-inline-block">
                                                            @if($reservation->status == '0')
                                                               <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                            @elseif($reservation->status == '1')
                                                             <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                @elseif($reservation->status == '2')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                @elseif($reservation->status == '3')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                            @else
                                                                <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                            @endif
                                                        </div>
                                                    </td>

 
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ number_format($reservation->subtotal, 2) }} ₺
                                                            </div>
                                                        </td>
                                                        <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->room->room_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->adult }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkin_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkout_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                <li>
                                                                    <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                        <i class="uil uil-eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="edit">
                                                                        <i class="uil uil-edit"></i>
                                                                    </a>
                                                                </li>
                                                            <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-info" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="modal-info-body d-flex">
                                                                                <div class="modal-info-icon warning">
                                                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                </div>

                                                                                <div class="modal-info-text">
                                                                                    <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <form id="statusForm-{{ $reservation->id }}" method="POST" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
    @csrf
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
            <i class="uil uil-times"></i> Rezervasyonu İptal Et
        </button>
        <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
            <i class="uil uil-check-circle"></i> Giriş Yap
        </button>
        <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
    </div>
</form>

<script>
    function updateStatus(reservationId, newStatus) {
        document.getElementById('statusInput-' + reservationId).value = newStatus;
        document.getElementById('statusForm-' + reservationId).submit();
    }
</script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <li>
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>
                                                            </li>                                        

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>
                                <div class="tab-pane fade" id="girisyapti" role="tabpanel" aria-labelledby="activity-tab">
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                                    <th>
                                                        <div class="d-flex align-items-center">

                                                            <div class="bd-example-indeterminate">
                                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                    <label for="check-23">
                                                                        <span class="checkbox-text ms-3">
                                                                            order id

                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Customers</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Status</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Amount</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Date</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Actions</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               @foreach($Reservations as $reservation)
                                                @if($reservation->status == 1)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3 d-flex align-items-center">
                                                                    <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                </div>
                                                                <div class="orderDatatable-title">
                                                                    <p class="d-block mb-0">
                                                                        #{{ $reservation->reservation_no }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->customer->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="orderDatatable-status d-inline-block">
                                                            @if($reservation->status == '0')
                                                               <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                            @elseif($reservation->status == '1')
                                                             <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                @elseif($reservation->status == '2')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                @elseif($reservation->status == '3')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                            @else
                                                                <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                            @endif
                                                        </div>
                                                    </td>

 
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ number_format($reservation->subtotal, 2) }} ₺
                                                            </div>
                                                        </td>
                                                        <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->room->room_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->adult }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkin_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkout_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                <li>
                                                                    <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                        <i class="uil uil-eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="edit">
                                                                        <i class="uil uil-edit"></i>
                                                                    </a>
                                                                </li>
                                                            <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-info" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="modal-info-body d-flex">
                                                                                <div class="modal-info-icon warning">
                                                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                </div>

                                                                                <div class="modal-info-text">
                                                                                    <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                       <form id="statusForm-{{ $reservation->id }}" method="POST" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
    @csrf
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
            <i class="uil uil-times"></i> Rezervasyonu İptal Et
        </button>
        <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
            <i class="uil uil-check-circle"></i> Giriş Yap
        </button>
        <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
    </div>
</form>

<script>
    function updateStatus(reservationId, newStatus) {
        document.getElementById('statusInput-' + reservationId).value = newStatus;
        document.getElementById('statusForm-' + reservationId).submit();
    }
</script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <li>
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>
                                                            </li>

                                                                                                                

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach



                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>
                                <div class="tab-pane fade" id="isletmeiptal" role="tabpanel" aria-labelledby="draft-tab">
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                                    <th>
                                                        <div class="d-flex align-items-center">

                                                            <div class="bd-example-indeterminate">
                                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                    <label for="check-23c">
                                                                  <span class="checkbox-text ms-3">
                                                                            Rez. id

                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Müşteri</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Durum</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Fiyat</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Oda</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Kişi</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-in</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-out</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">İşlem Yap</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               @foreach($Reservations as $reservation)
                                                @if($reservation->status == 3)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3 d-flex align-items-center">
                                                                    <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                </div>
                                                                <div class="orderDatatable-title">
                                                                    <p class="d-block mb-0">
                                                                        #{{ $reservation->reservation_no }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->customer->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="orderDatatable-status d-inline-block">
                                                            @if($reservation->status == '0')
                                                               <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                            @elseif($reservation->status == '1')
                                                             <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                @elseif($reservation->status == '2')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                @elseif($reservation->status == '3')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                            @else
                                                                <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                            @endif
                                                        </div>
                                                    </td>

 
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ number_format($reservation->subtotal, 2) }} ₺
                                                            </div>
                                                        </td>
                                                        <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->room->room_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->adult }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkin_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkout_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                <li>
                                                                    <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                        <i class="uil uil-eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="edit">
                                                                        <i class="uil uil-edit"></i>
                                                                    </a>
                                                                </li>
                                                            <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-info" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="modal-info-body d-flex">
                                                                                <div class="modal-info-icon warning">
                                                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                </div>

                                                                                <div class="modal-info-text">
                                                                                    <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <form id="statusForm-{{ $reservation->id }}" method="POST" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
    @csrf
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
            <i class="uil uil-times"></i> Rezervasyonu İptal Et
        </button>
        <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
            <i class="uil uil-check-circle"></i> Giriş Yap
        </button>
        <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
    </div>
</form>

<script>
    function updateStatus(reservationId, newStatus) {
        document.getElementById('statusInput-' + reservationId).value = newStatus;
        document.getElementById('statusForm-' + reservationId).submit();
    }
</script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <li>
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>
                                                            </li>

                                                                                                                

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach



                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>

                                 <div class="tab-pane fade" id="musteriiptal" role="tabpanel" aria-labelledby="draft-tab">
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                                    <th>
                                                        <div class="d-flex align-items-center">

                                                            <div class="bd-example-indeterminate">
                                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                    <label for="check-23c">
                                                                  <span class="checkbox-text ms-3">
                                                                            Rez. id

                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Müşteri</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Durum</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Fiyat</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Oda</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Kişi</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-in</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-out</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">İşlem Yap</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               @foreach($Reservations as $reservation)
                                                @if($reservation->status == 2)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3 d-flex align-items-center">
                                                                    <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                </div>
                                                                <div class="orderDatatable-title">
                                                                    <p class="d-block mb-0">
                                                                        #{{ $reservation->reservation_no }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->customer->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="orderDatatable-status d-inline-block">
                                                            @if($reservation->status == '0')
                                                               <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                            @elseif($reservation->status == '1')
                                                             <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                @elseif($reservation->status == '2')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                @elseif($reservation->status == '3')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                            @else
                                                                <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                            @endif
                                                        </div>
                                                    </td>

 
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ number_format($reservation->subtotal, 2) }} ₺
                                                            </div>
                                                        </td>
                                                        <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->room->room_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->adult }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkin_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkout_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                <li>
                                                                    <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                        <i class="uil uil-eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="edit">
                                                                        <i class="uil uil-edit"></i>
                                                                    </a>
                                                                </li>
                                                            <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-info" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="modal-info-body d-flex">
                                                                                <div class="modal-info-icon warning">
                                                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                </div>

                                                                                <div class="modal-info-text">
                                                                                    <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <form id="statusForm-{{ $reservation->id }}" method="POST" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
    @csrf
    <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
            <i class="uil uil-times"></i> Rezervasyonu İptal Et
        </button>
        <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
            <i class="uil uil-check-circle"></i> Giriş Yap
        </button>
        <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
    </div>
</form>

<script>
    function updateStatus(reservationId, newStatus) {
        document.getElementById('statusInput-' + reservationId).value = newStatus;
        document.getElementById('statusForm-' + reservationId).submit();
    }
</script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <li>
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>
                                                            </li>


                                                                                                                

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach



                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>
                                 <div class="tab-pane fade" id="tamamlandi" role="tabpanel" aria-labelledby="draft-tab">
                                    <!-- Start Table Responsive -->
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-borderless border-0">
                                            <thead>
                                                <tr class="userDatatable-header">
                                                    <th>
                                                        <div class="d-flex align-items-center">

                                                            <div class="bd-example-indeterminate">
                                                                <div class="checkbox-theme-default custom-checkbox  check-all">
                                                                    <label for="check-23c">
                                                                  <span class="checkbox-text ms-3">
                                                                            Rez. id

                                                                        </span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Müşteri</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Durum</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Fiyat</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Oda</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title">Kişi</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-in</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">Check-out</span>
                                                    </th>
                                                    <th>
                                                        <span class="userDatatable-title float-end">İşlem Yap</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               @foreach($Reservations as $reservation)
                                                @if(!in_array($reservation->status, [0, 1, 2, 3]))
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="me-3 d-flex align-items-center">
                                                                    <!-- Buraya gerekirse başka içerikler ekleyebilirsiniz -->
                                                                </div>
                                                                <div class="orderDatatable-title">
                                                                    <p class="d-block mb-0">
                                                                        #{{ $reservation->reservation_no }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->customer->name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                        <div class="orderDatatable-status d-inline-block">
                                                            @if($reservation->status == '0')
                                                               <span class="order-bg-opacity-warning text-warning rounded-pill active">Giriş Bekleniyor</span>
                                                            @elseif($reservation->status == '1')
                                                             <span class="order-bg-opacity-primary text-success rounded-pill active">Giriş Yaptı</span>                                                               
                                                                @elseif($reservation->status == '2')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Etti</span>
                                                                @elseif($reservation->status == '3')
                                                                <span class="order-bg-opacity-danger text-danger rounded-pill active">İptal Edildi</span>
                                                            @else
                                                                <span class="order-bg-opacity-success text-success rounded-pill active">Tamamlandı</span>
                                                            @endif
                                                        </div>
                                                    </td>

 
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ number_format($reservation->subtotal, 2) }} ₺
                                                            </div>
                                                        </td>
                                                        <!-- Diğer sütunlar için benzer şekilde devam edebilirsiniz -->
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->room->room_name }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title">
                                                                {{ $reservation->adult }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkin_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->checkout_date }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <ul class="orderDatatable_actions mb-0 d-flex flex-wrap float-end">
                                                                <li>
                                                                    <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                        <i class="uil uil-eye"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="" class="edit">
                                                                        <i class="uil uil-edit"></i>
                                                                    </a>
                                                                </li>
                                                            <div class="modal-info-delete modal fade show" id="modal-info-delete-{{ $reservation->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm modal-info" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <div class="modal-info-body d-flex">
                                                                                <div class="modal-info-icon warning">
                                                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                                                </div>

                                                                                <div class="modal-info-text">
                                                                                    <h6>İptal etmek istediğinizden emin misiniz?</h6>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                       <form id="statusForm-{{ $reservation->id }}" method="POST" action="{{ route('reservation.updateStatus', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}">
                                                                    @csrf
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal" onclick="updateStatus({{ $reservation->id }}, 3)">
                                                                            <i class="uil uil-times"></i> Rezervasyonu İptal Et
                                                                        </button>
                                                                        <button type="button" class="btn btn-success btn-outlined btn-sm" onclick="updateStatus({{ $reservation->id }}, 1)">
                                                                            <i class="uil uil-check-circle"></i> Giriş Yap
                                                                        </button>
                                                                        <input type="hidden" name="status" id="statusInput-{{ $reservation->id }}" value="">
                                                                    </div>
                                                                </form>

                                                                <script>
                                                                    function updateStatus(reservationId, newStatus) {
                                                                        document.getElementById('statusInput-' + reservationId).value = newStatus;
                                                                        document.getElementById('statusForm-' + reservationId).submit();
                                                                    }
                                                                </script>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <li>
                                                                <a href="#" class="remove" data-bs-toggle="modal" data-bs-target="#modal-info-delete-{{ $reservation->id }}">
                                                                    <i class="uil uil-trash-alt"></i>
                                                                </a>
                                                            </li>


                                                                                                                

                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach



                                              

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Table Responsive End -->
                                </div>
                            </div>


                                <div class="d-flex justify-content-md-end justify-content-center mt-15 pt-25 border-top">
                                    <nav>
                                        <ul class="pagination">

                                            {{-- Previous Page Link --}}
                                            @if ($Reservations->onFirstPage())
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&laquo;</span>
                                                </li>
                                            @else
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $Reservations->previousPageUrl() }}" rel="prev" aria-label="Previous">&laquo;</a>
                                                </li>
                                            @endif

                                            {{-- Page Links --}}
                                            @for ($i = 1; $i <= $Reservations->lastPage(); $i++)
                                                <li class="page-item {{ $Reservations->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $Reservations->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor 

                                            {{-- Next Page Link --}}
                                            @if ($Reservations->hasMorePages())
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $Reservations->nextPageUrl() }}" rel="next" aria-label="Next">&raquo;</a>
                                                </li>
                                            @else
                                                <li class="page-item disabled">
                                                    <span class="page-link" aria-hidden="true">&raquo;</span>
                                                </li>
                                            @endif

                                        </ul>
                                    </nav>
                                </div>

                                <script>
                                    // JavaScript ile status parametresini pagination linklerine eklemek
                                    document.querySelectorAll('.pagination a').forEach(function(link) {
                                        link.href = link.href + "&status={{ $status }}";
                                    });
                                </script>



                        </div><!-- End: .userDatatable -->
                    </div><!-- End: .col -->
                </div>
            </div>
@endsection