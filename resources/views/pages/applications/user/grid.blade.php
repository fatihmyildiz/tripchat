@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="breadcrumb-main user-member justify-content-sm-between ">
                <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                    <div class="d-flex align-items-center user-member__title justify-content-center me-sm-25">
                        <h4 class="text-capitalize fw-500 breadcrumb-title">İşletme Kullanıcıları</h4>
                       
                    </div>
                   
                </div>
                <div class="action-btn">
                    <a href="#" class="btn px-15 btn-primary" data-bs-toggle="modal" data-bs-target="#new-member">
                        <i class="las la-user-plus follow-icon"></i>Yeni Kullanıcı Ekle</a>
                    <div class="modal fade new-member" id="new-member" role="dialog" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content  radius-xl">
                                <div class="modal-header">
                                    <h6 class="modal-title fw-500" id="staticBackdropLabel">Admin Ekle</h6>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="uil uil-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="new-member-modal">
                                        <form method="post" action="{{ route('send-invite', app()->getLocale()) }}">
                                            @csrf
                                            <div class="form-group mb-20">
                                                <input type="email" class="form-control" name="email" placeholder="Davet edeceğiniz kullanıcı e-maili'ni girin.">
                                            </div>
                                            <div class="button-group d-flex pt-25">
                                                <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize">Kullanıcı Ekle</button>
                                                <button type="button" class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light">İptal Et</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <div class="row">

        @if(isset($users) && count($users) > 0)
        @foreach($users as $user)
        <div class="col-xxl-3 col-lg-4 col-md-6 mb-25">
            <div class="card pb-4">
                <div class="card-body text-center pt-30 px-25 pb-0">
                    <div class="account-profile-cards  ">
                        <div class="ap-img d-flex justify-content-center">
                            <img class="ap-img__main bg-opacity-primary  wh-120 rounded-circle mb-3 " src="{{ asset('assets/img/tm1.png') }}" alt="profile">
                        </div>
                        <div class="ap-nameAddress">
                            <h6 class="ap-nameAddress__title">{{ $user->name }}</h6>
                            <p class="ap-nameAddress__subTitle  fs-14 pt-1 m-0 ">{{ $user->email }}</p>
                        </div>
                        <div class="ap-button account-profile-cards__button button-group d-flex justify-content-center flex-wrap pt-20">
                            <!--<button type="button" class="border text-capitalize px-25 color-gray transparent shadow2 radius-md">
                                <img src="{{ asset('assets/img/svg/mail.svg') }}" alt="mail" class="svg">
                                message
                            </button>-->
                           <button type="button" class="border text-capitalize px-25 color-gray transparent shadow2 follow radius-md"
                                    data-user-id="{{ $user->id }}">
                                <span class="las la-user-minus follow-icon"></span>Çıkar
                            </button>

                        </div>
                    </div>
                    <!--
                    <div class="card-footer mt-20 pt-20 pb-20 px-0">
                        <div class="profile-overview d-flex justify-content-between flex-wrap">
                            <div class="po-details">
                                <h6 class="po-details__title">$72,572</h6>
                                <span class="po-details__sTitle">Total Revenue</span>
                            </div>
                            <div class="po-details">
                                <h6 class="po-details__title">3,257</h6>
                                <span class="po-details__sTitle">order</span>
                            </div>
                            <div class="po-details">
                                <h6 class="po-details__title">74</h6>
                                <span class="po-details__sTitle">Products</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    @endforeach
    @else
        <p>İşletmeye kayıtlı kullanıcı bulunamadı.</p>
    @endif
     
         @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
     
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let buttons = document.querySelectorAll('.follow');

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                let userId = this.getAttribute('data-user-id');

                // Onay penceresi göster
                let confirmRemove = confirm('Bu kullanıcıyı çıkarmak istediğinizden emin misiniz?');

                if (confirmRemove) {
                    // Kullanıcının gerçekten çıkarmak istediğini onayladıysa AJAX isteği gönder
                    axios.post('/api/remove-user/' + userId, { confirm: true })
                        .then(response => {
                            alert(response.data.message);

                            // Sayfayı yenileme işlemi
                            location.reload();
                        })
                        .catch(error => {
                            alert('Bir hata oluştu: ' + error.response.data.error);
                        });
                }
            });
        });
    });
</script>



@endsection