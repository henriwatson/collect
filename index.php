<?php
if (!file_exists('vendor/autoload.php')) {
    die("Please run composer install");
}
if (!file_exists('static/components')) {
    die("Please run bower install");
}
if (!file_exists('config.php')) {
    die("Please create a config file");
}

require 'vendor/autoload.php';
require 'config.php';

$app = new \Slim\Slim();

$app->userconfig = json_decode($configjson, true);

Stripe::setApiKey($app->userconfig['app']['stripe_sk']);

$app->get('/collect/:id', function ($id) use ($app) {
    if (!isset($app->userconfig['collections'][$id]))
        $app->notFound();

    $app->render('collect_form.php', array(
        'id' => $id,
        'config' => $app->userconfig['app'],
        'collection' => $app->userconfig['collections'][$id]
    ));
});

$app->post('/collect/:id', function ($id) use ($app) {
    if (!isset($app->userconfig['collections'][$id]))
        $app->notFound();

    $collection = $app->userconfig['collections'][$id];

    try {
        $charge = Stripe_Charge::create(array(
          "amount" => $collection['amount'],
          "currency" => $collection['currency'],
          "card" => $app->request->post('token'),
          "description" => $collection['title'],
          "capture" => $collection['capture'],
          "statement_description" => $collection['statement_description']
        ));

        $app->render('collect_success.php', array(
            'id' => $id,
            'config' => $app->userconfig['app'],
            'collection' => $app->userconfig['collections'][$id],
            'charge' => $charge
        ));
    } catch(Stripe_CardError $e) {
        $app->render('collect_form.php', array(
            'id' => $id,
            'config' => $app->userconfig['app'],
            'collection' => $app->userconfig['collections'][$id],
            'error' => $e->getMessage(),
            'cardholdername' => htmlspecialchars($app->request->post('card-holdername')),
            'cardholderemail' => htmlspecialchars($app->request->post('card-holderemail'))
        ));
    }
});

$app->run();
