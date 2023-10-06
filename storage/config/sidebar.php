<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
            <img src="user_images/<?php echo $_SESSION['profile_picture'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['full_name']; ?></p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
           

            <li class="treeview" id="mnu_entry">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Dashboard</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="mi_registration"><a href="registration"><i class="fa fa-circle-o"></i>Magazijn</a></li>
                    <li id="mi_users"><a href="users"><i class="fa fa-circle-o"></i>Gebruikers</a></li>
                    
                </ul>
            </li>

            <li class="header">Uitloggen</li>
            <li>
                <a href="logout">
                    <i class="fa fa-circle-o text-aqua"></i> 
                    <span>Uitloggen</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>