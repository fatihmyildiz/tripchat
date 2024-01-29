

            <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
              <!-- Card 3 -->
              <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">




                @php
                use App\Models\Reservation;
                $buAykiToplamKazanc = Reservation::whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->sum('subtotal');
                @endphp
                <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                  <div class="ap-po-details__titlebar">
                    <p>Bu ayki toplam kazanç</p>
                    <h1>₺ {{ number_format($buAykiToplamKazanc, 2) }}</h1>
                    <div class="ap-po-details-time">
                    </div>
                  </div>
                  <div class="ap-po-details__icon-area color-success">
                    <i class="uil uil-usd-circle"></i>
                  </div>
                </div>

              </div>
              <!-- Card 3 End  -->
            </div>

            <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
              <!-- Card 4  -->
              <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">





                <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                  <div class="ap-po-details__titlebar">
                    <p>Şuan İşletmedeki Misafir</p>
                    <h1>
                        {{
                            \App\Models\Reservation::where('status', 1)
                                ->where('hotel_id', auth()->user()->hotel_id)
                                ->count()
                        }}
                    </h1>
                    <div class="ap-po-details-time">
                     
                    </div>
                  </div>
                  <div class="ap-po-details__icon-area color-info">
                    <i class="uil uil-house-user"></i>
                  </div>
                </div>

              </div>
              <!-- Card 4 End  -->
            </div>


            <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
              <!-- Card 1  -->
              <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">




                @php                
                $bugunAlinanRezervasyonSayisi = Reservation::whereDate('created_at', today())->count();
                @endphp
                <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                  <div class="ap-po-details__titlebar">
                    <p>Bugün Alınan Rezervasyon</p>
                    <h1>{{ $bugunAlinanRezervasyonSayisi }}</h1>
                    <div class="ap-po-details-time">
                     
                    </div>
                  </div>
                  <div class="ap-po-details__icon-area color-primary">
                    <i class="uil uil-arrow-circle-right "></i>
                  </div>
                </div>

              </div>
              <!-- Card 1 End  -->
            </div>

            <div class="col-xxl-3 col-sm-6  col-ssm-12 mb-25">
              <!-- Card 2 -->
              <div class="ap-po-details ap-po-details--luodcy  overview-card-shape radius-xl d-flex justify-content-between">



                @php
                $buAyAlinanRezervasyonSayisi = Reservation::whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month)
                ->count();
                @endphp
                <div class=" ap-po-details-content d-flex flex-wrap justify-content-between w-100">
                  <div class="ap-po-details__titlebar">
                    <p>Bu Ay Alınan Rezervasyon</p>
                    <h1>{{ $buAyAlinanRezervasyonSayisi }}</h1>
                    <div class="ap-po-details-time">
                      
                    </div>
                  </div>
                  <div class="ap-po-details__icon-area color-secondary">
                    <i class="uil uil-arrow-circle-right "></i>
                  </div>
                </div>

              </div>
              <!-- Card 2 End  -->
            </div>