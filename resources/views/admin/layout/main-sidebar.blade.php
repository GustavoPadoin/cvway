<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel -->
    <div class="user-panel">
      <!--<div class="pull-left image">
        <img src="" class="img-circle" alt="User Image">
      </div>-->
      <div class="pull-left info">
        <p style="font-size: 12px;">{{ Auth::user()->nome }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>

      <li>
        <a href="{{ route('login.sair') }}">
          <i class="fa fa-fw fa-sign-out"></i> <span>Sair</span>
        </a>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
