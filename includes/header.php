<?php
$base_url = "http://" . $_SERVER['HTTP_HOST'] . "/lksa_nh/";

$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
if ($current_dir == 'lksa_nh') {
    $current_page = 'index.php';
}

$dashboard_active = ($current_page == 'index.php' || strpos($current_page, 'dashboard_') !== false) ? 'active' : '';
$lksa_active = ($current_page == 'lksa.php' || $current_page == 'tambah_lksa.php' || $current_page == 'tambah_pimpinan.php' || $current_page == 'edit_lksa.php') ? 'active' : '';
$users_active = ($current_page == 'users.php' || $current_page == 'tambah_pengguna.php' || $current_page == 'edit_pengguna.php' || $current_page == 'arsip_users.php') ? 'active' : '';
$donatur_active = ($current_page == 'donatur.php' || $current_page == 'tambah_donatur.php' || $current_page == 'edit_donatur.php' || $current_page == 'arsip_donatur.php') ? 'active' : '';
$sumbangan_active = ($current_page == 'sumbangan.php' || $current_page == 'tambah_sumbangan.php' || $current_page == 'detail_sumbangan.php') ? 'active' : '';
$verifikasi_active = ($current_page == 'verifikasi-donasi.php' || $current_page == 'edit_sumbangan.php' || $current_page == 'wa-blast-form.php') ? 'active' : '';
$kotak_amal_active = ($current_page == 'kotak-amal.php' || $current_page == 'tambah_kotak_amal.php' || $current_page == 'edit_kotak_amal.php' || $current_page == 'arsip_kotak_amal.php') ? 'active' : '';
$dana_kotak_amal_active = ($current_page == 'dana-kotak-amal.php' || $current_page == 'edit_dana_kotak_amal.php') ? 'active' : '';
$laporan_active = ($current_page == 'laporan.php' || $current_page == 'tambah_laporan.php' || $current_page == 'detail_laporan.php') ? 'active' : ''; // Tambahkan Laporan
$export_menu_active = ($current_page == 'export_data_menu.php') ? 'active' : '';

// --- NAVIGATION LINKS DEFINITION (FOR OFF-CANVAS MENU) ---
$nav_links = [];
$jabatan = $_SESSION['jabatan'] ?? '';
$id_lksa = $_SESSION['id_lksa'] ?? '';
$is_pimpinan_pusat = ($jabatan == 'Pimpinan' && $id_lksa == 'Pimpinan_Pusat');

// GROUP 1: General & Management
$nav_links['General'][] = ['href' => $base_url . 'index.php', 'icon' => 'fas fa-tachometer-alt', 'text' => 'Dashboard', 'active' => $dashboard_active];

if ($is_pimpinan_pusat) {
    $nav_links['General'][] = ['href' => $base_url . 'pages/lksa.php', 'icon' => 'fas fa-building', 'text' => 'Manajemen LKSA', 'active' => $lksa_active];
}

if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA') {
    $nav_links['General'][] = ['href' => $base_url . 'pages/users.php', 'icon' => 'fas fa-users', 'text' => 'Manajemen Pengguna', 'active' => $users_active];
}

// GROUP 2: ZIS & Donatur
if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA' || $jabatan == 'Pegawai') {
    $nav_links['ZIS'][] = ['href' => $base_url . 'pages/donatur.php', 'icon' => 'fas fa-hand-holding-heart', 'text' => 'Manajemen Donatur ZIS', 'active' => $donatur_active];
    $nav_links['ZIS'][] = ['href' => $base_url . 'pages/sumbangan.php', 'icon' => 'fas fa-funnel-dollar', 'text' => 'Manajemen Sumbangan', 'active' => $sumbangan_active];
    if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA') {
        $nav_links['ZIS'][] = ['href' => $base_url . 'pages/verifikasi-donasi.php', 'icon' => 'fas fa-check-double', 'text' => 'Verifikasi Donasi', 'active' => $verifikasi_active];
    }
}

