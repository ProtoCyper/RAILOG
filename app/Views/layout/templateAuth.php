<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= esc($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/auth.css'); ?>">
</head>

<body>
    <div class="background-slider">
        <div class="background-overlay"></div>
        <div class="background-content">
            <div class="terminal-info">
            </div>
            <div class="tagline">
                <h1>Logistik terintegrasi untuk operasional yang lebih cerdas</h1>
                <p>Kelola inventori, aset, dan rantai pasok secara terpusat untuk mendukung operasional energi yang lebih efisien.</p>
            </div>
        </div>
    </div>

    <div class="auth-container">
        <div class="logo">
            <div class="logo-icon">R</div>
            <div class="logo-text">
                <h3>RAILOG</h3>
                <p>INDUSTRIAL SYSTEMS</p>
            </div>
        </div>

        <?= $this->renderSection('content'); ?>
    </div>

    <script src="<?= base_url('../assets/js/auth.js') ?>"></script>
</body>

</html>