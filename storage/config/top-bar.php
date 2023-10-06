<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>IT</b>M</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ITalent Magazijn</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="user_images/<?php echo $_SESSION['profile_picture'];?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['full_name'];?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                        <img src="user_images/<?php echo $_SESSION['profile_picture'];?>" class="img-circle" alt="User Image">
                            <p>
                            <?php echo $_SESSION['full_name'];?>
                                <small>Member since Nov. 2021</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="change_password" class="btn btn-default btn-flat">Change Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>