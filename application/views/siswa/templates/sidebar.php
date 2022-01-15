  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url('assets/profil/').$this->session->userdata('foto') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?= $this->session->userdata('nama') ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="<?= base_url('index.php/siswa/dashboard') ?>">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/siswa/mapel') ?>">
            <i class="fa fa-book"></i> <span>Data Mata Pelajaran</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/siswa/tugas') ?>">
            <i class="fa fa-pencil"></i> <span>Data Tugas</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/siswa/riwayatabsensi') ?>">
            <i class="fa fa-edit"></i> <span>Absensi Saya</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/siswa/pengumuman') ?>">
            <i class="fa fa-columns"></i> <span>Pengumuman</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/siswa/profil') ?>">
            <i class="fa fa-user"></i> <span>Profil</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/home/logout') ?>" class="tombol-yakin" data-isidata="Ingin keluar dari sistem ini?">
            <i class="fa fa-sign-out"></i> <span>Sign Out</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->