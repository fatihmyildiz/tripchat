@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="shop-breadcrumb">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.ecommerce-product-details') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.dashboard-menu-title') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.ecommerce-product-details') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            <div class="products mb-30">
                <div class="container-fluid">
                    <div class="card product-details h-100 border-0">
                        <div class="product-item d-flex p-sm-50 p-20">                
                            <div class="row">
                                <div class="col-lg-5">
                                    <form method="post" action="{{ route('roomdetails.update', ['language' => app()->getLocale(), 'room_id' => $roomDetails->id]) }}" enctype="multipart/form-data">
                                            @csrf
                                             @method('PUT')
                                      <div class="product-item__image">
                    <div class="wrap-gallery-article carousel slide carousel-fade" id="carouselExampleCaptions" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($roomDetails->roomPhotos as $key => $photo)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img class="img-fluid d-flex bg-opacity-primary" src="{{ asset('assets/img/rooms/' . $photo->image_path) }}" alt="Card image cap" title="">
                                </div>
                            @endforeach
                        </div>
                        <div class="overflow-hidden">
                            <ul class="reset-ul d-flex flex-wrap list-thumb-gallery">
                                @foreach ($roomDetails->roomPhotos as $key => $photo)
                                    <li>
                                        <a href="#" class="thumbnail {{ $key == 0 ? 'active' : '' }}" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}" aria-label="Slide {{ $key + 1 }}">
                                            <img class="img-fluid d-flex" src="{{ asset('assets/img/rooms/' . $photo->image_path) }}" alt="">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        
      
                                </div>
                           <div class="card-body">
                            <div class="dm-tag-wrap">
                                <div class="dm-upload">
                                    <div class="dm-upload__button">
                                        <a href="javascript:void(0)" class="btn btn-lg btn-outline-lighten btn-upload" onclick="$('#room_images').click()">
                                            <img src="{{ asset('assets/img/svg/upload.svg') }}" alt="upload" class="svg"> Yeni Oda Görselleri
                                        </a>
                                        <input id="room_images" class="file-upload__input" type="file" name="room_images[]" multiple accept="image/*" onchange="handleImageSelect(this)">
                                    </div>
                                    <div class="dm-upload__file">
                                        <div id="image-preview-container"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class=" col-lg-7">
                        <div class=" b-normal-b mb-25 pb-sm-35 pb-15 mt-lg-0 mt-15">
                            
                            <div class="product-item__body">
                                 <div class="row">
                                 <div class="col-lg-6">
                                   <div class="product-item__title">
                                    <label for="editableTitle">Oda Adı:</label>
                                    <input type="text" id="editableTitle" name="room_name" value="{{ $roomDetails->room_name }}">
                                </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="dm-select ">
                                            <select name="included" id="included" class="form-control ">
                                                <option value="0" {{ $roomDetails->included == 0 ? 'selected' : '' }}>Sadece Oda</option>
                                                <option value="1" {{ $roomDetails->included == 1 ? 'selected' : '' }}>Kahvaltı Dahil</option>
                                                <option value="2" {{ $roomDetails->included == 2 ? 'selected' : '' }}>Herşey Dahil</option>
                                                <option value="3" {{ $roomDetails->included == 3 ? 'selected' : '' }}>Ultra Herşey Dahil</option>
                                                <option value="4" {{ $roomDetails->included == 4 ? 'selected' : '' }}>Yarım Pansiyon</option>
                                            </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="product-item__content text-capitalize">
                               <span class="product-desc-price">
                               <label for="editablePrice">₺</label>
                                <input type="number" id="editablePrice" name="room_price" value="{{ $roomDetails->room_price }}" min="1" max="150000">
                                <label for="editableNumber1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kişi Sayısı:</label>
                                <input type="number" id="editableNumber1" name="adults" value="{{ $roomDetails->adults }}" min="1" max="20">
                                <label for="editableNumber2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M²:</label>
                                <input type="number" id="editableNumber2" name="room_size" value="{{ $roomDetails->room_size }}" min="5" max="20000">
                            </span>

                            <style>
                                .product-desc-price {
                                    display: flex;
                                    align-items: center;
                                }

                                .product-desc-price label {
                                    margin-right: 5px;
                                    font-size: 12px; /* Yazı boyutunu isteğiniz gibi ayarlayabilirsiniz */
                                }

                                .product-desc-price input {
                                    border: 1px solid #ccc;
                                    padding: 5px;
                                    width: 120px; 
                                    border-radius: 7px;
                                }
                                
                                .product-item__title {
                                    display: flex;
                                    align-items: center;
                                }

                                .product-item__title label {
                                    margin-right: 10px;
                                    font-size: 12px; /* Yazı boyutunu isteğiniz gibi ayarlayabilirsiniz */
                                }

                                .product-item__title input {
                                    width: 300px; 
                                    padding: 5px;
                                    border: 1px solid #ccc;
                                    border-radius: 5px;
                                }
                            </style>

                                    <hr style="margin-top: 25px; margin-bottom: 25px;">
                                    <div class="product-details__availability">
                                        <div class="row">
                                        <div class="col-lg-3">  
                                            <div class="checkbox-theme-default custom-checkbox">
                                                <input type="checkbox" id="klimaCheckbox" name="room_amenities[]" value="1" {{ in_array(1, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="klimaCheckbox">
                                                    <span class="checkbox-text">Klima</span>
                                                </label>
                                            </div>                                              
                                            <div class="checkbox-theme-default custom-checkbox">
                                                <input type="checkbox" id="tvCheckbox" name="room_amenities[]" value="2" {{ in_array(2, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="tvCheckbox">
                                                    <span class="checkbox-text">Akıllı Tv</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="minibarCheckbox" name="room_amenities[]" value="3" {{ in_array(3, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="minibarCheckbox">
                                                    <span class="checkbox-text">Mini bar</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="moneyboxCheckbox" name="room_amenities[]" value="4" {{ in_array(4, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="moneyboxCheckbox">
                                                    <span class="checkbox-text">Para Kasası</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="wifiCheckbox" name="room_amenities[]" value="5" {{ in_array(5, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="wifiCheckbox">
                                                    <span class="checkbox-text">Wi-fi</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="jakuziCheckbox" name="room_amenities[]" value="6" {{ in_array(6, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="jakuziCheckbox">
                                                    <span class="checkbox-text">Jakuzi</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="kuvetCheckbox" name="room_amenities[]" value="7" {{ in_array(7, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="kuvetCheckbox">
                                                    <span class="checkbox-text">Küvet</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="somineCheckbox" name="room_amenities[]" value="8" {{ in_array(8, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="somineCheckbox">
                                                    <span class="checkbox-text">Şömine</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="kahveMakinesiCheckbox" name="room_amenities[]" value="9" {{ in_array(9, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="kahveMakinesiCheckbox">
                                                    <span class="checkbox-text">Kahve Makinesi</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="kettleCheckbox" name="room_amenities[]" value="10" {{ in_array(10, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="kettleCheckbox">
                                                    <span class="checkbox-text">Kettle</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="seaviewCheckbox" name="room_amenities[]" value="11" {{ in_array(11, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="seaviewCheckbox">
                                                    <span class="checkbox-text">Deniz Manzaralı</span>
                                                </label>
                                            </div>
                                            <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                                <input type="checkbox" id="cityviewCheckbox" name="room_amenities[]" value="12" {{ in_array(12, explode(',', $roomDetails->room_amenities)) ? 'checked' : '' }}>
                                                <label for="cityviewCheckbox">
                                                    <span class="checkbox-text">Şehir Manzaralı</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    </div>

                                    <hr style="margin-top: 15px; margin-bottom: 5px;">
                                    <div class="quantity product-quantity flex-wrap">
                                        <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-4">                                            
                                                <div class="input-list__single">
                                                <div class="form-group mb-0">
                                                    <small class="text-muted">Çift Kişilik Yatak</small>
                                                    <div class="input-container icon-left position-relative">
                                                        <span class="input-icon icon-left">
                                                            <img src="{{ asset('assets/img/svg/user.svg') }}" alt="user" class="svg">
                                                        </span>
                                                        <input type="number" class="form-control form-control-sm"
                                                            placeholder="Çift Kişilik Yatak" value="{{ $roomDetails->double_bed }}" name="double_bed">
                                                        
                                                    </div>
                                                </div>
                                            </div>

                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-list__single">
                                                <div class="form-group mb-0">
                                                    <small class="text-muted">Tek Kişilik Yatak</small>
                                                    <div class="input-container icon-left position-relative">
                                                        <span class="input-icon icon-left">
                                                            <img src="{{ asset('assets/img/svg/user.svg') }}" alt="user" class="svg">
                                                        </span>
                                                        <input type="number" class="form-control form-control-sm"
                                                            placeholder="Tek Kişilik Yatak" value="{{ $roomDetails->single_bed }}" name="single_bed">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-list__single">
                                                <div class="form-group mb-0">
                                                    <small class="text-muted">King Size Yatak</small>
                                                    <div class="input-container icon-left position-relative">
                                                        <span class="input-icon icon-left">
                                                            <img src="{{ asset('assets/img/svg/user.svg') }}" alt="user" class="svg">
                                                        </span>
                                                        <input type="number" class="form-control form-control-sm"
                                                            placeholder="King Size Yatak" value="{{ $roomDetails->king_size_bed }}" name="king_size_bed">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="container-fluid mt-15">
                                        <div class="row">
                                            <div class="col-lg-4">                                            
                                                <div class="input-list__single">
                                                    <div class="form-group mb-0">
                                                        <small class="text-muted">Koltuk</small>
                                                        <div class="dm-select">
                                                            <select name="sofa" id="sofa" class="form-control form-control-sm">
                                                                <option value="1" {{ $roomDetails->sofa == 1 ? 'selected' : '' }}>Var</option>
                                                                <option value="0" {{ $roomDetails->sofa == 0 ? 'selected' : '' }}>Yok</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="col-lg-4">
                                                <div class="input-list__single">
                                                    <div class="form-group mb-0">
                                                        <small class="text-muted">Banyo</small>
                                                        <div class="dm-select">
                                                            <select name="bathroom" id="bathroom" class="form-control form-control-sm">
                                                                <option value="1" {{ $roomDetails->bathroom == 1 ? 'selected' : '' }}>Var</option>
                                                                <option value="0" {{ $roomDetails->bathroom == 0 ? 'selected' : '' }}>Yok</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                              <div class="input-list__single">
                                                    <div class="form-group mb-0">
                                                        <small class="text-muted">Balkon/Teras</small>
                                                        <div class="dm-select">
                                                            <select name="balcony" id="balcony" class="form-control form-control-sm">
                                                                <option value="1" {{ $roomDetails->balcony == 1 ? 'selected' : '' }}>Var</option>
                                                                <option value="0" {{ $roomDetails->balcony == 0 ? 'selected' : '' }}>Yok</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                    <div class="product-item__button mt-lg-30 mt-sm-25 mt-20 d-flex flex-wrap">
                                        <div class=" d-flex flex-wrap product-item__action align-items-center">
                                            
                                            <button type="submit" onclick="return validateForm()" class="btn btn-secondary btn-default btn-squared border-0 px-25 my-sm-0 my-2 me-10">
                                                <img src="{{ asset('assets/img/svg/edit.svg') }}" alt="shopping-bag" class="svg">
                                                Oda Bilgilerini Güncelle
                                            </button>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                        @if(auth()->user() && auth()->user()->role == 2)
                        <button type="button" class="btn btn-danger btn-default btn-rounded" data-bs-toggle="modal" data-bs-target="#modal-info-delete">
                        <img src="{{ asset('assets/img/svg/trash-2.svg') }}" alt="layers" class="svg">
                        Odayı Sil
                            </button>

                            <div class="modal-info-delete modal fade show" id="modal-info-delete" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-sm modal-info" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="modal-info-body d-flex">
                                                <div class="modal-info-icon warning">
                                                    <img src="{{ asset('assets/img/svg/alert-circle.svg') }}" alt="alert-circle" class="svg">
                                                </div>

                                                <div class="modal-info-text">
                                                    <h6>Odayı silmek istediğinizden eminmisiniz?</h6>
                                                    <p>Odaya ait müsaitlik ve özel fiyat verileri silinir, rezervasyon verileri silinmez.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                    <button type="button" class="btn btn-danger btn-outlined btn-sm" data-bs-dismiss="modal">Hayır</button>
                                     <form method="POST" action="{{ route('hotel.room_delete', ['language' => app()->getLocale(), 'room_id' => $roomDetails->id]) }}">
                                                            @csrf
                                    <button type="submit" class="btn btn-success btn-outlined btn-sm" data-bs-dismiss="modal" >Evet</button>
                                    </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
   <script>
    function handleImageSelect(input) {
        const imagePreviewContainer = document.getElementById('image-preview-container');
        imagePreviewContainer.innerHTML = ''; // Önceki önizlemeleri temizle

        // En fazla 3 fotoğraf ekleme sınırı
        const maxImages = 3;
        const selectedImages = Array.from(input.files).slice(0, maxImages);

        if (selectedImages.length > maxImages) {
            alert(`En fazla ${maxImages} fotoğraf ekleyebilirsiniz.`);
            input.value = ''; // Dosyaları temizle
            return;
        }

        let isAnyImageOverLimit = false;

        for (const file of selectedImages) {
            if (file.size <= 1.5 * 1024 * 1024) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    const timestamp = new Date().getTime(); // Şu anki zaman damgası
                    const uniqueFileName = `${timestamp}_${file.name}`;

                    const imageElement = document.createElement('div');
                    imageElement.classList.add('upload-media-area', 'd-flex');

                      imageElement.innerHTML = `
                        <img src="${e.target.result}" alt="${file.name}">
                        <div class="upload-media-area__title d-flex flex-wrap align-items-center ms-10">
                            <div>
                                <p>${file.name}</p>
                                <span>${(file.size / 1024).toFixed(2)} KB</span>
                            </div>
                        </div>`;

                    imagePreviewContainer.appendChild(imageElement);
                };

                reader.readAsDataURL(file);
            } else {
                isAnyImageOverLimit = true;
                alert('Bir veya daha fazla dosya 1.5 MB\'dan büyük. Lütfen daha küçük dosyalar seçin.');
                // Dosya boyutu sınırları aşıldığı için seçilen dosyayı iptal et
                input.value = '';
                break; // Diğer dosyaları kontrol etmeye gerek yok
            }
        }

        if (isAnyImageOverLimit || selectedImages.length < input.files.length) {
            // Eğer bir veya daha fazla dosya limiti aşıyorsa veya dosya sayısı maxImages sınırının altındaysa,
            // uyarı göster, diğer önizlemeleri temizle ve seçilen dosyaları iptal et
            alert(`En fazla ${maxImages} fotoğraf ekleyebilirsiniz.`);
            imagePreviewContainer.innerHTML = '';
            input.value = '';
        }
    }

   
</script>


@endsection