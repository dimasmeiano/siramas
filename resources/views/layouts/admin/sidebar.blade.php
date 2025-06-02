<div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="../../../dist/assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline">Alexander Pierce</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="../../../dist/assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2023</small>
                  </p>
                </li>
                <!--end::User Image-->
                <li class="user-footer">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                  <a href="#" class="btn btn-default btn-flat float-end"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Sign out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
<!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="#" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{ asset('dist/assets/img/logoRemas.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">SIRAMAS</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('members.index') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Data Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('organization_profile.edit') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Profile Organisasi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pengurus.index') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Pengurus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('program-kerja.index') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Program Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('keuangan.index') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Keuangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Admin Web
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Kategori</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('artikel.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Arikel Berita</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('comment.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Komentar</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('sosial-media.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Sosial Media</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('slider.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Sliders</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('marquee.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Teks Berjalan</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('visitor.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Pengunjung</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ route('lpj.index') }}" class="nav-link active">
                  <i class="nav-icon bi bi-person-fill"></i>
                  <p>Laporan PertanggungJawaban</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Absensi
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('kegiatan.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Kegiatan</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('absensi.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Absensi</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('notulen.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Notulen</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Galeri Program
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                    @foreach($allPrograms as $program)
                        <li class="nav-item">
                            <a href="{{ route('program_galeri.index', $program->id) }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{ $program->nama }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link ">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Kesekretaritan
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('dashboard-kesekretariatan.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Dashboard</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('inventaris.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Inventaris</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('buku-tamu.index') }}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Buku Tamu</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->