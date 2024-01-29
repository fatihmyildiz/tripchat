<div class="sidebar__menu-group">
    <ul class="sidebar_nav">
        
          
                <li class="menu-title mt-30">
            <span>Applications</span>
        </li>
       
        <li>
            <a href="{{ route('chat',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/chat') ? 'active':'' }}">
                <span class="nav-icon uil uil-chat"></span>
                <span class="menu-text">Chat</span>
                <span class="badge badge-success menuItem rounded-circle">3</span>
            </a>
        </li>
        <li>
            <a href="{{ route('hotel.product_list',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/hotels/room-list') ? 'active':'' }}">
                <span class="nav-icon la la-list"></span>
                <span class="menu-text">{{ trans('menu.room-list') }}</span>
            </a>
        </li>
        <li>
            <a href="{{ route('hotel.add_product',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/hotels/room-add') ? 'active':'' }}">
                <span class="nav-icon la la-plus-circle"></span>
                <span class="menu-text">{{ trans('menu.room-add') }}</span>
            </a>
        </li>
         <li>
            <a href="{{ route('reservation.reservations',app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/reservations') ? 'active':'' }}">
                <span class="nav-icon la la-sign-out-alt"></span>
                <span class="menu-text">{{ trans('menu.reservations') }}</span>
            </a>
        </li>

        <li class="has-child {{ Request::is(app()->getLocale().'/availability/*') ? 'open':'' }}">
        <a href="#" class="{{ Request::is(app()->getLocale().'/availability/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-bed"></span>
        <span class="menu-text">{{ trans('menu.calendar') }}</span>
        <span class="toggle-icon"></span>
        </a>
         <ul>
        @php
        use App\Models\Room;
        $hotelId = auth()->user()->hotel_id;    
        $hotelRooms = Room::where('hotel_id', $hotelId)->get();
        @endphp
        @if(count($hotelRooms) > 0)
                    @foreach($hotelRooms as $room)
                        <li><a href="{{ route('calendar', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}">{{ $room->room_name }}</a></li>
                    @endforeach
                    @else
                       <i> <li><a href="#">{{ trans('menu.no-rooms') }}</a></li></i>
                    @endif
          
            </ul>
        </li>

        <li class="has-child {{ Request::is(app()->getLocale().'/availability/*') ? 'open':'' }}">
        <a href="#" class="{{ Request::is(app()->getLocale().'/availability/*') ? 'active':'' }}">
        <span class="nav-icon uil uil-bill"></span>
        <span class="menu-text">{{ trans('menu.pricecalendar') }}</span>
        <span class="toggle-icon"></span>
        </a>
         <ul>
        @if(count($hotelRooms) > 0)
                    @foreach($hotelRooms as $room)
                        <li><a href="{{ route('pricecalendar', ['language' => app()->getLocale(), 'room_id' => $room->id]) }}">{{ $room->room_name }}</a></li>
                    @endforeach
                    @else
                       <i> <li><a href="#">{{ trans('menu.no-rooms') }}</a></li></i>
                    @endif
          
            </ul>
        </li>

        
        <li>
            @if(auth()->user() && auth()->user()->role == 2)
                <a href="{{ route('hotel.grid', app()->getLocale()) }}" class="{{ Request::is(app()->getLocale().'/applications/hotels/team') ? 'active':'' }}">
                    <span class="nav-icon la la-users"></span>
                    <span class="menu-text">{{ trans('menu.team') }}</span>
                </a>
            @endif
        </li>



        
      
    </ul>
</div>
