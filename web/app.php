<?php

require('../vendor/autoload.php');
require_once('functions.php');

use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

$app->post('/', function(Request $request) use($app) {
  if ($request->get('token') == $token) {
    $app['monolog']->addDebug('token is correct.');
    $spreadsheet = load_payroll($spreadsheet_url);
    $text = $request->get('text');
    $result = search_gotoguy($text, $spreadsheet);
    $response_text = sprintf('The go-to-guy for %s is %s %s', $text, $result['name'], $result['slack'] );
    $response = array(
      'respose_type' => 'in_channel',
      'text' => $response_text
    );
    return $app->json($response, 200);
  }
  $app['monolog']->addDebug('incorrect token');
  return $app->json(
    array(
      'reason' => 'incorrect token',
      'text' => 'i don\'t talk to scriptngers'
    ),
    403
  );
});

$app->run();
