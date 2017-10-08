<?php

use Phalcon\DI\FactoryDefault\CLI as CliDI,
    Phalcon\CLI\Console as ConsoleApp;

define('VERSION', '1.0.0');

//Using the CLI factory default services container
$di = new CliDI();

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__)));

/**
 * Register the autoloader and tell it to register the tasks directory
 */
$loader = new \Phalcon\Loader();
$loader->registerDirs(
    array(
        APPLICATION_PATH . '/tasks',
        APPLICATION_PATH . '/models'
    )
);
$loader->register();

// Load the configuration file (if any)
if (is_readable(APPLICATION_PATH . '/config/config.php')) {
    $config = include APPLICATION_PATH . '/config/config.php';
    $di->set('config', $config);
}

$config = $di->get('config');

//Setup the database service
$di->set('db', function () use ($config) {
    return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
        "host" => $config->database->host,
        "username" => $config->database->username,
        "password" => $config->database->password,
        "dbname" => $config->database->dbname
    ));
});

//Setup the beanstalk service
$di->set('beanstalk', function () use ($config) {
    return new \Phalcon\Queue\Beanstalk(array(
        "host" => $config->beanstalk->host,
        "port" => $config->beanstalk->port
    ));
});

//Create a console application
$console = new ConsoleApp();
$console->setDI($di);

/**
 * Process the console arguments
 */
$arguments = array();
$params = array();

foreach ($argv as $k => $arg) {
    if ($k == 1) {
        $arguments['task'] = $arg;
    } elseif ($k == 2) {
        $arguments['action'] = $arg;
    } elseif ($k >= 3) {
        $params[] = $arg;
    }
}
if (count($params) > 0) {
    $arguments['params'] = $params;
}

// define global constants for the current task and action
define('CURRENT_TASK', (isset($argv[1]) ? $argv[1] : null));
define('CURRENT_ACTION', (isset($argv[2]) ? $argv[2] : null));

try {
    // handle incoming arguments
    $console->handle($arguments);
} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
}