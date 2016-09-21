
<?php
 require_once __DIR__."/../vendor/autoload.php";
 require_once __DIR__."/../src/Cuisine.php";
 require_once __DIR__."/../src/Restaurant.php";
 date_default_timezone_set('America/Los_Angeles');


$app = new Silex\Application();

$server = 'mysql:host=localhost;dbname=restaurant';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
));

$app->get("/", function() use ($app) {
  return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll()));
});

$app->post("/cuisines", function() use ($app) {
  $newCuisine = new Cuisine(null, $_POST['type']);
  $newCuisine->save();
  return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll()));
});

// $app->get("/cuisine/{id}", function($id) use ($app) {
//   $newCuisine = Cuisine::find($id);
//   return $app['twig']->render('cuisine' => $newCuisine->getRestaurants());
// });

  return $app;
 ?>
