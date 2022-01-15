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
          <a href="<?= base_url('index.php/guru/dashboard') ?>">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/guru/mapel') ?>">
            <i class="fa fa-book"></i> <span>Data Mata Pelajaran</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/guru/tugas') ?>">
            <i class="fa fa-pencil"></i> <span>Data Tugas</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Data Absensi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('index.php/guru/absensi') ?>"><i class="fa fa-circle-o"></i> Absensi</a></li>
            <li><a href="<?= base_url('index.php/guru/riwayatabsensi') ?>"><i class="fa fa-circle-o"></i> Riwayat Absensi</a></li>
          </ul>
        </li>
        <li>
          <a href="<?= base_url('index.php/guru/siswa') ?>">
            <i class="fa fa-graduation-cap"></i> <span>Data Siswa</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/guru/pengumuman') ?>">
            <i class="fa fa-columns"></i> <span>Pengumuman</span>
          </a>
        </li>
        <li>
          <a href="<?= base_url('index.php/guru/profil') ?>">
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