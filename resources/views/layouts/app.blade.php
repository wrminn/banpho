<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/template/layout.css') }}">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <section>
            <div id="carouselExampleSlidesOnly" class="carousel slide carousel-fade" data-bs-ride="carousel"
                data-bs-interval="2500">

                <!-- ตำแหน่งโลโก้และข้อความ -->
                <div class="carousel-brand">
                    <img src="{{ asset('/storage/detailweb/logo.png') }}" alt="Logo">
                    <span>เทศบาลตำบลบ้านโพธิ์
                        <p>Ban Pho Subdistrict Municipality</p>
                    </span>
                </div>

                <!-- สไลด์ -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://www.w3schools.com/howto/img_snow_wide.jpg" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.w3schools.com/howto/img_woods_wide.jpg" class="d-block w-100"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://www.w3schools.com/howto/img_lights_wide.jpg" class="d-block w-100"
                            alt="...">
                    </div>
                </div>
            </div>
        </section>

        <section class="box-container">

            <section class="box-menu">
                <nav class="nav-strip">
                    <a class="link-index" href="/home">
                        <div class="nav-pill has-submenu">
                            หน้าแรก
                        </div>
                    </a>
                    <div class="nav-pill has-submenu">
                        ข้อมูลพื้นฐานตำบล
                        <div class="submenu">
                            <a href="#">ประวัติความเป็นมา</a>
                            <a href="#">ข้อมูลสภาพทั่วไป</a>
                            <div class="submenu-item has-submenu">
                                ข้อมูลชุมชน
                                <div class="submenu sub-submenu">
                                    <a href="#">ข้อมูลและรายละเอียดชุมชน</a>
                                    <a href="#">ผู้นำชุมชน</a>
                                </div>
                            </div>
                            <a href="#">ผลิตภัณฑ์ชุมชน</a>
                            <a href="#">สถานที่สำคัญ</a>
                            <a href="#">แกลอรี่ภาพถ่ายภูมิทัศน์</a>
                            <a href="#">บริการขั้นพื้นฐาน</a>
                            <a href="#">ยุทธศาสตร์การพัฒนา</a>
                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        บุคลากร
                        <div class="submenu">
                            <a href="#">โครงสร้างองค์กร</a>
                            <a href="#">คณะผู้บริหาร</a>
                            <a href="#">สมาชิกสภา</a>
                            <a href="#">ผู้บริหารส่วนราชการ</a>
                            <a href="#">สำนักปลัดเทศบาล</a>
                            <a href="#">กองคลัง</a>
                            <a href="#">กองช่าง</a>
                            <a href="#">กองการศึกษา</a>
                            <a href="#">กองสาธารณสุขและสิ่งแวดล้อม</a>
                            <a href="#">กองสวัสดิการสังคม</a>
                            <a href="#">กองส่งเสริมการเกษตร</a>
                            <a href="#">กองยุทธศาสตร์และงบประมาณ</a>
                            <a href="#">กองการประปา</a>
                            <a href="#">หน่วยตรวจสอบภายใน</a>
                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        ผลการดำเนินงาน
                        <div class="submenu">
                            <div class="submenu-item has-submenu">
                                รายงานแสดงฐานะการเงิน
                                <div class="submenu sub-submenu">
                                    <a href="#">งบแสดงฐานะทางการเงิน</a>
                                    <a href="#">รายงานแสดงรายรับ-รายจ่าย</a>
                                    <a href="#">แผนการใช้จ่ายเงินงบประมาณประจำปี</a>
                                    <a href="#">รายงานการตรวจสอบการเงิน สำนักงานการตรวจเงินแผ่นดิน</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                รายงานผลการดำเนินงาน
                                <div class="submenu sub-submenu">
                                    <a href="#">รายงานผลการดำเนินงาน ประจำไตรมาส</a>
                                    <a href="#">รายงานผลการดำเนินงาน ประจำปีงบประมาณ</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                รายงานผลการจัดซื้อจัดจ้างหรือการจัดหาพัสดุ
                                <div class="submenu sub-submenu">
                                    <a href="#">รายงานผลการจัดซื้อจัดจ้างหรือการจัดหาพัสดุ</a>
                                    <a href="#">รายงานผลการจัดซื้อจัดจ้างหรือการจัดหาพัสดุรายเดือน</a>
                                    <a href="#">รายงานผลการจัดซื้อจัดจ้างหรือการจัดหาพัสดุประจำปี</a>
                                    <a href="#">ความก้าวหน้าในการจัดซื้อจัดจ้างหรือการจัดหาพัสดุ</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                ข้อมูลเชิงสถิติ
                                <div class="submenu sub-submenu">
                                    <a href="#">ข้อมูลเชิงสถิติการให้บริการ</a>
                                    <a href="#">ข้อมูลเชิงสถิติเรื่องร้องเรียนการทุจริตและประพฤติมิชอบ</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                การบริหารเเละพัฒนาทรัพยากรบุคคล
                                <div class="submenu sub-submenu">
                                    <a href="#">ประกาศและนโยบายการบริหารทรัพยากรบุคคล</a>
                                    <a href="#">หลักเกณฑ์การบริหารและพัฒนาทรัพยากรบุคคล</a>
                                    <a href="#">การดำเนินการตามนโยบายการบริหารทรัพยากรบุคคล</a>
                                    <a href="#">รายงานผลการบริหารและพัฒนาทรัพยากรบุคคลประจำปี</a>
                                    <a href="#">แผนการบริหารและพัฒนาทรัพยากรบุคคล</a>
                                    <a href="#">มาตรฐานการกำหนดตำแหน่ง</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                มาตรการส่งเสริมความโปร่งใสและป้องกันการทุจริต
                                <div class="submenu sub-submenu">
                                    <a href="#">มาตรการป้องกันการรับสินบน</a>
                                    <a href="#">มาตรการเผยแพร่ข้อมูลต่อสาธารณะ</a>
                                    <a href="#">มาตรการตรวจสอบการใช้ดุลพินิจ</a>
                                    <a href="#">มาตรการส่งเสริมความโปรงใส่ในการจัดซื้อจัดจ้าง</a>
                                    <a href="#">มาตรการจัดการเรื่องร้องเรียนการทุจริตและประพฤติมิชอบ</a>
                                    <a
                                        href="#">มาตรการให้ผู้มีส่วนได้เสียมีส่วนร่วมในการป้องกันทุจริตและประพฤติมิชอบ</a>
                                    <a
                                        href="#">มาตรการป้องกันการขัดกันระหว่างผลประโยชน์ส่วนตนกับผลประโยชน์ส่วนรวม</a>
                                    <a href="#">มาตรการส่งเสริมคุณธรรมและความโปร่งในภายในหน่วยงาน</a>
                                    <a
                                        href="#">รายงานผลการดำเนินการเพื่อส่งเสริมคุณธรรมและความโปร่งใสภายในหน่วยงาน</a>
                                    <a href="#">แนวปฏิบัติการจัดการเรื่องร้องเรียนการทุจริตและประพฤติมิชอบ</a>
                                </div>
                            </div>
                            <a href="#">งานควบคุมภายใน</a>
                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        อำนาจหน้าที่
                        <div class="submenu">
                            <a href="#">อำนาจหน้าที่ เทศบาล</a>
                            <a href="#">สำนักปลัดเทศบาล</a>
                            <a href="#">กองคลัง</a>
                            <a href="#">กองช่าง</a>
                            <a href="#">กองการศึกษา</a>
                            <a href="#">กองสาธารณสุขและสิ่งแวดล้อม</a>
                            <a href="#">กองสวัสดิการสังคม</a>
                            <a href="#">กองส่งเสริมการเกษตร</a>
                            <a href="#">กองยุทธศาสตร์และงบประมาณ</a>
                            <a href="#">กองการประปา</a>
                            <a href="#">หน่วยตรวจสอบภายใน</a>
                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        แผนพัฒนาท้องถิ่น
                        <div class="submenu">
                            <a href="#">แผนพัฒนาท้องถิ่น</a>
                            <a href="#">แผนการดำเนินงานประจำปี</a>
                            <a href="#">แผนแม่บทระบบเทคโนโลยีสารสนเทศ</a>
                            <a href="#">แผนการจัดซื้อจัดจ้างหรือการจัดหาพัสดุ</a>
                            <a href="#">แผนอัตรากำลัง</a>
                            <a href="#">แผนยุทธศาสตร์และการพัฒนา</a>
                            <a href="#">แผนปฏิบัติการป้องกันการทุจริตประจำปี</a>
                            <a href="#">เทศบัญญัติงบประมาณรายจ่าย</a>
                            <a href="#">การประเมินความเสี่ยงการทุจริตและประพฤติมิชอบประจำปี</a>
                            <a href="#">รายงานผลการดำเนินการป้องกันการทุจริตและประพฤติมิชอบประจำปี</a>
                            <a href="#">รายงานติดตามและประเมินผลแผนพัฒนา</a>
                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        กฎหมายและระเบียบ
                        <div class="submenu">
                            <div class="submenu-item has-submenu">
                                ข้อบัญญัติ และคำสั่ง อบต./เทศบัญญัติ และคำสั่งเทศบาล
                                <div class="submenu sub-submenu">
                                    <a href="#">ข้อบัญญัติ และคำสั่ง อบต./เทศบัญญัติ และคำสั่งเทศบาล</a>
                                </div>
                            </div>
                            <div class="submenu-item has-submenu">
                                กฎหมาย/ระเบียบของเทศบาล
                                <div class="submenu sub-submenu">
                                    <a href="#">กฎหมายที่เกี่ยวข้อง</a>
                                    <a href="#">กฎหมาย/ระเบียบ</a>
                                    <a href="#">กฎหมายเกี่ยวกับภาษี</a>
                                    <a href="#">ระเบียบเกี่ยวกับการจัดทำแผนพัฒนา</a>
                                    <a href="#">กฎหมายที่เกี่ยวกับการปฏิบัติงาน</a>
                                    <a href="#">กฎหมายเกี่ยวกับการจัดซื้อจัดจ้าง</a>
                                    <a href="#">กฎหมายเกี่ยวกับการจัดตั้ง/ขอบเขตอำนาจหน้าที่ของเทศบาล</a>
                                </div>
                            </div>
                            <a href="#">พระราชบัญญัติ และพระราชกฤษฎีกา</a>
                            <a href="#">กฎหมาย ระเบียบ และประกาศกระทรวง</a>

                        </div>
                    </div>

                    <div class="nav-pill has-submenu">
                        เมนูสำหรับประชาชน
                        <div class="submenu">
                            <a href="#">รับเรื่องราวร้องทุกข์ </a>
                            <a href="#">รับแจ้งร้องเรียนทุจริตประพฤติมิชอบ</a>
                            <a href="#">แบบสอบถามความพึงพอใจ </a>
                            <a href="#">รายงานผลการสำรวจความพึงพอใจการให้บริการ </a>
                            <div class="submenu-item has-submenu">
                                คู่มืออื่นๆ
                                <div class="submenu sub-submenu">
                                    <a href="#">คู่มือสำหรับประชาชน</a>
                                    <a href="#">คู่มือการป้องกันการทุจริต</a>
                                    <a href="#">คู่มือหรือมาตรฐานการปฏิบัติงาน</a>
                                    <a href="#">คู่มือหรือมาตรฐานการให้บริการ</a>
                                </div>
                            </div>
                            <a href="#">E-Service</a>
                            <a href="#">ดาวน์โหลดแบบฟอร์ม</a>
                            <a href="#">เบี้ยยังชีพผู้สูงอายุ</a>
                            <a href="#">เบี้ยยังชีพคนพิการ</a>
                            <a href="#">คำถามที่พบบ่อย</a>
                            <a href="#">ระบบจองห้องประชุมและเครื่องเสียงห้องประชุม</a>


                        </div>
                    </div>

                </nav>
            </section>

            <main class="py-4">
                @yield('content')
            </main>

        </section>
    </div>

</body>

</html>
