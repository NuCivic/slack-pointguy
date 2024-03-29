<?php

require('../vendor/autoload.php');
require_once('functions.php');

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();
$app['debug'] = true;

$config = array(
  'token' => getenv("TOKEN"),
  'sheet' => getenv("SHEET"),
);

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

$app['monolog']->addDebug('token set to ' . $config['token']);
$app['monolog']->addDebug('sheet set to ' . $config['sheet']);

if ($config['token'] && $config['sheet']) {  
  $app->get('/', function() use($app) {
    return $app->json(
      array(
        'reason' => 'no get',
        'text' => 'i don\'t talk get with strangers',
      ),
      403
    );
  });

  $app->post('/', function(Request $request) use($app, $config) {
    if ($request->get('token') == $config['token']) {
      $app['monolog']->addDebug('token is correct.');
      $sheet = load_payroll($config['sheet']);
      $text = $request->get('text');
      $result = search_pointperson($text, $sheet);
      $response_text = sprintf('The point-person for %s is %s %s', $text, $result['name'], $result['slack'] );
      $response = array(
        'respose_type' => 'in_channel',
        'text' => $response_text
      );
      return $app->json($response, 200);
    }
    else {
      $app['monolog']->addDebug('incorrect token');
      return $app->json(
        array(
          'reason' => 'incorrect token',
          'text' => 'I don\'t talk post to strangers'
        ),
        403
      );
    }
  });
$app->run();
}
else {
  echo "Please set TOKEN and SHEET environment variables";
}