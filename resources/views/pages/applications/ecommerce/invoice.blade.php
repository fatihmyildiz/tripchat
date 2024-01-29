@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-breadcrumb">

                            <div class="breadcrumb-main">
                                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.ecommerce-invoices') }}</h4>
                                <div class="breadcrumb-action justify-content-center flex-wrap">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.ecommerce-menu-title') }}</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.ecommerce-invoices') }}</li>
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
                        <div class="payment-invoice global-shadow radius-xl w-100 mb-30">
                            <div class="payment-invoice__body">
                                <div class="payment-invoice-address d-flex justify-content-sm-between">
                                    <div class="payment-invoice-logo">
                                    <a href="{{ route('reservation.reservations',app()->getLocale()) }}">
                                        <img class="svg dark" src="{{ asset('assets/img/logochat.png') }}" alt="">
                                        <img class="svg light" src="{{ asset('assets/img/logowhitechat.png') }}" alt="">
                                        @if($reservationDetails->status == 2 || $reservationDetails->status == 3)                                        
                                        <p style="color: red;">İptal Edilen Rezervasyon</p>
                                    @endif
                                    </a>                                   
                                </div>
                                    

                                    <div class="payment-invoice-address__area">
                                        <address><b>{{ $reservationDetails->hotel->hotel_name }}</b><br> {{ $reservationDetails->hotel->hotel_town }} / {{ $reservationDetails->hotel->hotel_city }}<br> {{ $reservationDetails->hotel->hotel_address }}<br>
                                            ////////////</address>
                                    </div>
                                </div><!-- End: .payment-invoice-address -->
                                <div class="payment-invoice-qr d-flex justify-content-between mb-40 px-xl-50 px-30 py-sm-30 py-20 ">
                                    <div class="d-flex justify-content-center mb-lg-0 mb-25">
                                        <div class="payment-invoice-qr__number">
                                            <div class="display-3">
                                                Information
                                            </div>
                                            @if ($reservationDetails)
                                            <p>No : <span>#{{ $reservationDetails->reservation_no }}</span></p>
                                            <p>Date : <span>{{ $reservationDetails->created_at->format('M d, Y') }}</span></p>
                                            @endif
                                        </div>
                                    </div><!-- End: .d-flex 
                                    <div class="d-flex justify-content-center mb-lg-0 mb-25">
                                        <div class="payment-invoice-qr__code bg-white radius-xl p-20">
                                            <img src="{{ asset('assets/img/qr.png') }}" alt="qr">
                                            <p>8364297359912267</p>
                                        </div>
                                    </div>End: .d-flex -->
                                    <div class="d-flex justify-content-center">
                                        <div class="payment-invoice-qr__address">
                                            <p>Invoice To:</p>
                                            <span>{{ $reservationDetails->customer->name }}</span><br>
                                            <span>{{ $reservationDetails->customer->address }}</span><br>
                                            <span>{{ $reservationDetails->customer->state }} , {{ $reservationDetails->customer->country }}</span><br>
                                            <span>{{ $reservationDetails->customer->id_number ?? '11111111111' }}</span>

                                        </div>
                                    </div><!-- End: .d-flex -->
                                </div><!-- End: .payment-invoice-qr -->
                                <div class="payment-invoice-table">
                                    <div class="table-responsive">
                                        <table id="cart" class="table table-borderless">
                                            <thead>
                                                <tr class="product-cart__header">
                                                    <th scope="col" >Oda</th>
                                                    <th scope="col" class="text-end">Check-in / Check-out</th>
                                                    <th scope="col" class="text-end">Kişi Sayısı</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    
                                                    <td class="Product-cart-title">
                                                        <div class="media  align-items-center">
                                                            <div class="media-body">
                                                                <h5 class="mt-0">{{ $reservationDetails->room->room_name }}</h5>
                                                                <div class="d-flex">
                                                                    <p>
                                                                        
                                                                        <span>
                                                                            @if ($reservationDetails->including == 1)
                                                                                Kahvaltı Dahil
                                                                            @elseif ($reservationDetails->including == 2)
                                                                                Herşey Dahil
                                                                            @elseif ($reservationDetails->including == 3)
                                                                                Ultra Herşey Dahil
                                                                            @elseif ($reservationDetails->including == 4)
                                                                                Yarım Pansiyon
                                                                            @else
                                                                                <!-- 
                                                                                 -->
                                                                            @endif
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="unit text-end">{{ \Carbon\Carbon::parse($reservationDetails->checkin_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($reservationDetails->checkout_date)->format('d/m/Y') }}</td>
                                                    <td class="unit text-end">
                                                    @if ($reservationDetails->adult > 0)
                                                        {{ $reservationDetails->adult }} Yetişkin
                                                    @endif

                                                    @if ($reservationDetails->adult > 0 && $reservationDetails->children > 0)
                                                        - 
                                                    @endif

                                                    @if ($reservationDetails->children > 0)
                                                        {{ $reservationDetails->children }} Çocuk
                                                    @endif
                                                </td>                                                    
                                                </tr>
                                                
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="1"></td>
                                                    <td class="order-summery float-right border-0   ">
                                                        <div class="total">
                                                            <div class="subtotalTotal mb-0 text-end">
                                                                Toplam Gün :
                                                            </div>
                                                            <div class="taxes mb-0 text-end">
                                                                Ortalama Gün Fiyatı :
                                                            </div>
                                                            <div class="shipping mb-0 text-end">
                                                                 İndirim :
                                                            </div>
                                                        </div>
                                                        <div class="total-money mt-2 text-end">
                                                            <h6>Total :</h6>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="total-order float-right text-end fs-14 fw-500">
                                                            <p>{{ \Carbon\Carbon::parse($reservationDetails->checkout_date)->diffInDays(\Carbon\Carbon::parse($reservationDetails->checkin_date)) }} gün</p>

                                                            <p>{{ number_format($reservationDetails->subtotal / (\Carbon\Carbon::parse($reservationDetails->checkout_date)->diffInDays(\Carbon\Carbon::parse($reservationDetails->checkin_date))), 2) }} ₺/gün</p>
                                                            <p>0</p>
                                                            
                                                            <h5 class="text-primary">{{ $reservationDetails->subtotal }} ₺</h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <div class="payment-invoice__btn mt-xxl-50 pt-xxl-30">
                                        <button type="button" class="btn border rounded-pill bg-normal text-gray px-25 print-btn">
                                            <img src="{{ asset('assets/img/svg/printer.svg') }}" alt="printer" class="svg">print</button>
                                        <!--<button type="button" class="btn border rounded-pill bg-normal text-gray px-25">
                                            <img src="{{ asset('assets/img/svg/send.svg') }}" alt="send" class="svg">invoice</button>
                                        <button type="button" class="btn-primary btn rounded-pill px-25 text-white download">
                                            <img src="{{ asset('assets/img/svg/upload.svg') }}" alt="upload" class="svg">download</button>-->
                                    </div>
                                </div><!-- End: .payment-invoice-table -->
                            </div><!-- End: .payment-invoice__body -->
                        </div><!-- End: .payment-invoice -->
                    </div><!-- End: .col -->
                </div>
            </div>
@endsection