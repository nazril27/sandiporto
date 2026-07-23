 <?php

    $tmpDirectories = [
        '/tmp/views',
        '/tmp/cache/data',
        '/tmp/sessions',
        '/tmp/bootstrap/cache',
    ];

    foreach ($tmpDirectories as $dir) {
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
    }

    putenv('VIEW_COMPILED_PATH=/tmp/views');
    putenv('APP_CONFIG_CACHE=/tmp/bootstrap/config.php');
    putenv('APP_EVENTS_CACHE=/tmp/bootstrap/events.php');
    putenv('APP_PACKAGES_CACHE=/tmp/bootstrap/packages.php');
    putenv('APP_ROUTES_CACHE=/tmp/bootstrap/routes.php');
    putenv('APP_SERVICES_CACHE=/tmp/bootstrap/services.php');

    require __DIR__ . '/../public/index.php';