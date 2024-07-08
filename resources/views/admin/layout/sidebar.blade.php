<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
          <a class="app-brand-link" style="display: flex; align-items: center; justify-content: center;">
    <span class="app-brand-logo demo">
    <img class="image" border="0" src="{{ asset('images/logo.png') }}" width="50px" style="padding: 0px; color:#ffff;">

    </span>
</a>
            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none"> 
              <i class="bx bx-chevron-left bx-sm align-middle"></i> 
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item">
              <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
              </a>
            </li>

            <li class="menu-item">
              <a href="/customers" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Data Akun">Data Akun</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/produk" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Data Produk">Data Produk</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/penyewaan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Data Produk">Konfirmasi Penyewaan</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/pengembalian" class="menu-link">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Data Produk">Konfirmasi Pengembalian</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="/laporan" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Data Produk">Laporan</div>
              </a>
            </li>
          </ul>
        </aside>

        <script>
          // Mendapatkan URL saat ini
          var currentUrl = window.location.href;

          // Mengambil daftar elemen menu
          var menuItems = document.querySelectorAll('.menu-item');

          // Melakukan iterasi pada setiap elemen menu
          menuItems.forEach(function(item) {
              // Mendapatkan URL menu
              var menuUrl = item.querySelector('a').getAttribute('href');

              // Membandingkan URL menu dengan URL saat ini
              if (currentUrl.includes(menuUrl)) {
                  // Menambahkan kelas "active" pada menu yang sedang aktif
                  item.classList.add('active');
              }
          });
      </script>