// GROUP 3: Kotak Amal
if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA' || $jabatan == 'Petugas Kotak Amal') {
    $nav_links['Kotak Amal'][] = ['href' => $base_url . 'pages/kotak-amal.php', 'icon' => 'fas fa-box', 'text' => 'Manajemen Kotak Amal', 'active' => $kotak_amal_active];
    $nav_links['Kotak Amal'][] = ['href' => $base_url . 'pages/dana-kotak-amal.php', 'icon' => 'fas fa-coins', 'text' => 'Pengambilan Kotak Amal', 'active' => $dana_kotak_amal_active];
}

// GROUP 4: Laporan & Export
if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA') {
    $nav_links['Lainnya'][] = ['href' => $base_url . 'pages/laporan.php', 'icon' => 'fas fa-inbox', 'text' => 'Laporan Pengguna', 'active' => $laporan_active];
    $nav_links['Lainnya'][] = ['href' => $base_url . 'pages/export_data_menu.php', 'icon' => 'fas fa-file-export', 'text' => 'Export Data', 'active' => $export_menu_active];
}

// --- BOTTOM NAV DEFINITION (Max 5 items) ---
$bottom_nav_items = [];
$bottom_nav_items[] = ['href' => $base_url . 'index.php', 'icon' => 'fas fa-home', 'text' => 'Home', 'active' => $dashboard_active];

if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA') {
    $bottom_nav_items[] = ['href' => $base_url . 'pages/verifikasi-donasi.php', 'icon' => 'fas fa-check-double', 'text' => 'Verifikasi', 'active' => $verifikasi_active];
    $bottom_nav_items[] = ['href' => $base_url . 'pages/users.php', 'icon' => 'fas fa-users', 'text' => 'Pengguna', 'active' => $users_active];
} elseif ($jabatan == 'Pegawai') {
    $bottom_nav_items[] = ['href' => $base_url . 'pages/sumbangan.php', 'icon' => 'fas fa-funnel-dollar', 'text' => 'Sumbangan', 'active' => $sumbangan_active];
    $bottom_nav_items[] = ['href' => $base_url . 'pages/donatur.php', 'icon' => 'fas fa-hand-holding-heart', 'text' => 'Donatur', 'active' => $donatur_active];
} elseif ($jabatan == 'Petugas Kotak Amal') {
    $bottom_nav_items[] = ['href' => $base_url . 'pages/kotak-amal.php', 'icon' => 'fas fa-box', 'text' => 'Kotak Amal', 'active' => $kotak_amal_active];
    $bottom_nav_items[] = ['href' => $base_url . 'pages/dana-kotak-amal.php', 'icon' => 'fas fa-coins', 'text' => 'Pengambilan', 'active' => $dana_kotak_amal_active];
}

// Add More Menu / Lapor (Always last)
if (isset($_SESSION['loggedin']) && isset($_SESSION['id_user'])) {
    if ($jabatan == 'Pimpinan' || $jabatan == 'Kepala LKSA') {
         $bottom_nav_items[] = ['href' => '#', 'icon' => 'fas fa-ellipsis-h', 'text' => 'Lainnya', 'active' => ''];
    } else {
         $bottom_nav_items[] = ['href' => $base_url . 'pages/tambah_laporan.php', 'icon' => 'fas fa-bullhorn', 'text' => 'Lapor', 'active' => $laporan_active];
         $bottom_nav_items[] = ['href' => '#', 'icon' => 'fas fa-ellipsis-h', 'text' => 'Lainnya', 'active' => ''];
    }
}


// --- SIDEBAR LOGIC (Only used for Desktop/Tablet) ---
$show_sidebar = false;
$sidebar_html = '';
$is_internal_user = false;

