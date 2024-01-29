 <div class="col-xxl-3 col-lg-4 col-md-6 mb-25">
                   
                </div>
                @if(auth()->user())
                    @php
                        $pendingInvite = \App\Models\Invite::where('user_id', auth()->user()->id)
                            ->where('accepted', false)
                            ->first();
                    @endphp

                    @if($pendingInvite)
                        


                          <div class="user-group radius-xl media-ui media-ui--late pt-30 pb-25">
                        <div class="border-bottom px-30">
                            <div class="media user-group-media d-flex justify-content-between">
                                <div class="media-body d-flex align-items-center flex-wrap text-capitalize my-sm-0 my-n2">
                                    <a href="application-ui.html">
                                        <h6 class="mt-0  fw-500 user-group media-ui__title bg-transparent">{{ $pendingInvite->hotel->hotel_name  }}</h6>
                                    </a>
                                    <span class="my-sm-0 my-2 media-badge text-uppercase color-white bg-success">Bekleyen Davet</span>
                                </div>
                                
                            </div>
                            <div class="user-group-people mt-15 text-capitalize">
                                <p>{{ $pendingInvite->hotel->hotel_city  }} , {{ $pendingInvite->hotel->hotel_town  }} , {{ $pendingInvite->hotel->hotel_address  }}</p>
                                <div class="user-group-project">
                                    <div class="d-flex align-items-center user-group-progress-top">
                                        <div class="media-ui__start">
                                          <form action="{{ route('accept-invite', ['language' => app()->getLocale(),'userId' => auth()->user()->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-rounded color-success btn-outline-success">Kabul Et</button>
                                            </form>
                                        </div>
                                        <div class="media-ui__end">
                                             <form action="{{ route('reject-invite',['language' => app()->getLocale(),'userId' => auth()->user()->id]) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-default btn-rounded color-danger btn-outline-danger">Reddet</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="user-group-progress-bar dropleft">
                                
                                
                            </div>
                        </div>
                        
                    </div>
                    @endif
                @endif
                <div class="col-xxl-3 col-lg-4 col-md-6 mb-25">
                  
                </div>