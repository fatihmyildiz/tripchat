<div class="col-xxl-8 mb-25">

  <div class="card border-0 px-25 pb-10 h-100">
    <div class="card-header px-0 border-0">
      <h6>Bugün Girişliler</h6>
      <div class="card-extra">
        <ul class="card-tab-links nav-tabs nav" role="tablist">
         
        </ul>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="tab-content">
        <div class="tab-pane fade active show" id="t_selling-today222" role="tabpanel" aria-labelledby="t_selling-today222-tab">
          <div class="selling-table-wrap selling-table-wrap--source">
            <div class="table-responsive">
              <table class="table table--default table-borderless">
                <thead>
                  <tr>
                                                        <th>
                                                            <span class="userDatatable-title">Durum</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title">Müşteri</span>
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
                                                            <span class="userDatatable-title">Fiyat</span>
                                                        </th>
                                                        <th>
                                                            <span class="userDatatable-title float-end">İşlem Yap</span>
                                                        </th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>

                                                  @php
                                                  use App\Models\Reservation;
                                                  use Illuminate\Support\Facades\Config;
                                                  $hotelId = Auth::user()->hotel_id;
                                                  $query = Reservation::where('hotel_id', $hotelId)->orderBy('created_at', 'desc');
                                                  $Reservations = $query->latest('created_at')->limit(200)->get();
                                                  $bugun = Config::get('today.bugun');
                                                  @endphp
                                               @foreach($Reservations as $reservation)
                                               @if (
                                                            in_array($reservation->status, [0, 1, 2, 3]) &&
                                                            \Carbon\Carbon::parse($reservation->checkin_date)->format('Y-m-d') == $bugun
                                                        )

                                                        <tr>
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
                                                                 <b>   {{ $reservation->customer->name }}</b>
                                                                </div>
                                                            </td>
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
                                                                <div class="orderDatatable-title">
                                                                   <i>{{ number_format($reservation->subtotal, 2) }} ₺</i> 
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
                                                    @endif
                                                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
       
      </div>
    </div>
  </div>

</div>