if (isset($_SESSION['loggedin']) && isset($_SESSION['id_user'])) {

    if (isset($conn)) {
        $id_user = $_SESSION['id_user'];
        $user_info_sql = "SELECT Nama_User, Foto, Jabatan FROM User WHERE Id_user = '$id_user'";
        // Using direct query here as it's for display info only in header
        $user_info = $conn->query($user_info_sql)->fetch_assoc(); 
        $nama_user = $user_info['Nama_User'] ?? 'Pengguna';
        $foto_user = $user_info['Foto'] ?? '';
        $jabatan = $user_info['Jabatan'] ?? '';
        $is_internal_user = true;
        $foto_path = $foto_user ? $base_url . 'assets/img/' . $foto_user : $base_url . 'assets/img/yayasan.png';

        // $sidebar_stats is assumed to be defined in the main dashboard/page file
        $sidebar_stats = $sidebar_stats ?? '';

        // Tampilkan sidebar HANYA di desktop (di atas 768px)
        if ($current_page != 'dashboard_donatur.php' && $current_page != 'dashboard_pemilik_kotak_amal.php') {
             $show_sidebar = true; // Sidebar akan disembunyikan via CSS di mobile
        }


        if ($show_sidebar) {
            ob_start();
            ?>
            <div class="sidebar-wrapper">
                <img src="<?php echo htmlspecialchars($foto_path); ?>" alt="Foto Profil" class="profile-img">

                <p class="welcome-text-sidebar">Selamat Datang,<br>
                    <strong><?php echo htmlspecialchars($nama_user); ?></strong> (<?php echo htmlspecialchars($jabatan); ?>)
                </p>

                <div class="sidebar-util-btns">
                    <a href="<?php echo $base_url; ?>pages/edit_pengguna.php?id=<?php echo htmlspecialchars($id_user); ?>"
                        class="btn btn-primary sidebar-small-btn" title="Edit Profil"><i class="fas fa-edit"></i> Profil</a>
                    <a href="<?php echo $base_url; ?>login/logout.php" class="btn btn-danger sidebar-small-btn" title="Logout"><i class="fas fa-sign-out-alt"></i>
                        Logout</a>
                </div>

                <?php if ($jabatan != 'Pimpinan') { ?>
                <a href="<?php echo $base_url; ?>pages/tambah_laporan.php" class="btn btn-warning"
                    style="margin-top: 15px; margin-bottom: 15px; background-color: #F97316; color: white; width: 100%; box-sizing: border-box;">
                    <i class="fas fa-bullhorn"></i> Lapor ke Atasan
                </a>
                <?php } ?>

                <hr>
                
                <?php echo $sidebar_stats; // Display dynamic stats ?>
                
                <h2>Menu Navigasi</h2>
                
                <?php foreach ($nav_links as $group_title => $links): ?>
                    <hr class="nav-divider">
                    <?php if ($group_title != 'General') { ?>
                        <h3><?php echo htmlspecialchars($group_title); ?></h3>
                    <?php } ?>
                    <div class="sidebar-nav-group">
                        <?php foreach ($links as $link): ?>
                            <a href="<?php echo $link['href']; ?>" class="sidebar-nav-item <?php echo $link['active']; ?>">
                                <i class="<?php echo $link['icon']; ?>"></i> <?php echo $link['text']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
            $sidebar_html = ob_get_clean();
        }
    }
}
// --- END SIDEBAR LOGIC ---
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Give Track - Sistem Informasi Pengelolaan ZISWAF & Kotak Amal</title> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        // JavaScript for Off-Canvas Menu Toggle
        function toggleOffCanvas() {
            const menu = document.getElementById('offCanvasMenu');
            const overlay = document.getElementById('offCanvasOverlay');
            menu.classList.toggle('open');
            overlay.classList.toggle('open');
            document.body.style.overflow = menu.classList.contains('open') ? 'hidden' : 'auto';
        }
    </script>
    <style>
        :root {
            --primary-color: #1F2937; /* Dark Navy/Slate (Base/Dark) */
            --secondary-color: #06B6D4; /* Aqua/Cyan (Accent/Highlight) */
            --tertiary-color: #F9FAFB; /* Soft Background (Baru) */
            --text-dark: #1F2937; /* Dark Slate Gray for general text */
            --text-light: #fff;
            --bg-light: #F9FAFB; /* Soft Background (Baru) */
            --border-color: #E5E7EB; /* Light border */
            --form-bg: #FFFFFF;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            background-color: var(--bg-light);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px; /* Diperkecil */
            margin: 0 auto;
            padding: 20px;
        }

        /* Revised Header Styles */
        .header {
            padding: 20px 30px; /* Ditingkatkan untuk memberi ruang lebih */
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--form-bg);
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); /* Shadow lebih kuat */
        }
        
        .header-logo-section {
            text-align: left;
            line-height: 1.2;
            padding-top: 5px;
            border-left: 5px solid var(--secondary-color); /* Tambah aksen border di kiri */
            padding-left: 15px;
            flex-grow: 1; /* Make logo area flexible */
        }
        
        .header-mobile-menu-btn {
            display: none; /* Default hidden on desktop */
            background: none;
            border: none;
            color: var(--primary-color);
            font-size: 1.8em;
            padding: 10px;
            cursor: pointer;
        }


        .header-slogan-top {
            font-size: 0.85em; /* Sedikit diperbesar */
            color: #4B5563; /* Gray gelap */
            display: block; 
            margin: 0;
            font-weight: 600;
        }

        .header-title-main {
            margin: 5px 0 0 0; /* Jarak antara slogan atas dan logo */
            font-size: 2.2em;
            font-weight: 900;
            font-family: 'Montserrat', sans-serif;
            color: var(--primary-color);
        }

        .header-logo-img {
            height: 45px; /* Sedikit dikecilkan agar seimbang dengan padding header */
            width: auto;
            margin: 0;
            padding: 0;
            vertical-align: middle;
        }
        
        .header-slogan-bottom {
            font-size: 0.75em; /* Sedikit diperbesar */
            color: #6B7280; 
            display: block; 
            margin: 0;
            font-style: italic;
        }
        /* End Revised Header Styles */


        .content {
            padding: 30px 40px; /* Dikecilkan untuk simetri */
            background-color: var(--form-bg);
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            /* NEW: Re-enable original style and add flex for sidebar */
            margin-top: 15px; /* Dikecilkan */
            display: flex;
            gap: 30px; /* Dikecilkan */
            align-items: flex-start;
        }

        .btn {
            padding: 10px 20px; /* Dikecilkan */
            border: none;
            cursor: pointer;
            text-decoration: none;
            border-radius: 8px; /* Dikecilkan */
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-block;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background: var(--primary-color);
            color: var(--text-light);
        }

        .btn-success {
            background: #10B981; /* Emerald Green */
            color: white;
        }
        
        .btn-warning {
            background: #F97316; /* Orange/Warning */
            color: white;
        }

        .btn-danger {
            background: #EF4444; /* Red */
            color: white;
        }

        .btn-cancel {
            background: #6B7280; /* Gray-500 */
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px); /* Dikecilkan */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Dikecilkan */
        }
        
        /* Removed unused .summary-card styles */

        .dashboard-title {
            font-size: 2.0em; /* Dikecilkan */
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 10px; /* Dikecilkan */
            font-family: 'Montserrat', sans-serif;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 8px; /* Dikecilkan */
        }

        .welcome-text {
            font-size: 1.2em; /* Dikecilkan */
            font-weight: 600;
            color: #555;
            margin-top: 0;
            margin-bottom: 20px; /* Dikecilkan */
        }

        /* Menghilangkan CSS untuk top-nav yang sudah tidak ada */
        .top-nav {
            display: none; 
        }

        .nav-item {
            display: none;
        }
        /* Akhir Penghilangan CSS */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px; /* Dikecilkan */
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05); /* Dikecilkan */
            border-radius: 10px; /* Dikecilkan */
            overflow: hidden;
            border: 1px solid var(--border-color);
            font-size: 0.95em; /* Dikecilkan */
        }

        th,
        td {
            text-align: left;
            padding: 12px; /* Dikecilkan */
            border-bottom: 1px solid var(--border-color); 
        }

        thead tr {
            background-color: var(--primary-color); /* Dark header */
            color: var(--text-light);
            font-weight: 600;
            border-bottom: 2px solid var(--secondary-color);
        }
        
        thead th:first-child {
            border-top-left-radius: 10px;
        }
        
        thead th:last-child {
            border-top-right-radius: 10px;
        }

        tbody tr:nth-child(even) {
            background-color: #FDFDFD; 
        }
        
        tbody tr:hover {
            background-color: #F3F4F6; /* Light gray on hover */
        }
        
        /* Ensure the last row does not have a bottom border if it's the only one */
        tbody tr:last-child td {
            border-bottom: none;
        }

        .form-container {
            background-color: var(--form-bg);
            padding: 30px; /* Dikecilkan */
            border-radius: 12px; /* Dikecilkan */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            max-width: 700px; /* Dikecilkan */
            margin: 0 auto;
        }

        .form-section {
            margin-bottom: 25px; /* Dikecilkan */
        }

        .form-section h2 {
            border-bottom: 2px solid var(--secondary-color); /* Aqua/Cyan under header */
            padding-bottom: 8px; /* Dikecilkan */
            margin-bottom: 15px; /* Dikecilkan */
            color: var(--primary-color);
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.4em;
        }

        .form-group {
            margin-bottom: 15px; /* Dikecilkan */
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px; /* Dikecilkan */
            border: 1px solid var(--border-color);
            border-radius: 8px; /* Dikecilkan */
            box-sizing: border-box;
            font-size: 0.95em; /* Dikecilkan */
            font-family: 'Open Sans', sans-serif;
            transition: border-color 0.3s;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: var(--secondary-color); /* Highlight on focus */
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.3); /* Adjusted for Aqua/Cyan */
            outline: none;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Dikecilkan */
            gap: 15px; /* Dikecilkan */
        }

        .form-actions {
            display: flex;
            gap: 10px; /* Dikecilkan */
            justify-content: flex-end;
            margin-top: 25px; /* Dikecilkan */
        }
        
        /* Removed unused .summary-card styles */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Dikecilkan */
            gap: 20px; /* Dikecilkan */
            margin-bottom: 25px; /* Dikecilkan */
        }
        
        /* --- NEW STYLES FOR STATS CARD ELEGANCE --- */
        .stats-card {
            background-color: #fff;
            border-radius: 12px;
            padding: 20px;
            text-align: left; /* Layout Horizontal */
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid var(--border-color); 
            border-left: 5px solid; /* Use left border for color accent */
            display: flex;
            flex-direction: row; 
            justify-content: space-between;
            align-items: center;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-card i {
            font-size: 2.5em; /* Ikon besar */
            margin-bottom: 0;
            flex-shrink: 0;
            padding-right: 15px;
            opacity: 0.8; /* Sedikit transparan */
        }
        
        .stats-card-content {
            flex-grow: 1;
            text-align: right; /* Angka di kanan */
        }

        .stats-card h3 {
            margin: 0 0 5px 0;
            font-size: 0.9em; 
            color: #555; /* Warna redup untuk judul */
            font-weight: 600;
        }

        .stats-card .value {
            font-size: 1.8em; /* Angka besar dan menonjol */
            font-weight: 800;
            margin: 0;
            line-height: 1.1;
        }
        
        /* New large total card style */
        .stats-card-total-large {
            background-color: var(--primary-color); /* Deep Navy background */
            color: var(--text-light);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-top: 15px;
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .stats-card-total-large h3 {
            color: var(--text-light);
            font-size: 1.4em;
            margin-bottom: 5px;
        }
        .stats-card-total-large i {
            font-size: 3.0em;
            color: var(--secondary-color); /* Aqua/Cyan */
            margin-bottom: 10px;
        }
        .stats-card-total-large .value {
            color: var(--secondary-color); /* Aqua/Cyan highlight untuk total */
            font-size: 3.0em; 
            font-weight: 900;
            margin-top: 5px;
        }
        /* --- END NEW STYLES --- */


        /* NEW CARD COLOR SCHEME */
        /* Aksen: Aqua/Deep Navy/Emerald/Indigo/Orange */
        .card-lksa { border-color: #06B6D4; } .card-lksa .value { color: #06B6D4; } .card-lksa i { color: #06B6D4; }
        .card-user { border-color: #1F2937; } .card-user .value { color: #1F2937; } .card-user i { color: #1F2937; }
        .card-donatur { border-color: #10B981; } .card-donatur .value { color: #10B981; } .card-donatur i { color: #10B981; } /* Emerald Green */
        .card-sumbangan { border-color: #6366F1; } .card-sumbangan .value { color: #6366F1; } .card-sumbangan i { color: #6366F1; } /* Indigo */
        .card-kotak-amal { border-color: #F97316; } .card-kotak-amal .value { color: #F97316; } .card-kotak-amal i { color: #F97316; } /* Orange */
        .card-total { border-color: #EF4444; } .card-total .value { color: #EF4444; } .card-total i { color: #EF4444; }

        /* === NEW SIDEBAR STYLES (Disesuaikan untuk Layout 1 Kolom Utama) === */
        .sidebar-wrapper {
            width: 220px; /* Dikecilkan */
            flex-shrink: 0;
            padding: 15px 0; /* Dikecilkan */
            text-align: center;
            border-right: 1px solid var(--border-color);
            padding-right: 20px; /* Dikecilkan */
        }

        .main-content-area {
            flex-grow: 1;
            /* Konten utama dashboard */
        }

        .profile-img {
            width: 80px; /* Dikecilkan dari 100px */
            height: 80px; /* Dikecilkan dari 100px */
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #E5E7EB; /* Border tipis dan lebih lembut */
            margin-bottom: 5px; 
            box-shadow: none; /* Dihapus */
        }

        .welcome-text-sidebar {
            font-size: 0.9em; /* Dikecilkan dari 1.0em */
            font-weight: 500;
            margin: 5px auto 10px auto; /* Disesuaikan */
            color: #6B7280; /* Warna abu-abu yang lebih lembut */
            line-height: 1.4;
        }
        /* Style untuk nama pengguna (yang ada di dalam strong tag) */
        .welcome-text-sidebar strong {
            font-weight: 700; 
            color: var(--primary-color);
            display: block; /* Memastikan nama di baris baru */
            font-size: 1.1em;
            margin-top: -3px;
        }

        /* NEW UTILITY BUTTON STYLES for Sidebar */
        .sidebar-util-btns {
            display: flex;
            justify-content: space-between;
            gap: 10px; 
            margin-bottom: 15px; 
        }

        .sidebar-small-btn {
            /* Icon-only button styles */
            padding: 10px; 
            width: 45%; 
            text-align: center;
            font-size: 1.1em; 
            border-radius: 8px; 
            display: flex; 
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            line-height: 1; 
            min-width: 40px; 
            max-width: 100px;
        }

        .sidebar-small-btn i {
            margin-right: 0 !important; 
        }
        /* END NEW UTILITY BUTTON STYLES */

        /* NEW NAVIGATION MENU STYLES */
        .sidebar-nav-item {
            display: flex;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            padding: 10px 12px;
            text-align: left;
            text-decoration: none;
            color: var(--primary-color); 
            border-radius: 6px;
            margin-top: 5px;
            transition: background-color 0.2s, color 0.2s;
            font-size: 0.95em;
            font-weight: 600;
            line-height: 1.2;
        }
        .sidebar-nav-item:first-of-type {
             margin-top: 10px; /* Jarak dari header/hr Menu Navigasi */
        }
        .sidebar-nav-item i {
            margin-right: 10px;
            font-size: 1.1em;
            color: #9CA3AF; /* Light gray icon color */
            transition: color 0.2s;
            /* FIX: Ensure Font Awesome font loads for the icon element */
            font-family: 'Font Awesome 6 Free'; /* Primary Font Awesome 6 font */
            font-weight: 900; /* Ensure solid icons (fas) use the correct weight */
        }
        .sidebar-nav-item:hover {
            background-color: #E5E7EB; /* Lighter background on hover */
            color: var(--primary-color);
        }
        .sidebar-nav-item.active {
            background-color: var(--secondary-color); /* Active background color */
            color: var(--primary-color); /* Active text color */
            font-weight: 700;
        }
        .sidebar-nav-item.active i {
            color: var(--primary-color); /* Active icon color matches text */
        }
        /* Penyesuaian untuk grouping */
        .sidebar-nav-group {
            margin-bottom: 10px;
        }
        .nav-divider {
            margin: 15px 0 10px 0;
            border: 0;
            border-top: 1px solid var(--border-color);
        }

        /* END NEW NAVIGATION MENU STYLES */

        .sidebar-wrapper .btn {
            width: 100%;
            max-width: 200px; /* FIX: Menyesuaikan lebar dengan content area (220px - 20px padding kanan) */
            margin: 8px auto 0 auto; /* FIX: Ganti margin-top dan tambahkan auto untuk centering */
            font-size: 0.9em; /* Dikecilkan */
            box-sizing: border-box; /* FIX: Pastikan padding termasuk dalam lebar */
        }
        
        .sidebar-wrapper h2, .sidebar-wrapper h3 {
            font-size: 1.1em;
            font-weight: 700;
            color: var(--primary-color);
            margin-top: 15px;
            margin-bottom: 5px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 5px;
            text-align: left;
        }
        .sidebar-wrapper h3 {
            font-size: 0.95em;
            font-weight: 600;
            border-bottom: none;
            padding-bottom: 0;
            margin-top: 10px;
            color: #6B7280;
        }

        .sidebar-wrapper hr {
            margin: 15px 0; /* Dikecilkan */
            border: 0;
            border-top: 1px solid var(--border-color);
        }
        
        /* FOOTER STYLES (MODERN) */
        .footer-main {
            background-color: #F0F4F8; /* Warna abu-abu muda yang lembut */
            padding: 15px 0; /* Padding vertikal sedikit dikurangi */
            text-align: center;
            width: 100%;
            box-sizing: border-box;
            border-top: 4px solid var(--secondary-color); /* Aksen warna Cyan yang kuat */
            margin-top: 30px; /* Jarak lebih besar dari konten utama */
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.03); /* Sedikit bayangan di atas */
        }

        .footer-content {
            max-width: 1200px; 
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-main p {
            margin: 3px 0;
            font-size: 0.8em; /* Ukuran font lebih kecil */
            color: #4B5563; /* Warna gelap yang nyaman */
            font-weight: 500;
        }
        /* END FOOTER STYLES */

        /* === MEDIA QUERIES UNTUK RESPONSIVENESS === */
        
        /* Perubahan utama untuk tablet (768px - 1024px) */
        @media (max-width: 1024px) {
            .content {
                gap: 20px; /* Dikecilkan */
                padding: 20px; /* Dikecilkan */
            }
            .sidebar-wrapper {
                width: 180px; /* Dikecilkan */
                padding-right: 15px; /* Dikecilkan */
            }
            
            .main-content-area {
                overflow-x: auto; /* Memungkinkan gulir horizontal untuk konten lebar (misalnya tabel) */
                padding-bottom: 5px; 
            }
        }
        
        /* Perubahan untuk perangkat mobile (di bawah 768px) */
        @media (max-width: 768px) {
            
            /* Sembunyikan sidebar dan panggil gaya dari Bottom Nav/Off-Canvas */
            .sidebar-wrapper {
                display: none !important;
            }
            
            .header {
                padding: 10px 15px;
            }
            
            .header-logo-section {
                padding-left: 10px;
            }
            
            .header-title-main {
                font-size: 1.8em;
            }
            .header-logo-img {
                height: 35px;
            }
            
            /* Adjust content area to account for bottom bar */
            .container {
                padding-bottom: 80px; /* Space for the bottom nav */
            }

            .content {
                flex-direction: column;
                padding: 15px; /* Dikecilkan */
                gap: 15px; /* Dikecilkan */
            }
            
            .main-content-area {
                width: 100%;
                overflow-x: auto; /* Memastikan tabel bisa di-scroll di mobile */
            }

            /* Show Hamburger button in the header */
            .header-mobile-menu-btn {
                display: block !important;
            }
            
            /* Show bottom nav */
            .bottom-nav {
                display: flex;
            }
            
            /* Footer padding fix */
            .footer-main {
                padding-bottom: 70px; /* Ensure footer content is above bottom nav */
            }
        }
        /* END NEW SIDEBAR STYLES */
    </style>
</head>

<body>
    
    <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['id_user'])) { ?>
    <div class="off-canvas-overlay" id="offCanvasOverlay" onclick="toggleOffCanvas()"></div>
    <div class="off-canvas-menu" id="offCanvasMenu">
        
        <button class="off-canvas-close" onclick="toggleOffCanvas()"><i class="fas fa-times"></i></button>

        <div style="text-align: center; margin-bottom: 20px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
            <img src="<?php echo htmlspecialchars($foto_path); ?>" alt="Foto Profil" class="profile-img" style="width: 70px; height: 70px;">
            <p class="welcome-text-sidebar" style="margin: 5px 0;">
                <strong><?php echo htmlspecialchars($nama_user); ?></strong><br>
                (<?php echo htmlspecialchars($jabatan); ?>)
            </p>
            <div class="sidebar-util-btns" style="justify-content: center; max-width: 250px; margin: 0 auto;">
                <a href="<?php echo $base_url; ?>pages/edit_pengguna.php?id=<?php echo htmlspecialchars($_SESSION['id_user']); ?>"
                    class="btn btn-primary sidebar-small-btn" style="width: 100%; max-width: 120px;" title="Edit Profil"><i class="fas fa-edit"></i> Edit Profil</a>
                <a href="<?php echo $base_url; ?>login/logout.php" class="btn btn-danger sidebar-small-btn" style="width: 100%; max-width: 120px;" title="Logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
            <?php if ($jabatan != 'Pimpinan') { ?>
                <a href="<?php echo $base_url; ?>pages/tambah_laporan.php" class="btn btn-warning"
                    style="margin-top: 15px; background-color: #F97316; color: white; width: 100%;">
                    <i class="fas fa-bullhorn"></i> Lapor ke Atasan
                </a>
            <?php } ?>
        </div>
        
        <?php foreach ($nav_links as $group_title => $links): ?>
            <hr class="nav-divider">
            <?php if ($group_title != 'General') { ?>
                <h3 style="font-size: 1.1em; color: #1F2937; margin-top: 10px;"><?php echo htmlspecialchars($group_title); ?></h3>
            <?php } ?>
            <div class="sidebar-nav-group">
                <?php foreach ($links as $link): ?>
                    <a href="<?php echo $link['href']; ?>" class="sidebar-nav-item <?php echo $link['active']; ?>" onclick="toggleOffCanvas()">
                        <i class="<?php echo $link['icon']; ?>"></i> <?php echo $link['text']; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        
    </div>
    <?php } ?>
    
    <div class="container">
        <div class="header">
            <div class="header-logo-section">
                <span class="header-slogan-top">Sistem Informasi Pengelolaan ZISWAF & Kotak Amal</span>
                
                <h1 class="header-title-main">
                     <img src="<?php echo $base_url; ?>assets/img/give_track_logo_final.png" alt="Give Track Logo System" class="header-logo-img">
                </h1> 
                
                <span class="header-slogan-bottom">mendonasikan, mengapresiasi, dan menjaga keberlanjutan kebaikan</span>
            </div>
             <?php if (isset($_SESSION['loggedin']) && isset($_SESSION['id_user'])) { ?>
                <button class="header-mobile-menu-btn" onclick="toggleOffCanvas()">
                    <i class="fas fa-bars"></i>
                </button>
            <?php } ?>
        </div>
        
        <?php if ($show_sidebar) { ?>
            <div class="content">
                <?php echo $sidebar_html; ?>
                <div class="main-content-area">
        <?php } else { ?>
            <div class="content" style="flex-direction: column;">
        <?php } ?>

<?php if (isset($_SESSION['loggedin']) && isset($_SESSION['id_user'])) { ?>
    <div class="bottom-nav">
        <?php 
        // Display only the first 4 items (or 5 if available)
        $limit = count($bottom_nav_items) > 5 ? 5 : count($bottom_nav_items);
        for ($i = 0; $i < $limit; $i++): 
            $item = $bottom_nav_items[$i];
            
            // If it's the 'Lainnya' button, use onClick to trigger Off-Canvas
            if ($item['text'] == 'Lainnya') { ?>
                <a href="javascript:void(0)" class="bottom-nav-item" onclick="toggleOffCanvas()">
                    <i class="fas fa-ellipsis-h"></i>
                    <span>Lainnya</span>
                </a>
            <?php } else { ?>
                <a href="<?php echo $item['href']; ?>" class="bottom-nav-item <?php echo $item['active']; ?>">
                    <i class="<?php echo $item['icon']; ?>"></i>
                    <span><?php echo $item['text']; ?></span>
                </a>
            <?php }
        endfor; ?>
    </div>
<?php } ?>