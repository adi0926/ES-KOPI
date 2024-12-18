<style>

To ensure that both the .nav-link and .submenu-toggle elements have the same padding, and are aligned correctly in your sidebar, we need to update your CSS. Specifically, the padding-left should be consistent across both classes.

You can adjust the padding in both the .nav-link and .submenu-toggle classes to achieve a consistent look.

Updated CSS:
css
Copy code
/* Ensure both nav-link and submenu-toggle have the same padding */
.nav-link, .submenu-toggle {
    padding-left: 15px;  /* Set the same padding for both */
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensures proper spacing between text and toggle icon */
    width: 100%; /* Ensure full width of the parent container */
}

/* Submenu styles */
.submenu {
    display: none;
    padding-left: 40px;  /* Adjust padding for submenu items */
}

/* Submenu toggle icon inline with menu text */
.submenu-toggle i {
    margin-left: 10px;  /* Add some margin to the icon for spacing */
    cursor: pointer;
    font-size: 14px; /* Adjust icon size */
}

/* Style for active items */
.active {
    font-weight: bold;
}
</style>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/admin/dashboard">
                <img class="admin_logo" src="{{ asset('frontend/img/logo/LOGO.jpeg') }}" alt="EsKopi">
            </a>
        </div>

        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/admin/dashboard">
            <img src="{{ asset('uploads/website-images/favicon.png') }}" alt="EsKopi">
            </a>
        </div>
            <ul class="sidebar-menu">
            @foreach ($menu as $menuItem)
                <li class="@if (Request::segment(2) == $menuItem->active_segment) active @endif">
                    
                    @if($menuItem->children->isEmpty())
                        <!-- No children, display a regular link -->
                        <a class="nav-link" href="{{ url($menuItem->url) }}">
                            <i class="fas {{ $menuItem->icon }}"></i>
                            <span>{{ $menuItem->nama_menu }}</span>
                        </a>
                    @else
                        <!-- Menu item has children, display with submenu toggle -->
                        <a class="submenu-toggle" href="javascript:void(0);">
                            <i class="fas {{ $menuItem->icon }}"></i>
                            <span>{{ $menuItem->nama_menu }}</span> <i class="fas fa-angle-down"></i>
                        </a>

                        
                    @endif

                    <!-- Submenu -->
                    @if($menuItem->children->isNotEmpty())
                        <ul class="submenu" style="display: none;">
                            @foreach($menuItem->children as $submenu)
                                <li class="@if (Request::segment(2) == $submenu->active_segment) active @endif">
                                    <a class="nav-link" href="{{ url($submenu->url) }}">
                                        <span>{{ $submenu->nama_menu }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>


        <ul class="sidebar-menu">
            
            <!-- <li class="@if (Request::segment(2) == 'banner') active @endif">
                <a class="nav-link" href="/admin/banner">
                    <i class="fas fa-swatchbook"></i><span>Banner</span>
                </a>
            </li> 
            <li class="@if (Request::segment(2) == 'peserta') active @endif">
                <a class="nav-link" href="/admin/peserta">
                    <i class="fas fa-users"></i><span>Peserta</span>
                </a>
            </li>   
            <li class="@if (Request::segment(2) == 'peserta-diklat') active @endif">
                <a class="nav-link" href="/admin/peserta-diklat">
                    <i class="fas fa-users"></i><span>Peserta Diklat</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'bank-soal') active @endif">
                <a class="nav-link" href="/admin/bank-soal">
                    <i class="fas fa-book"></i><span>Bank Soal</span>
                </a>
            </li> 
                     
             <li class="@if (Request::segment(2) == 'master-diklat') active @endif">
                <a class="nav-link" href="/admin/master-diklat">
                    <i class="fas fa-book"></i><span>Konten Diklat</span>
                </a>
            </li>    
             <li class="@if (Request::segment(2) == 'ujian') active @endif">
                <a class="nav-link" href="/admin/ujian">
                    <i class="fas fa-file"></i><span>Ujian</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'master-kategori-diklat') active @endif">
                <a class="nav-link" href="/admin/master-kategori-diklat">
                    <i class="fas fa-file"></i><span>Master Kategori Diklat</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'pretest') active @endif">
                <a class="nav-link" href="/admin/pretest">
                    <i class="fas fa-puzzle-piece"></i><span>Pretest</span>
                </a>
            </li>   
            <li class="@if (Request::segment(2) == 'postest') active @endif">
                <a class="nav-link" href="/admin/postest">
                    <i class="fas fa-puzzle-piece"></i><span>Postest</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'evaluasi-penyelenggara') active @endif">
                <a class="nav-link" href="/admin/evaluasi-penyelenggara">
                    <i class="fas fa-file"></i><span>Evaluasi Penyelenggara</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'evaluasi-pengajar') active @endif">
                <a class="nav-link" href="/admin/evaluasi-pengajar">
                    <i class="fas fa-file"></i><span>Evaluasi Pengajar</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'penilaian') active @endif">
                <a class="nav-link" href="/admin/penilaian">
                    <i class="fas fa-pen"></i><span>Penilaian</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'sertifikat') active @endif">
                <a class="nav-link" href="/admin/sertifikat">
                    <i class="fas fa-award"></i><span>E-Sertifikat</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'tanda-tangan-elektronik') active @endif">
                <a class="nav-link" href="/admin/tanda-tangan-elektronik">
                    <i class="fas fa-sign"></i><span>Tanda Tangan Elektronik</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'akun-zoom') active @endif">
                <a class="nav-link" href="/admin/akun-zoom">
                    <i class="fas fa-bullhorn"></i><span>Akun Zoom</span>
                </a>
            </li>  
            <li class="@if (Request::segment(2) == 'virtual-class') active @endif">
                <a class="nav-link" href="/admin/virtual-class">
                    <i class="fas fa-video"></i><span>Virtual Class</span>
                </a>
            </li>   
            <li class="@if (Request::segment(2) == 'media') active @endif">
                <a class="nav-link" href="/admin/media">
                    <i class="fas fa-video"></i><span>Media</span>
                </a>
            </li>  -->
        </ul>
    </aside>
</div>


<script>
    // Toggle submenu visibility on clicking the toggle icon
    document.querySelectorAll('.submenu-toggle').forEach(function (toggleButton) {
        toggleButton.addEventListener('click', function () {
            let submenu = toggleButton.closest('li').querySelector('.submenu');
            if (submenu.style.display === "none" || submenu.style.display === "") {
                submenu.style.display = "block"; // Show submenu
                toggleButton.querySelector('i').classList.toggle('fa-angle-down');
                toggleButton.querySelector('i').classList.toggle('fa-angle-up');
            } else {
                submenu.style.display = "none"; // Hide submenu
                toggleButton.querySelector('i').classList.toggle('fa-angle-down');
                toggleButton.querySelector('i').classList.toggle('fa-angle-up');
            }
        });
    });
</script>