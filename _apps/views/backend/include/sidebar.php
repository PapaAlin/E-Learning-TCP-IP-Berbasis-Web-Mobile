      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            
            <li><a href="<?=base_url()?>" target="_blank"><i class="fa fa-desktop"></i> <span>Lihat Website</span></a></li>

            <li class="header">MENU</li>

            <li class="<?=$this->admin_class_menu->active("dashboard")?>"><a href="<?=base_url()?>adm/main"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

            <li class="<?=$this->admin_class_menu->active("users")?> treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i> <span>User / Karyawan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>adm/users"><i class="fa fa-list-alt"></i> Data User</a></li>
              </ul>
            </li>

            <li class="<?=$this->admin_class_menu->active("courses")?> treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i> <span>Course</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>adm/courses"><i class="fa fa-list-alt"></i> Daftar Course</a></li>
                <li><a href="<?=base_url()?>adm/courses/add"><i class="fa fa-plus-circle"></i> Tambah Course</a></li>
              </ul>
            </li>

            <li class="<?=$this->admin_class_menu->active("penilaian")?> treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i> <span>Penilaian</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>adm/penilaian"><i class="fa fa-list-alt"></i> Histori Laporan Penilaian</a></li>
              </ul>
            </li>

            <li class="<?=$this->admin_class_menu->active("admin")?> treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>adm/admins"><i class="fa fa-list-alt"></i> Daftar Admin</a></li>
                <li><a href="<?=base_url()?>adm/admins/add"><i class="fa fa-plus-circle"></i> Tambah Admin</a></li>
              </ul>
            </li>

            <li class="<?=$this->admin_class_menu->active("settings")?> treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?=base_url()?>adm/settings"><i class="fa fa-gears text-aqua"></i> Descriptions</a></li>
                <li><a href="<?=base_url()?>adm/settings/general"><i class="fa fa-gear text-aqua"></i> General</a></li>
              </ul>
            </li>

            <li class=""><a href="?s=reload"><i class="fa fa-refresh"></i> <span>reload</span></a></li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>