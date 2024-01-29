@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="section-body">
    <div class="col-12">
    <div class="card card-default card-md mb-4">
        <div class="card-header">
            <h6>{{ $roomName }}</h6>
        </div>
        <div class="card-body">
            <a href="" class="menu-mob-trigger d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </a>
            <div class="menu-wrapper">
                <ul class="dm-menu menu-top menu-horizontal">
                    <li class="dm-menu__item has-submenu">
                        <a class="dm-menu__link" href="#">
                            <span class="dm-menu__icon"><img src="{{ asset('assets/img/svg/settings.svg') }}" alt="settings" class="svg"></span>
                            <span class="dm-menu__text">Oda Seç: <i>{{ $roomName }} 
                               
                             @if ($included == 1)
                                    (Kahvaltı Dahil)
                                @elseif ($included == 2)
                                    (Herşey Dahil)
                                @elseif ($included == 3)
                                    (Ultra Herşey Dahil)
                                @elseif ($included == 4)
                                    (Yarım Pansiyon)
                                
                                @endif </i></span>
                        </a>
                        <ul class="dm-submenu">
                           @foreach($otherRooms as $otherRoom)
                            <li>
                                <a href="{{ route('pricecalendar', ['room_id' => $otherRoom->id, 'language' => app()->getLocale()]) }}">
                                {{ $otherRoom->room_name }}

                                @if ($otherRoom->included == 1)
                                    (Kahvaltı Dahil)
                                @elseif ($otherRoom->included == 2)
                                    (Herşey Dahil)
                                @elseif ($otherRoom->included == 3)
                                    (Ultra Herşey Dahil)
                                @elseif ($otherRoom->included == 4)
                                    (Yarım Pansiyon)
                                {{-- Eğer $otherRoom->included 0 ise hiçbir şey yazma --}}
                                @endif
                            </a>

                            </li>
                        @endforeach
                        </ul>
                        <style>
                            .dm-menu {
                                z-index: 1000;
                            }
                        </style>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
  
    <div class="row">
         <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3" style="z-index: 0;">
              <i>Özel fiyat girmek istediğiniz güne tıklayınız.</i>
              <!-- /.card --> 
                
            </div>
          </div>


          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
                <!-- Modal -->
<div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fiyat Ekle</h5>
            </div>
            <div class="modal-body">
                <label for="eventPrice">Fiyatı girin:</label>
                <input type="text" id="eventPrice" class="form-control" placeholder="Fiyatı girin">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                <button type="button" id="addPriceBtn" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>
</div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div> 
</div>
<style >
    #calendar .fc-event-title {
    color: #808695; 
}

#calendar .fc-event {
    background-color: #c1f0c1;
}

</style>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(function () {
    var roomId = {{ $id }};
    var hotelId = {{ $hotelId }};
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var calendarEl = document.getElementById('calendar');
    var events = @json($prices).map(function(event) {
        event.title = event.price + ' ₺';
        return event;
    });
    var Calendar = FullCalendar.Calendar;

    var calendar = new Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next',
            center: 'title',
            right: ''
        },
        themeSystem: 'standart',
        events: events,
        editable: false,
        eventResizable: false,
        droppable: false,
        dateClick: function (info) {
            var today = new Date();
            var clickedDate = new Date(info.date);

            if (
                clickedDate.getFullYear() < today.getFullYear() ||
                (clickedDate.getFullYear() === today.getFullYear() &&
                 clickedDate.getMonth() < today.getMonth()) ||
                (clickedDate.getFullYear() === today.getFullYear() &&
                 clickedDate.getMonth() === today.getMonth() &&
                 clickedDate.getDate() < today.getDate() - 1)
            ) {
                alert("Dünden daha önceki tarihler için işlem yapamazsınız.");
                return;
            }
            
            $('#priceModal').modal('show');
            var selectedDate = info.dateStr;
            $('#addPriceBtn').off('click').on('click', function () {
                var eventPrice = $('#eventPrice').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: 'http://localhost:8000/api/add-room-price',
                    method: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: {
                        room_id: roomId,
                        hotel_id: hotelId,
                        title: eventPrice,
                        start: selectedDate
                    },
                    success: function (response) {
                        console.log('Price data sent to API successfully:', response);
                        $('#priceModal').modal('hide');
                        $('#eventPrice').val('');
                        
                        // Sayfanın yeniden yüklenmesini sağlayın
                        window.location.reload();
                    },
                    error: function (error) {
                        console.error('Error sending price data to API:', error);
                    }
                });
            });
        }
    });

    calendar.render();
});

</script>
@endsection