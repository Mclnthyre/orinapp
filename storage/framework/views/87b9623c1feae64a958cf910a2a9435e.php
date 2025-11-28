<!DOCTYPE html>
<html lang="pt-BR">
   <link rel="manifest" href="/public/manifest.php">



<script>
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js')
        .then(() => console.log("Service Worker registrado"))
        .catch(err => console.log("Erro SW:", err));
}
</script>

<head>
    <meta charset="UTF-8">
    <title>Orin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body { padding-bottom: 70px; background: #f2f2f2; }
        .navbar-bottom {
            position: fixed; bottom: 0; left: 0; right: 0;
            background: #ffffff; border-top: 1px solid #ddd;
            display: flex; justify-content: space-around;
            padding: 8px 0;
        }
        .navbar-bottom a {
            text-decoration: none; color: #444; font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container mt-3">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <div class="navbar-bottom">
        <a href="/">Início</a>
        <a href="/artigos">Artigos</a>
        <a href="/cantigas">Cantigas</a>
        <a href="/videos">Vídeos</a>
        <a href="/servicos">Serviços</a>
    </div>

</body>
</html>
<?php /**PATH /home/vol9_5/infinityfree.com/if0_40513224/htdocs/resources/views/layout.blade.php ENDPATH**/ ?>