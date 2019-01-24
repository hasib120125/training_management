  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="{{{ Request::is('/')? 'active' : ''}}}">
          <a href="{{ url('/') }}">
            <i class="fa fa-columns"></i> <span>Dashboard</span>
          </a>
        </li>
        @role('admin')
        
        <li class="treeview {{{ Request::is('trainings')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-graduation-cap"></i>
            <span>Trainings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu"> 
            <li class="{{{ Request::is('trainings')? 'active' : ''}}}">
              <a href="{{ route('trainings.index') }}"><i class="fa fa-list-ol"></i>
                Trainings List</a>
            </li>
            <li class="{{{ Request::is('trainings')? 'active' : ''}}}">
              <a href="{{route('trainings.create')}}"><i class="fa fa-plus-square-o"></i>Add Training</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('training-types')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-object-group"></i>
            <span>Trainings Types</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-types') ? 'active' : ''}}}">
              <a href="{{ route('training-types.index') }}">
                <i class="fa fa-list"></i> <span>Types List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-types')? 'active' : ''}}}">
              <a href="{{ route('training-types.create')}}"><i class="fa fa-plus-square"></i>Add Types</a>
            </li>                                             
          </ul>
        </li>
     
        <li class="treeview {{{ Request::is('training-modes')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-film"></i>
            <span>Training Modes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-modes') ? 'active' : ''}}}">
              <a href="{{ route('training-modes.index') }}">
                <i class="fa fa-th-list"></i> <span>Modes List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-modes')? 'active' : ''}}}">
              <a href="{{ route('training-modes.create')}}"><i class="fa fa-plus-square"></i>Add Modes</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('training-system')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-tablet"></i>
            <span>Training System/Device</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-system') ? 'active' : ''}}}">
              <a href="{{ route('training-system.index') }}">
                <i class="fa fa-th-list"></i> <span>System/Device List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-system')? 'active' : ''}}}">
              <a href="{{ route('training-system.create')}}"><i class="fa fa-plus-square"></i>Add System/Device</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('training-brand')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-cube"></i>
            <span>Training Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-brand') ? 'active' : ''}}}">
              <a href="{{ route('training-brand.index') }}">
                <i class="fa fa-th-list"></i> <span>Brand List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-brand')? 'active' : ''}}}">
              <a href="{{ route('training-brand.create')}}"><i class="fa fa-plus-square"></i>Add Brand</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('training-audiences')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Training Audience</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-audiences') ? 'active' : ''}}}">
              <a href="{{ route('training-audiences.index') }}">
                <i class="fa  fa-list-alt"></i> <span>Audience List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-audiences')? 'active' : ''}}}">
              <a href="{{ route('training-audiences.create')}}"><i class="fa fa-plus-square"></i>Add Audience</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('training-users')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-battery-half"></i>
            <span>Training Assignments</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-users')? 'active' : ''}}}">
              <a href="{{ route('training-users.index') }}">
                <i class="fa fa-list"></i> <span>Assignments List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-users')? 'active' : ''}}}">
              <a href="{{ route('training-users.create')}}"><i class="fa fa-plus-square"></i>Add Assignments</a>
            </li>                                             
          </ul>
        </li>

        {{--< li class="treeview {{{ Request::is('training-audiences')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Training Audience</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-audiences') ? 'active' : ''}}}">
              <a href="{{ route('training-audiences.index') }}">
                <i class="fa  fa-list-alt"></i> <span>Audience List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-audiences')? 'active' : ''}}}">
              <a href="{{ route('training-audiences.create')}}"><i class="fa fa-plus-square"></i>Add Audience</a>
            </li>                                             
          </ul>
        </li> --}}

        


        <li class="treeview {{{ Request::is('training-targets')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-plane"></i>
            <span>Training Targets</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>          
          <ul class="treeview-menu">           
            <li class="{{{ Request::is('training-targets')? 'active' : ''}}}">
              <a href="{{ route('training-targets.index') }}">
                <i class="fa fa-th-list"></i> <span>Targets List</span>
              </a>
            </li>

            <li class="{{{ Request::is('training-targets')? 'active' : ''}}}">
              <a href="{{ route('training-targets.create')}}"><i class="fa fa-plus-square"></i>Add Targets</a>
            </li>                                             
          </ul>
        </li>


        <li class="{{{ Request::is('training-histories')? 'active' : ''}}}">
          <a href="{{ route('training-histories.index') }}">
            <i class="fa fa-history"></i> <span>Training History</span>
          </a>
        </li>
        <li class="{{{ Request::is('training-targets/status')? 'active' : ''}}}">
          <a href="{{ route('training-targets.status') }}">
            <i class="fa fa-history"></i> <span>Target Status</span>
          </a>
        </li>

        <li class="treeview {{{ Request::is('reports')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-signal"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{{ Request::is('reports')? 'active' : ''}}}">
              <a href="{{route('reports.topic-wise-report')}}">
                <i class="fa fa-line-chart"></i> Topic Wise</a>
            </li>
            <li class="{{{ Request::is('reports')? 'active' : ''}}}">
              <a href="{{route('reports.target-achievement-report')}}"><i class="fa fa-bar-chart"></i>Target & Achievement</a>
            </li>                                             
          </ul>
        </li>

        <li class="treeview {{{ Request::is('users')? 'active' : ''}}}">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{{ Request::is('users')? 'active' : ''}}}">
              <a href="{{ route('users.index') }}">
                <i class="fa fa-list"></i> <span>Users List</span>
              </a>
            </li>
            <li class="{{{ Request::is('users')? 'active' : ''}}}">
              <a href="{{route('users.create')}}"><i class="fa fa-plus-square-o"></i>Add User</a>
            </li>                                             
          </ul>
        </li>       
        @endrole

        @role('trainer')
        <li class="{{{ Request::is('training-users')? 'active' : ''}}}">
          <a href="{{ route('training-users.index') }}">
            <i class="fa fa-battery-half"></i> <span>Training Assignments</span>
          </a>
        </li>
        <li class="{{{ Request::is('training-histories')? 'active' : ''}}}">
          <a href="{{ route('training-histories.index') }}">
            <i class="fa  fa-bar-chart"></i> <span>Training History</span>
          </a>
        </li>
        <li class="{{{ Request::is('training-targets/status')? 'active' : ''}}}">
          <a href="{{ route('training-targets.status') }}">
            <i class="fa fa-history"></i> <span>Target Status</span>
          </a>
        </li>
        {{-- <li class="{{{ Request::is('top-performance')? 'active' : ''}}}">
          <a href="{{ route('top-performance.index') }}">
            <i class="fa fa-align-center"></i> <span>Top Performance</span>
          </a>
        </li> --}}
        @endrole
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
