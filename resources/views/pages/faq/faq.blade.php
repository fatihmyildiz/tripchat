@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <div class="breadcrumb-main">
                <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.faq-menu-title') }}</h4>
                <div class="breadcrumb-action justify-content-center flex-wrap">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.faq-menu-title') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12  ">
           
          
        </div><!-- ends: col -->
        <div class="col-xxl-12 col-xl-12 col-sm-12">
            <div class="mb-30">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade  show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <!-- Edit Profile -->

                        <div class="card h-100 shadow-lg pb-md-50 pb-30 mb-md-50 mb-30">
                            <div class="card-header px-30 pt-30 pb-25 border-bottom-0">
                                <h4 class="fw-500">Soru ve Cevaplar</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="application-faqs">
                                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                        <!-- panel 1 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingOne">
                                                <h4 class="panel-title">
                                                    <a data-bs-toggle="collapse" data-parent="#accordion"
                                                        href="#collapseOne" aria-expanded="true">
                                                        Trippuan ile neler kazanabilirim ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapseOne" class="panel-collapse collapse in show"
                                                role="tabpanel" aria-labelledby="headingOne">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Trippuan'ınız ile her hafta gerçekleşen çekilişimiz de verilen onlarca hediyeden birini kazanabilir, dilerseniz Trippuan'ınızı seçeceğiniz Chattrip ile anlaşmalı işletmelerden birinde konaklayarak harcayabilirsiniz.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 2 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingTwo">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseTwo"
                                                        aria-expanded="false">
                                                        Mesajlaşarak nekadar Trippuan kazanabilirim ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingTwo">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Chattrip ile mesajlaştığınız her bir üye üzerinden Trippuan kazanmanız mümkün. Unutmayın her bir üye ile yaptığınız mesajlaşma size günde bir defaya mahsus Trippuan kazandıracaktır.</p>
                                                    
                                            </div>
                                        </div>
                                        <!-- panel 3 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingThree">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseThree"
                                                        aria-expanded="false">
                                                        Trippuan'dan kazandığım hediyeyi nezaman teslim alabilirim ? 
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingThree">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Çekilişten kazandığınız hediye sizinle irtibat kurulmasının ardından 5 iş günü içerisin de kargoya teslim edilir.</p>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 4 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingfour">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapsefour"
                                                        aria-expanded="false">
                                                        Trippuan'ım ile kazandığım konaklamamı ne zaman alabilirim ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapsefour" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingfour">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Trippuan'ınız ile talep ettiğiniz konaklama bileti 2 iş günü içerisinde hesabınıza tanımlanır.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 5 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingfive">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapsefive"
                                                        aria-expanded="false">
                                                        Trippuan'larım hesabımda nezaman görünecek ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapsefive" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingfive">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Gün içerisinde kazandığınız tüm Trippuan'lar gün sonunda hesabınıza tanımlanır.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 6 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingsix">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapsesix"
                                                        aria-expanded="false">
                                                        Trippuan'larım nekadar süre geçerli ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapsesix" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingsix">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Trippuan'larınızın geçerlilik süresi 6 aydır.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 7 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingseven">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseseven"
                                                        aria-expanded="false">
                                                        Hangi işlem Trippuan'ı daha çok kazandırır ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapseseven" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingseven">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Mesajlaşma üzerinden aldığınız rezervasyon size en çok Trippuan'ı kazandıracak işleminizdir. Rezervasyon ile ilgili tüm işlemler size daha çok Trippuan kazandıracaktır. Unutmayın iptal etiğiniz rezervasyonlardan gelen Trippuan'lar silinir.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- panel 8 -->
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="headingeight">
                                                <h4 class="panel-title">
                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                        data-parent="#accordion" href="#collapseeight"
                                                        aria-expanded="false">
                                                        Trippuan'ımla her hafta çekilişlere katılabilirmiyim ?
                                                    </a>
                                                </h4>

                                            </div>
                                            <div id="collapseeight" class="panel-collapse collapse" role="tabpanel"
                                                aria-labelledby="headingeight">
                                                <div class="panel-body">
                                                    <p class="mb-sm-35 mb-20">Çekilişi kazanmanız durumunda aynı ay içerisinde başka bir çekilişe katılamazsınız. Bunun dışında her hafta çekilişlere katılabilirsiniz.</p>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Profile End -->
                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                    </div>
                    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                    </div>
                    <div class="tab-pane fade " id="v-pills-settings" role="tabpanel"
                        aria-labelledby="v-pills-settings-tab">
                    </div>
                    <div class="tab-pane fade" id="v-pills-notification" role="tabpanel"
                        aria-labelledby="v-pills-notification-tab">
                    </div>
                    <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                        aria-labelledby="v-pills-support-tab">
                    </div>
                </div>
            </div>
        </div><!-- ends: col -->
    </div>
</div>
@endsection
