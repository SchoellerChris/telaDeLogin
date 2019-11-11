<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// Set up dependencies
$dependencies = require __DIR__ . '/../src/dependencies.php';
$dependencies($app);

// Register middleware
$middleware = require __DIR__ . '/../src/middleware.php';
$middleware($app);

// Register routes
$routes = require __DIR__ . '/../src/routes.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaLogin.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaCategoria.php';
$routes($app);
$routes = require __DIR__ . '/../src/categoriaCadastro.php';
$routes($app);
$routes = require __DIR__ . '/../src/apagarCategoria.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaProduto.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaProdutoEditar.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaProdutoUpdate.php';
$routes($app);
$routes = require __DIR__ . '/../src/apagarProduto.php';
$routes($app);
$routes = require __DIR__ . '/../src/produtoCadastro.php';
$routes($app);
$routes = require __DIR__ . '/../src/rotaPedido.php';
$routes($app);




// Run app
$app->run();
