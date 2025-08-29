<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@400;600&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

</head>

<body>
    <div class="sidebar">
        <div class="logo">WEB-DEMO</div>

        <!-- โปรไฟล์ -->
        <div class="profile" id="profileBtn">
            <img src="{{ asset('img/menu/001.jpg') }}" alt="Profile">
            <div class="info">ผู้ใช้งาน</div>
            <div class="profile-popup" id="profilePopup">
                {{-- <a href="#">แก้ไขข้อมูลโปรไฟล์</a> --}}
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="text-blue-600 hover:text-blue-800">
                    ออกจากระบบ
                </a>
            </div>
        </div>

        <!-- เมนู -->
        <?php /*
        <div class="menu">
            <div class="menu-item has-submenu">
                ข้อมูลพื้นฐานตำบล
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="#">ประวัติความเป็นมา</a>
                <a href="#">ข้อมูลสภาพทั่วไป</a>
            </div>

            <div class="menu-item has-submenu">
                ข้อมูลชุมชน
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="#">ผู้นำชุมชน</a>
                <div class="menu-item has-submenu">
                    ผลิตภัณฑ์ชุมชน
                    <i class='bx bx-chevron-right chevron'></i>
                </div>
                <div class="submenu level-2">
                    <a href="#">สถานที่สำคัญ</a>
                    <div class="menu-item has-submenu">
                        แกลอรี่ภาพถ่าย
                        <i class='bx bx-chevron-right chevron'></i>
                    </div>
                    <div class="submenu level-3">
                        <a href="#">ภาพเก่า</a>
                        <a href="#">ภาพใหม่</a>
                    </div>
                </div>
            </div>
        </div>
        */
        ?>
        <div class="menu">
            <div class="menu-item has-submenu">
                ข้อมูลพื้นฐานตำบล
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/listtexteditor/menu/1">ประวัติความเป็นมา</a>
                <a href="/backend/listtexteditor/menu/2">วิสัยทัศน์</a>
                <a href="/backend/listtexteditor/menu/3">ข้อมูลสภาพทั่วไป</a>
                <a href="/backend/listtexteditor/menu/4">บริการขั้นพื้นฐาน</a>
                <div class="menu-item has-submenu">
                    ข้อมูลชุมชน
                    <i class='bx bx-chevron-right chevron'></i>
                </div>
                <div class="submenu level-2">
                    <a href="/backend/personnel/menu/5">ผู้นำชุมชน</a>
                    <a href="/backend/listtexteditor/menu/6">รายละเอียดชุมชน</a>

                </div>
                <a href="/backend/list/menu/7">ผลิตภัณฑ์ชุมชน</a>
                <a href="/backend/list/menu/8">สถานที่ท่องเที่ยว</a>
            </div>
            <div class="menu-item has-submenu">
                บุคลากร
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/listtexteditor/menu/9">โครงสร้างองค์กร</a>
                <a href="/backend/personnel/menu/10">คณะผู้บริหาร</a>
                <a href="/backend/personnel/menu/11">สภาชิกสภา</a>
                <a href="/backend/personnel/menu/12">ผู้บริหารส่วนราชการ</a>
                <a href="/backend/personnel/menu/13">สำนักปลัด</a>
                <a href="/backend/personnel/menu/14">กองคลัง</a>
                <a href="/backend/personnel/menu/15">กองช่าง</a>
                <a href="/backend/personnel/menu/16">กองการศึกษา</a>
                <a href="/backend/personnel/menu/17">หน่วยตรวจสอบภายใน</a>
            </div>
            <div class="menu-item has-submenu">
                ผลการดำเนินงาน
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/listcat/menu/18/cate/0">รายงานกองคลัง</a>
                <a href="/backend/listcat/menu/19/cate/0">รายงานผลการดำเนินงาน</a>
                <a href="/backend/listcat/menu/20/cate/0">รายงานการจัดซื้อจัดจ้างหรือการจัดหาพัสดุ</a>
                <a href="/backend/listcat/menu/21/cate/0">ข้อมูลเชิงสถิติ</a>
                <a href="/backend/listcat/menu/22/cate/0">การบริหารและพัฒนาทรัพยากรบุคล</a>
                <a href="/backend/listcat/menu/23/cate/0">มาตรการส่งเสริมความโปร่งใสและป้องกันการทุจริต</a>
                <a href="/backend/listcat/menu/24/cate/0">ประมวลจริยธรรม</a>
                <a href="/backend/listcat/menu/25/cate/0">นโยบายไม่รับของขวัญ</a>
                <a href="/backend/listcat/menu/26/cate/0">การเปิดโอกาสให้เกิดการมีส่วนร่วม</a>
            </div>
            <div class="menu-item has-submenu">
                อำนาจหน้าที่
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/listtexteditor/menu/27">เทศบาลตำบล</a>
                <a href="/backend/listtexteditor/menu/28">สำนักปลัด</a>
                <a href="/backend/listtexteditor/menu/29">กองคลัง</a>
                <a href="/backend/listtexteditor/menu/30">กองช่าง</a>
                <a href="/backend/listtexteditor/menu/31">กองการศึกษา</a>
                <a href="/backend/listtexteditor/menu/32">หน่วยตรวจสอบภายใน</a>
            </div>
            <a href="/backend/listcat/menu/33/cate/0">
                <div class="menu-item">แผนพัฒนาท้องถิ่น</div>
            </a>
            <div class="menu-item has-submenu">
                กฎหมายเเละระเบียบ
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/list/menu/34">กฎหมายที่เกี่ยวข้อง</a>
            </div>
            <div class="menu-item has-submenu">
                เมนูสำหรับประชาชน
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="#">รับเเจ้งเรื่องราวร้องเรียนร้องทุกข์</a>
                <a href="#">รับเเจ้งเรื่องราวร้องเรียนการทุจริต</a>
                {{-- <a href="35">รับเเจ้งเรื่องราวร้องเรียนร้องทุกข์</a>
                <a href="36">รับเเจ้งเรื่องราวร้องเรียนการทุจริต</a> --}}
                <a href="/backend/list/menu/37">รายงานผลสำรวจความพึงพอใจในการให้บริการ</a>
                <a href="/backend/listcat/menu/38/cate/0">คู่มืออื่นๆ</a>
                <a href="/backend/list/menu/39">เอกสารดาวน์โหลด</a>
                <a href="#">ยื่นคำร้องออนไลน์ E-service</a>
                <a href="/backend/list/menu/41">คำถามที่พบบ่อย</a>
            </div>
            <div class="menu-item has-submenu">
                ประกาศความเคลื่อนไหว
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu">
                <a href="/backend/list/menu/42">ประกาศจัดซื้อจัดจ้าง</a>
                <a href="/backend/list/menu/43">ผลประกาศจัดซื้อจัดจ้าง</a>
                <a href="/backend/list/menu/44">ประกาศราคากลาง</a>
            </div>
            <div class="menu-item has-submenu">
                แบนเนอร์
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu">
                <a href="/backend/banner/menu/45">แบนเนอร์แนะนำ</a>
                <a href="/backend/banner/menu/66">แบนเนอร์ภายนอก</a>
                <a href="/backend/banner/menu/67">แบนเนอร์ภายใน</a>
            </div>
            {{-- <a href="46"> --}}
            <a href="#">
                <div class="menu-item">POP UP</div>
            </a>
            <a href="/backend/slide/menu/47">
                <div class="menu-item">ภาพสไลด์</div>
            </a>
            <a href="/backend/slide/menu/48">
                <div class="menu-item">วิดีทัศน์</div>
            </a>
            <a href="/backend/slide/menu/49">
                <div class="menu-item">ป้ายประกาศ</div>
            </a>
            <a href="/backend/list/menu/50">
                <div class="menu-item">สารจากนายก</div>
            </a>
            <a href="/backend/listtexteditor/menu/51">
                <div class="menu-item">เจตจำนงสุจริตของผู้บริหาร</div>
            </a>
            <a href="/backend/list/menu/52">
                <div class="menu-item">กิจกรรม</div>
            </a>
            <a href="/backend/list/menu/53">
                <div class="menu-item">ข่าวประชาสัมพันธ์</div>
            </a>
            {{-- <a href="54"> --}}
            <a href="#">
                <div class="menu-item">แบบสำรวจความคิดเห็น</div>
            </a>
            {{-- <a href="55"> --}}
            <a href="#">
                <div class="menu-item">ติดต่อ</div>
            </a>
            {{-- <a href="56"> --}}
            <a href="#">
                <div class="menu-item">กระดานสนทนา</div>
            </a>

            <div class="menu-item has-submenu">
                โปรแกรมเพิ่มเติม
                <i class='bx bx-chevron-right chevron'></i>
            </div>
            <div class="submenu level-1">
                <a href="/backend/list/menu/57">การประเมินคุณธรรมและความโปร่งใส (ITA)</a>
                <a href="/backend/list/menu/58">การประเมินประสิทธิภาพภายใน (LPA)</a>
                <a href="/backend/list/menu/59">การจัดการองค์ความรู้ (KM)</a>
                <a href="/backend/listcat/menu/60/cate/0">รายงานกิจการสภา</a>
                <a href="/backend/list/menu/61">เอกสารเผยแพร่</a>
                <a href="/backend/listtexteditor/menu/62">ระบบสารสนเทศ</a>
                <a href="/backend/list/menu/63">ศูนย์พัฒนาเด็กเล็ก</a>
                <a href="/backend/list/menu/64">กองทุนหลักประกันสุขภาพ (สปสช.)</a>
                <a href="/backend/list/menu/65">แนะนำร้านอาหาร</a>
            </div>

        </div>
    </div>
    <div class="main-content">
        @yield('content')
    </div>

</body>
<script src="{{ asset('js/menu/main.js') }}"></script>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

</html>
