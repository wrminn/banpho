@extends('layouts.app')
@section('title', $title)

@section('content')

    <section class="b-detail">
        <div class="form-wrapper">
            <h1 class="mb-4 text-center">{{ $title }}</h1>
            <form class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label">อายุ</label>
                    <input type="number" min="10" max="100" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-3">
                    <label for="inputPassword4" class="form-label">เบอร์โทร</label>
                    <input type="number" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                    <label class="form-label"><strong>เพศ</strong></label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="ชาย">
                        ชาย
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="หญิง">
                        หญิง
                    </div>
                </div>
                <div class="col-12">
                    <label for="inputAddress" class="form-label">ที่อยู่</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="col-12">
                    <label for="inputAddress2" class="form-label">อีเมล</label>
                    <input type="email" class="form-control" id="inputAddress2" placeholder="excemple@gmail.com">
                </div>
                <div class="col-md-6">
                    <label for="inputCity" class="form-label">City</label>
                    <input type="text" class="form-control" id="inputCity">
                </div>

                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-5">บันทึก</button>
                </div>
            </form>
        </div>
    </section>



@endsection
