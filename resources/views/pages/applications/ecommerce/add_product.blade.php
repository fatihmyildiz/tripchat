@section('title',$title)
@section('description',$description)
@extends('layout.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="shop-breadcrumb">
                <div class="breadcrumb-main">
                    <h4 class="text-capitalize breadcrumb-title">{{ trans('menu.ecommerce-product-add') }}</h4>
                    <div class="breadcrumb-action justify-content-center flex-wrap">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="las la-home"></i>{{ trans('menu.ecommerce-menu-title') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ trans('menu.ecommerce-product-add') }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="product-add global-shadow px-sm-30 py-sm-50 px-0 py-20 bg-white radius-xl w-100 mb-40">
                <div class="row justify-content-center">
                    <div class="col-xxl-7 col-lg-10">
                        <div class="mx-sm-30 mx-20 ">
                            <div class="card add-product p-sm-30 p-20 mb-30">
                                <div class="card-body p-0">
                                    <div class="card-header">
                                        <h6 class="fw-500">Oda Tipi Bilgilerini Girin</h6>
                                    </div>
                                    <div class="add-product__body px-sm-40 px-20">
                                        <form action="{{ route('room.createx', ['language' => app()->getLocale()]) }}" method="post" enctype="multipart/form-data" onsubmit="return submitForm()">
                                         @csrf
                                            <div class="form-group">
                                                <label for="room_name">Oda Tipi Adı</label>
                                                <input type="text" class="form-control" name="room_name" id="room_name" placeholder="Standart Oda, Çatı Katı Odası (Kahvaltı veya Yatak bilgisi girmeyiniz. )">
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-lg-6">
                                            
                                            <div class="form-group">
                                                <div class="countryOption">
                                                    <label for="breakfast">
                                                        Odaya Dahil 
                                                    </label>
                                                    <select class="js-example-basic-single js-states form-control" name="included" id="included">
                                                        <option value="0">Sadece Oda</option>
                                                        <option value="1">Kahvaltı Dahil</option>
                                                        <option value="2">Herşey Dahil</option>
                                                        <option value="3">Ultra Herşey Dahil</option>
                                                        <option value="4">Yarım Pansiyon</option>
                                                    </select>
                                                </div>
                                            </div>
                                            </div>
                                                <div class="col-lg-6">
                                                     <div class="form-group quantity-appearance">
                                                <label>Oda Ölçüsü</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="room_size">
                                                            m²
                                                        </span>
                                                    </div>
                                                    <div class="pt_Quantity">
                                                        <input name="room_size" type="number" class="form-control" min="0" max="1000" step="1" value="0" data-inc="1">
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                            <div class="form-group quantity-appearance">
                                                <label>Odanın Genel Fiyatı</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="room_price">
                                                            ₺
                                                        </span>
                                                    </div>
                                                    <div class="pt_Quantity">
                                                        <input type="number" name="room_price" class="form-control" min="0" max="300000" step="1" value="0" data-inc="1">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-lg-6">
                                            <div class="form-group quantity-appearance">
                                                <label>Max. Yetişkin Kapasitesi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="adults">
                                                            <i class="las la-user-tie"></i>
                                                        </span>
                                                    </div>
                                                    <div class="pt_Quantity">
                                                        <input type="number" class="form-control" name="adults" min="0" max="100" step="1" value="2" data-inc="1">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            
                                            <div class="form-group pt-5">
                                               <div class="row">
                                            <div class="col-lg-4">                                            
                                                <div class="me-15 d-flex align-items-center flex-wrap">
                                                    <label class="fs-14 fw-500 color-dark" for="double_bed">Çift Kişilik Yatak:</label>
                                                    <input type="number" id="double_bed" name="double_bed" value="1" class="qty qh-36 input" min="0" max="15">                                            
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="me-15 d-flex align-items-center flex-wrap">
                                                    <label class="fs-14 fw-500 color-dark" for="single_bed">Tek Kişilik Yatak:</label>
                                                    <input type="number" id="single_bed" name="single_bed" value="0" class="qty qh-36 input" min="0" max="15">                                            
                                                </div>
                                            </div>

                                            <div class="col-lg-4">                                            
                                                <div class="me-15 d-flex align-items-center flex-wrap">
                                                    <label class="fs-14 fw-500 color-dark" for="king_size_bed">King Size Yatak:</label>
                                                    <input type="number" id="king_size_bed" name="king_size_bed" value=0 class="qty qh-36 input" min="0" max="15">                                            
                                                </div>
                                            </div>
                                           
                                        </div>
                                            </div>
                                               <br>

                                             <div class="form-group">
                                               <div class="row">
                                                 <div class="col-lg-4">                                            
                                                   <div class="form-group status-radio add-product-status-radio mb-20">
                                                <label class="mb-15">Odaya Özel Banyo</label>
                                                <div class="d-flex">
                                                    <div class="radio-horizontal-list d-flex flex-wrap">
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="bathroom" value=1 id="bathroom1" checked>
                                                            <label for="bathroom1">
                                                                <span class="radio-text">Var</span>
                                                            </label>
                                                        </div>
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="bathroom" value=0 id="bathroom2" >
                                                            <label for="bathroom2">
                                                                <span class="radio-text">Yok</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                            <div class="col-lg-4">                                            
                                                   <div class="form-group status-radio add-product-status-radio mb-20">
                                                <label class="mb-15">Koltuk</label>
                                                <div class="d-flex">
                                                    <div class="radio-horizontal-list d-flex flex-wrap">
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="sofa" value=1 id="sofa1">
                                                            <label for="sofa1">
                                                                <span class="radio-text">Var</span>
                                                            </label>
                                                        </div>
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="sofa" value=0 id="sofa2" checked>
                                                            <label for="sofa2">
                                                                <span class="radio-text">Yok</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-lg-4">
                                                <div class="form-group status-radio add-product-status-radio mb-20">
                                                <label class="mb-15">Balkon/Teras</label>
                                                <div class="d-flex">
                                                    <div class="radio-horizontal-list d-flex flex-wrap">
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="balcony" value=1 id="balcony1">
                                                            <label for="balcony1">
                                                                <span class="radio-text">Var</span>
                                                            </label>
                                                        </div>
                                                        <div class="radio-theme-default custom-radio ">
                                                            <input class="radio" type="radio" name="balcony" value=0 id="balcony2" checked>
                                                            <label for="balcony2">
                                                                <span class="radio-text">Yok</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="name8">Diğer Oda Özellikleri</label><br>
                                                <div class="row">
                                    <div class="col-lg-3">  
                                        <div class="checkbox-theme-default custom-checkbox">
                                            <input type="checkbox" id="klimaCheckbox" name="amenities[]" value="1" >
                                            <label for="klimaCheckbox">
                                                <span class="checkbox-text">Klima</span>
                                            </label>
                                        </div>   <br>                                           
                                        <div class="checkbox-theme-default custom-checkbox">
                                            <input type="checkbox" id="tvCheckbox" name="amenities[]" value="2" >
                                            <label for="tvCheckbox">
                                                <span class="checkbox-text">Akıllı Tv</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="minibarCheckbox" name="amenities[]" value="3">
                                            <label for="minibarCheckbox">
                                                <span class="checkbox-text">Mini bar</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="moneyboxCheckbox" name="amenities[]" value="4">
                                            <label for="moneyboxCheckbox">
                                                <span class="checkbox-text">Para Kasası</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="wifiCheckbox" name="amenities[]" value="5" >
                                            <label for="wifiCheckbox">
                                                <span class="checkbox-text">Wi-fi</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="jakuziCheckbox" name="amenities[]" value="6">
                                            <label for="jakuziCheckbox">
                                                <span class="checkbox-text">Jakuzi</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="kuvetCheckbox" name="amenities[]" value="7">
                                            <label for="kuvetCheckbox">
                                                <span class="checkbox-text">Küvet</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="somineCheckbox" name="amenities[]" value="8" >
                                            <label for="somineCheckbox">
                                                <span class="checkbox-text">Şömine</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="kahveMakinesiCheckbox" name="amenities[]" value="9">
                                            <label for="kahveMakinesiCheckbox">
                                                <span class="checkbox-text">Kahve Makinesi</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="kettleCheckbox" name="amenities[]" value="10" >
                                            <label for="kettleCheckbox">
                                                <span class="checkbox-text">Kettle</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="seaviewCheckbox" name="amenities[]" value="11" >
                                            <label for="seaviewCheckbox">
                                                <span class="checkbox-text">Deniz Manzaralı</span>
                                            </label>
                                        </div>  <br>
                                        <div class="checkbox-theme-default custom-checkbox checkbox-group__single">
                                            <input type="checkbox" id="cityviewCheckbox" name="amenities[]" value="12" >
                                            <label for="cityviewCheckbox">
                                                <span class="checkbox-text">Şehir Manzaralı</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                </div>

                                </div>
                           <div class="card add-product p-sm-30 p-20">
                                <div class="card-body p-0">
                                    <div class="card-header">
                                        <h6 class="fw-500">Oda Görselleri</h6>
                                    </div>
                                    <div class="add-product__body-img px-sm-40 px-20">
                                        <label for="room_images" class="file-upload__label">
                                            <span class="upload-product-img px-10 d-block">
                                                <span class="file-upload">
                                                    <img class="svg" src="{{ asset('assets/img/svg/upload.svg') }}" alt="">
                                                    <input id="room_images" class="file-upload__input" type="file" name="room_images[]" multiple accept="image/*" onchange="handleImageSelect(this)">
                                                </span>
                                                <span class="pera">Görselleri sürükleyip bırakın</span>
                                                <span>veya <a href="#" class="color-secondary">Dosya Seç</a></span>
                                            </span>
                                        </label>
                                        <div id="image-preview-container" class="upload-product-media d-flex justify-content-between align-items-center mt-25"></div>
                                    </div>
                                </div>
                            </div>
                               <div class="button-group add-product-btn d-flex justify-content-sm-end justify-content-center mt-40">
                                <button class="btn btn-primary btn-default btn-squared text-capitalize" onclick="submitForm()">Odayı Ekle</button>
                            </div>
                            <div class=" alert alert-danger " role="alert" id="error-message" class="text-danger"></div>
                            <style>#error-message {    display: none; }</style>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitForm() {
        // Validate room name, room size, and room price
        var roomName = document.getElementById("room_name").value;
        var roomSize = parseFloat(document.getElementsByName("room_size")[0].value);
        var roomPrice = parseFloat(document.getElementsByName("room_price")[0].value);

        // Get the error message div element
        var errorMessage = document.getElementById("error-message");

        if (roomName === "" || roomName.length < 10) {
            errorMessage.innerHTML = "Oda adı karakter uzunluğu en az 10 olmalıdır.";
            errorMessage.style.display = "block"; // Show the error message
            return false; // Prevent form submission
        }

        // Check if the room size is greater than 0
        if (roomSize <= 0) {
            errorMessage.innerHTML = "Oda ölçüsü 0'dan büyük olmalıdır.";
            errorMessage.style.display = "block"; // Show the error message
            return false; // Prevent form submission
        }

        // Check if the room price is greater than 0
        if (roomPrice <= 0) {
            errorMessage.innerHTML = "Odanın genel fiyatı 0'dan büyük olmalıdır.";
            errorMessage.style.display = "block"; // Show the error message
            return false; // Prevent form submission
        }

        if (!validateRoomImages()) {
            // If validation fails, return without further processing
            return false; // Prevent form submission
        }

        errorMessage.innerHTML = "";
        errorMessage.style.display = "none";
    }

    function validateRoomImages() {
        // Get the file input element
        var fileInput = document.getElementById("room_images");

        // Check if any files have been selected
        if (fileInput.files.length === 0) {
            alert("Lütfen en az bir oda fotoğrafı ekleyin.");
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }

</script>

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
            // Dosya boyutu kontrolü (1.5 MB'dan küçükse devam et)
            if (file.size <= 1.5 * 1024 * 1024) {
                const reader = new FileReader();

                reader.onload = function (e) {
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

    function removeImage(button) {
        const imageElement = button.closest('.upload-media-area');
        imageElement.remove();
    }
</script>




@endsection