@section('slide')
    <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="2500">

        <!-- ตำแหน่งโลโก้และข้อความ -->
        <div class="carousel-brand">
            <img src="{{ asset('/storage/detailweb/logo.png') }}" alt="Logo">
            <span>เทศบาลตำบลท่าข้าม
                <p>Tha Kham Subdistrict Municipality</p>
            </span>
        </div>

        <!-- สไลด์ -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://www.w3schools.com/howto/img_snow_wide.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.w3schools.com/howto/img_woods_wide.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>
@endsection
