@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="section-body">
  
    <div class="dm-page-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">

                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.calendar-menu-title') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.calendar-menu-title') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
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
                                <a href="{{ route('calendar', ['room_id' => $otherRoom->id, 'language' => app()->getLocale()]) }}">
                                {{ $otherRoom->room_name }}

                                @if ($otherRoom->included == 1)
                                    (Kahvaltı Dahil)
                                @elseif ($otherRoom->included == 2)
                                    (Herşey Dahil)
                                @elseif ($otherRoom->included == 3)
                                    (Ultra Herşey Dahil)
                                @elseif ($otherRoom->included == 4)
                                    (Yarım Pansiyon)
                                
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

        <div class="row calendar-grid justify-content-center">
            <div class="row">
         <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="sticky-top mb-3" style="z-index: 0;">
              <div class="card">
                <div class="card-header">
                  <i class="card-title">Barı takvimin üzerine sürükleyip bırakın.</i>
                </div>
                <div class="card-body">
                  <!-- the events -->
                  <div id="external-events">
                    <style>
                      .external-event {
                          background-color: #dc3545; /* Danger rengi */
                          color: #fff; /* Metin rengi beyaz */
                          border-radius: 4px; /* Kenar yuvarlaklığı */
                          padding: 8px 12px; /* İç içe olan kenar boşluğu */
                      }
                  </style>

                    
                    <div class="external-event">Dolu</div>
                    <div class="checkbox">
                      <label for="drop-remove">
                      </label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card --> 
              
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
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
        </div>
    </div>
</div>


<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function ini_events(ele) {
            ele.each(function () {
                var eventObject = {
                    title: $.trim($(this).text())
                };
                $(this).data('eventObject', eventObject);
                $(this).draggable({
                    zIndex: 1070,
                    revert: true,
                    revertDuration: 0
                });
            });
        }

        ini_events($('#external-events div.external-event'));

        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var calendarEl = document.getElementById('calendar');
        var events = @json($events);
        var roomId = {{ $room_id }};

        function initializeCalendar() {
            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function (eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

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
                droppable: true,
                drop: function (info) {
                    var droppedDate = info.dateStr;
                    console.log('Event dropped on:', droppedDate);

                    // Bugünü ve dünü kontrol et
                    var today = new Date();
                    today.setHours(0, 0, 0, 0);

                    var yesterday = new Date(today);
                    yesterday.setDate(today.getDate() - 1);

                    if (new Date(droppedDate) <= yesterday) {
                        // Bugünü ve dünü kabul etme
                        alert("Geçmiş tarihlere işlem yapamazsınız.");
                        info.revert();
                        return;
                    }

                    var eventData = {
                        room_id: roomId,
                        title: info.draggedEl.innerText,
                        start: droppedDate
                    };
                    $.ajax({
                        url: 'http://localhost:8000/api/events',
                        method: 'POST',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: eventData,
                        success: function (response) {
                            console.log('Event data sent to API successfully:', response);
                        },
                        error: function (xhr, status, error) {
                            console.error('Error sending event data to API:', error);
                        }
                    });
                },

                eventClick: function (info) {
                    if (confirm("Oda müsait durumuna alınsın mı ?")) {
                        var csrfToken = $('meta[name="csrf-token"]').attr('content');
                        var eventId = info.event.id;

                        var eventData = {
                            id: eventId
                        };

                        var jsonData = JSON.stringify(eventData);

                        $.ajax({
                            url: '/api/delete-event',
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            contentType: 'application/json',
                            data: jsonData,
                            dataType: 'json',
                            success: function (response) {
                                console.log('Event deleted successfully:', response);
                                info.event.remove();
                            },
                            error: function (xhr, status, error) {
                                console.error('Error deleting event:', error);
                            }
                        });
                    }
                }
            });

            calendar.render();
        }

        initializeCalendar();
    });
</script>


@endsection