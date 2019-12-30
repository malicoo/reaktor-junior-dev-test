<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reaktor - Junior Dev Challenge</title>
    <?php
    $config = file_get_contents('./../.cache/config.json');
     ?>
    <script>
    window.config = <?php echo $config; ?>;
    </script>
</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="/js/app.js"></script>
</body>

</html>