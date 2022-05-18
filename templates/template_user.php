<li class="dropdown">
    <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <div class="avatar me-1">
            <img src="assets/images/avatar/avatar-s-1.png" alt="" srcset="">
        </div>
        <div class="d-none d-md-block d-lg-inline-block">Olá, <?php echo $_SESSION['username']; ?> </div>
    </a>
    <div class="dropdown-menu dropdown-menu-end">
        <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="logout.php"><i data-feather="log-out"></i> Logout</a>
    </div>
</li>