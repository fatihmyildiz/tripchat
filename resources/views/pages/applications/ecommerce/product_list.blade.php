@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="shop-breadcrumb">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.room-list') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.dashboard-menu-title') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.room-list') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-xxl-50 mb-30">
            <div class="row justify-content-center">
              <div class="col-md-8">


              
 

              </div>
            </div>
          </div>
        
    </div>
</div>

<div class="products_page product_page--grid mb-30">
    <div class="container-fluid">
        <div class="row justify-content-center">
        
        <div class="columns-3 col-lg-12">
           
 <div class="shop_products_top_filter">
            <div class="project-top-wrapper d-flex flex-wrap align-items-center">
                <div class="project-top-left d-flex flex-wrap align-items-center">
              
                </div>
                <div class="project-top-right d-flex flex-wrap align-items-center">
                <div class="project-category flex-wrap d-flex align-items-center">
                     <span class="project-result-showing fs-14 color-gray text-center mt-lg-0 mt-35">
                    <?php
                    $roomCount = count($rooms);
                     if ($roomCount > 0): ?>
                         <span><?php echo min(8, $roomCount); ?></span> odanız listeleniyor.
                    <?php else: ?>
                        Şu anda ekli odanız yok.
                    <?php endif; ?>
                </span>
                </div>
                <div class="project-icon-selected content-center mt-lg-0 mt-25">
                    <div class="listing-social-link pb-lg-0 pb-xs-2">
                        <a href="{{ route('hotel.add_product', app()->getLocale()) }}">
                        <button class="btn btn-default btn-rounded color-secondary btn-outline-secondary">
                            
                                <img src="{{ asset('assets/img/svg/plus.svg') }}" alt="layers" class="svg"> Oda Ekle
                            
                        </button>
                        </a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        

            @foreach($rooms as $room) 

                <div class="col-12 mb-30 px-10">

                <div class="card product product--list">
                <div class="h-100">
                    <div class="product-item">
                        <div class="col-lg-4">
                    <div class="product-item__image">
                                        @if(isset($room->roomPhotos) && $room->roomPhotos->isNotEmpty())
                                        <?php $ilkfoto = $room->roomPhotos->first(); ?>
                                        @if(!empty($ilkfoto))
                                            <img src="{{ asset('assets/img/rooms/' . $ilkfoto->image_path) }}" alt="{{ $room->room_name }}">
                                        @else
                                            Oda fotoğrafı bulunamadı
                                        @endif
                                    @else
                                        Oda fotoğrafı bulunamadı
                                    @endif
                                    </div>
                                    </div>
                                        <div class="col-lg-5">
                                        <span class="like-icon">
                                        <button type="button" class="content-center">
                                        <div class="form-check form-switch form-switch-primary form-switch-sm">
                                            <input type="checkbox" class="form-check-input" id="switch-<?php echo $room->id; ?>" checked onchange="toggleSwitch(<?php echo $room->id; ?>)">
                                            <label class="form-check-label" for="switch-<?php echo $room->id; ?>"></label>
                                        </div>

                                        </button>
                                        </span>
                                        <div class="product-item__title">
                                        <a href="{{ route('roomdetails', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}">
                                            <h6 class="card-title">{{ $room->room_name }}</h6>
                                        </a>
                                     <p class="mb-0">
                                       <p class="mb-0">
                                        <?php
                                        $amenitiesMapping = [
                                            1 => ['text' => 'KLİMA', 'icon' => 'fas fa-snowflake'],
                                            2 => ['text' => 'AKILLI TV', 'icon' => 'fas fa-tv'],
                                            3 => ['text' => 'MİNİ BAR', 'icon' => 'fas fa-glass-whiskey'],
                                            4 => ['text' => 'PARA KASASI', 'icon' => 'fas fa-lock'],
                                            5 => ['text' => 'Wİ-Fİ', 'icon' => 'fas fa-wifi'],
                                            6 => ['text' => 'JAKUZİ', 'icon' => 'fas fa-hot-tub'],
                                            7 => ['text' => 'KÜVET', 'icon' => 'fas fa-bath'],
                                            8 => ['text' => 'ŞÖMİNE', 'icon' => 'fas fa-fire'],
                                            9 => ['text' => 'KAHVE MAKİNASI', 'icon' => 'fas fa-coffee'],
                                            10 => ['text' => 'KETTLE', 'icon' => 'fas fa-mug-hot'],
                                            11 => ['text' => 'DENİZ MANZARASI', 'icon' => 'fas fa-water'],
                                            12 => ['text' => 'ŞEHİR MANZARASI', 'icon' => 'fas fa-city'],
                                        ];

                                        $amenityNumbers = explode(',', $room->room_amenities);

                                        $amenityTexts = array_map(function ($number) use ($amenitiesMapping) {
                                            // Check if the array key exists before accessing it
                                            if (isset($amenitiesMapping[$number])) {
                                                $text = $amenitiesMapping[$number]['text'];
                                                $icon = $amenitiesMapping[$number]['icon'];
                                                return "<i class='$icon'></i> $text";
                                            } else {
                                                return ''; // Return an empty string if the key is not found
                                            }
                                        }, $amenityNumbers);

                                        $count = 0;
                                        $totalAmenities = count($amenityTexts);

                                        if ($totalAmenities > 0) {
                                            foreach ($amenityTexts as $index => $amenityText) {
                                                echo $amenityText;

                                                // Check if the current amenity is not the last one before adding the separator.
                                                if ($index < $totalAmenities - 1) {
                                                    echo "&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;";
                                                }

                                                $count++;

                                                // Add <br> after every three amenities.
                                                if ($count % 3 === 0 && $index < $totalAmenities - 1) {
                                                    echo '<br>';
                                                }
                                            }
                                        } else {
                                            echo "Herhangi bir oda özelliği eklenmedi.";
                                        }
                                        ?>
                                    </p>
                                        </div>
                                        </div>
                                        <div class="col-lg-3">
                                        <div class="product-item__content text-capitalize">
                                        <div class="d-flex align-items-center mb-2 flex-wrap">
                                            <span class="product-desc-price ">{{ $room->room_price }}  ₺ /<i> Gece</i></span>
                                        </div>
                                        <div class="stars-rating d-flex align-items-center flex-wrap">
                                            @if(isset($room->included) && $room->included == 0)
                                                Sadece Oda
                                            @elseif(isset($room->included) && $room->included == 1)
                                                Kahvaltı Dahil 
                                            @elseif(isset($room->included) && $room->included == 2)
                                                Herşey Dahil 
                                            @elseif(isset($room->included) && $room->included == 3)
                                                Ultra Herşey Dahil    
                                             @elseif(isset($room->included) && $room->included == 4)
                                                Yarım Pansiyon           
                                            @endif

                                        </div>
                                        <br>
                                        <div class="product-item__button d-xl-block d-flex flex-wrap">
                                        <form action="{{ route('calendar', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}" method="get" style="display: inline-block; margin-right: 10px;">
                                            @csrf   
                                            <button class="btn btn-default btn-squared color-light btn-outline-light ms-lg-0 ms-0 me-2 mb-lg-10"><img src="{{ asset('assets/img/svg/calendar.svg') }}" alt="room_availability" class="svg">
                                            Müsaitlik 
                                            </button>
                                        </form>
                                         <form action="{{ route('pricecalendar', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}" method="get" style="display: inline-block; margin-right: 10px;">
                                            @csrf   
                                            <button class="btn btn-default btn-squared color-light btn-outline-light ms-lg-0 ms-0 me-2 mb-lg-10"><img src="{{ asset('assets/img/svg/calendar.svg') }}" alt="room_prices" class="svg">
                                            Fiyat Takvimi 
                                            </button>
                                        </form>
                                        <form action="{{ route('roomdetails', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}" method="get" >
                                            @csrf   
                                            <button class="btn btn-primary btn-default btn-squared border-0 ms-0"><img src="{{ asset('assets/img/svg/edit.svg') }}" alt="room_detail" class="svg">
                                            Oda Detayları
                                            </button>
                                        </form>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            </div>

                        </div>


                       
                         @endforeach
                         <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                          <script>
                            // API'den veri çekmek için bir fonksiyon
                            function getRoomsForToday(hotelId) {
                                $.ajax({
                                    url: '/api/rooms/' + hotelId + '/checkavailabilityToday',
                                    type: 'GET',
                                    success: function(response) {
                                    console.log('Otele ait bugüne ait veriler:');
                                    console.log(response.availabilities);

                                    // Her bir veriyi döngü ile işleme
                                    response.availabilities.forEach(function(availability) {
                                        // İlgili oda numarasını al
                                        var roomId = availability.room_id;

                                        // İlgili switch'in durumunu güncelle
                                        toggleSwitch(roomId, availability.available);
                                    });
                                },

                                    error: function(error) {
                                        // Hata durumunda bu blok çalışır
                                        console.error('Veri getirme işlemi başarısız oldu:', error);
                                    }
                                });
                            }

                            // Sayfa yüklendiğinde çalışacak fonksiyon
                            $(document).ready(function() {
                                // Örnek bir çağrı yapmak için
                                var hotelId = 18; // Otel ID'sini istediğiniz değere güncelleyin
                                getRoomsForToday(hotelId);
                            });
                        </script>

                    

               <script>
                    // Odayı kapatma fonksiyonu
                    function closeTodayRoom(roomId) {
                        var today = new Date().toISOString().split('T')[0];

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log(xhr.responseText);
                                    // alert('Oda bugün için rezervasyona kapatılmıştır.');
                                } else {
                                    console.error('Hata:', xhr.status);
                                }
                            }
                        };

                        xhr.open('POST', '/api/rooms/' + roomId + '/closetoday', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('date=' + today);
                    }

                    // Odayı açma fonksiyonu
                    function openRoomToday(roomId) {
                        var today = new Date().toISOString().split('T')[0];

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === XMLHttpRequest.DONE) {
                                if (xhr.status === 200) {
                                    console.log(xhr.responseText);
                                    // alert('Oda bugün için satışa açılmıştır.');
                                } else {
                                    console.error('Hata:', xhr.status);
                                }
                            }
                        };

                        xhr.open('POST', '/api/rooms/' + roomId + '/opentoday', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.send('date=' + today);
                    }

                    // ToggleSwitch fonksiyonunu tanımla
                    function toggleSwitch(roomId) {
                        var switchElement = document.getElementById('switch-' + roomId);
                        var switchState = switchElement.checked ? 'on' : 'off';

                        // Eğer switch kapalıysa (checked değilse), closeTodayRoom fonksiyonunu çalıştır
                        if (switchState === 'off') {
                            closeTodayRoom(roomId);
                            alert('Oda bugün için rezervasyona kapatılmıştır.');
                        } else {
                            // Eğer switch açıksa (checked ise), openRoomToday fonksiyonunu çalıştır
                            openRoomToday(roomId);
                            alert('Oda bugün için satışa açılmıştır.');
                        }
                    }



                    
                </script>





    
      @endsection

