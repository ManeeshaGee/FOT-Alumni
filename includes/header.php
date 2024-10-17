<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <h1 class="sitename">Alumni</h1>
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="index.php#hero">Home</a></li>
                <li><a href="index.php#about">About</a></li>
                <li><a href="index.php#gallery">Gallery</a></li>
                <li><a href="index.php#team">Members</a></li>
                <li>
                    <a href="news.php" <a href="news.php"
                        class="<?php echo basename($_SERVER['PHP_SELF']) == 'news.php' || basename($_SERVER['PHP_SELF']) == 'news-details.php' ? 'active' : ''; ?>">News</a>
                </li>
                <li><a href="index.php#contact">Contact</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>