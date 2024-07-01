<?php

declare(strict_types=1);

namespace App;

use Helpers\Helper;

class Bootstrap implements \App\Interface\Bootstrap
{
    public function boot(): void
    {
        # solve request
        $request = Helper::getRequest();
        $parts = explode('/', $request);

        # solve modes
        $modes = ['api'];
        $mode = 'api';

        # remove mode from path
        if (in_array($parts[0], $modes))
            unset($parts[0]);
        $parts = array_values($parts);

        # set controller
        $controller = !empty($parts[1]) ? $parts[0] : 'index';

        # remove controller from path
        if (isset($parts[1]))
            unset($parts[0]);
        $parts = array_values($parts);

        # add appropriate headers if api
        if ($mode === 'api') {
            # set json and cors headers
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE');
            header("Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Requested-With");
            header('Content-Type: application/json; charset=utf-8');

            # preflight error fix
            if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
                die(200);
        }

        # solve controller class
        $class = 'App\\Controller\\' . ucfirst($mode) . '\\' . ucfirst($controller);

        if (class_exists($class)) {
            $_SERVER['REQUEST'] = $parts;
            $contr = new $class;
            $contr->run();
        }
    }
}