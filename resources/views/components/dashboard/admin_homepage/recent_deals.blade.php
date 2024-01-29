          

            <div class="col-xxl-4 col-lg-6 mb-25">

              <div class="card border-0 px-25 pb-15 h-100">
                <div class="card-header px-0 border-0">
                  <h6>Yeni Rezervasyonlar</h6>
                  <div class="card-extra">
                    <ul class="card-tab-links nav-tabs nav" role="tablist">
                     <li>
                   <a class="active" href="{{ Request::is(app()->getLocale().'/applications/reservations') ? 'active':'' }}" aria-selected="true">Tüm Rezervasyonlar</a>
                   </li>
                    </ul>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="t_selling-today8" role="tabpanel" aria-labelledby="t_selling-today-tab">
                      <div class="selling-table-wrap selling-table-wrap--source">
                        <div class="table-responsive">
                          <table class="table table--default table-borderless">
                            <thead>
                              <tr>
                                <th>Ad Soyad</th>
                                <th >Check-in/Check-out</th>
                                <th>Oluşturulma Tarihi</th>
                                <th>Çıktı Al</th>
                              </tr>
                            </thead>
                            <tbody>
                                                       @php
                                                        use App\Models\Reservation;
                                                        $hotelId = Auth::user()->hotel_id;
                                                        $query = Reservation::where('hotel_id', $hotelId)->orderBy('created_at', 'desc');
                                                        $Reservations = $query->latest('created_at')->limit(5)->get();
                                                        @endphp
                                                     @foreach($Reservations as $reservation)
                                                    <tr>
                                                        <td>
                                                            <div class="selling-product-img d-flex align-items-center">
                                                                @if($reservation->status == 3 || $reservation->status == 2)
                                                                    <span style="text-decoration: line-through;">{{ $reservation->customer->name }}</span>
                                                                @else
                                                                    <span>{{ $reservation->customer->name }}</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                @if($reservation->status == 3 || $reservation->status == 2)
                                                                    <span style="text-decoration: line-through;">{{ \Carbon\Carbon::parse($reservation->checkin_date)->format('d/m/Y') }}</span>
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($reservation->checkin_date)->format('d/m/Y') }}
                                                                @endif
                                                            </div> <br><div class="orderDatatable-title float-end">
                                                                @if($reservation->status == 3 || $reservation->status == 2)
                                                                    <span style="text-decoration: line-through;">{{ \Carbon\Carbon::parse($reservation->checkout_date)->format('d/m/Y') }}</span>
                                                                @else
                                                                    {{ \Carbon\Carbon::parse($reservation->checkout_date)->format('d/m/Y') }}
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="orderDatatable-title float-end">
                                                                {{ $reservation->created_at->diffForHumans() }}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('reservation.invoice', ['language' => app()->getLocale(), 'reservationId' => $reservation->id]) }}" class="view">
                                                                <i class="la la-file-invoice"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
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

<div class="col-xxl-4 col-lg-6 mb-25 pb-50">
    <div class="card banner-feature banner-feature--5 mb-0">
    <div class="banner-feature__shape mb-50">
        <img src="{{ asset('assets/img/svg/group3320.svg') }}" alt="img" class="svg">
    </div>
    <div class="d-flex justify-content-center">
        <div class="card-body">
        <h1 class="banner-feature__heading color-white">Chattrip Puanlarını Topla!</h1>
        <p class="banner-feature__para mb-50 pb-15">Chattrip'te müşterilerine mesajlaşarak bile Chattrip puanı kazanabilirsin. Puanlarınla ücretsiz konaklama yapabilir ya da nakit talep edebilirsin. Detayları okumak için aşşağıdaki butona tıklaman yeterli.</p><br>
        <button class="banner-feature__btn btn color-secondary btn-md px-20 bg-white radius-xs fs-15 mb-50 " type="button">Detaylar</button>
        </div>
    </div>
    </div>
</div>