<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= esc($title) ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/auth.css'); ?>">
</head>

<body>
    <div class="background-slider"></div>
    <div class="background-overlay"></div>

    <div class="auth-container">
        <div class="logo">
            <img src="../assets/img/logo.png" alt="Logo" width="100">
        </div>

        <?= $this->renderSection('content'); ?>

        <script src="<?= base_url('../assets/js/auth.js') ?>">

        </script>
</body>

</html>