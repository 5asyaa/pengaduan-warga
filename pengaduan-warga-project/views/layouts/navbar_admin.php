<div class="admin-layout">

    <aside class="admin-sidebar">
        <div class="admin-brand">
            <span class="brand-title">Pengaduan Warga</span>
        </div>

        <nav class="admin-menu">
            <div class="admin-menu-item active">
                <span class="menu-icon"></span>
                Dashboard
            </div>

            <div class="admin-menu-item">
                <span class="menu-icon"></span>
                Data Pengaduan Warga
            </div>
        </nav>
    </aside>

    <div class="admin-main">

        <header class="admin-header">
            <div class="admin-header-left">
                <h1>Dashboard Admin</h1>
                <p class="subtitle">Ringkasan aktivitas & data pengaduan warga</p>
            </div>

            <div class="admin-header-right">
                <span class="admin-role"><?= $_SESSION["role"] ?? "Admin" ?></span>
                <a href="/pengaduan-warga-project/public/logout.php" class="admin-logout-btn">Logout</a>
            </div>
        </header>

<aside class="admin-sidebar">

    <div class="admin-brand">
        <span class="brand-title">Pengaduan Warga</span>
    </div>

    <nav class="admin-menu">
        <div class="menu-section">
            <a class="admin-menu-item active" href="#">
                <span class="menu-icon"></span>
                Dashboard
            </a>

            <a class="admin-menu-item" href="#">
                <span class="menu-icon"></span>
                Data Pengaduan Warga
            </a>
        </div>
    </nav>

</aside>
