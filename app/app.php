
<?php
 require_once __DIR__."/../vendor/autoload.php";
 require_once __DIR__."/../src/Cuisine.php";
 require_once __DIR__."/../src/Restaurant.php";
 require_once __DIR__."/../src/Reviews.php";
 date_default_timezone_set('America/Los_Angeles');

 use Symfony\Component\Debug\Debug;
 Debug::enable();

$app = new Silex\Application();

$app['debug'] = true;

$server = 'mysql:host=localhost;dbname=restaurant';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'
));

$app->get("/", function() use ($app) {
  return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll(), 'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->post("/cuisines", function() use ($app) {
  $newCuisine = new Cuisine(null, $_POST['type']);
  $newCuisine->save();
  return $app['twig']->render('home.html.twig', array('cuisines' => Cuisine::getAll(), 'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->get("/cuisine/{id}", function($id) use ($app) {
  $newCuisine = Cuisine::find($id);

  return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll(),'restaurants' => $newCuisine->getRestaurants(), 'cuisine' => $newCuisine, 'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->post("/cuisine/{id}", function($id) use ($app) {

  $name = $_POST['name'];
  $cuisine_id = $_POST['cuisine_id'];
  $neighborhood = $_POST['neighborhood'];
  $must_eats = $_POST['must_eats'];
  $price_range = $_POST['price_range'];
  $newCuisine = Cuisine::find($id);
  $newRestaurant = new Restaurant(null, $name, $cuisine_id, $neighborhood, $must_eats, $price_range);
  $newRestaurant->save();

  return $app['twig']->render('cuisine.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurants' => $newCuisine->getRestaurants(), 'cuisine' => $newCuisine,  'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->get('/restaurant/{id}', function($id) use ($app){

  $newRestaurant = Restaurant::find($id);

  return $app['twig']->render('restaurant.html.twig', array('cuisines' => Cuisine::getAll(),'restaurant' => $newRestaurant, 'reviews' => $newRestaurant->getReviews(), 'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->post('/restaurant/{id}', function($id) use ($app){
    $newRestaurant = Restaurant::find($id);
    $newReview = new Reviews(null, $_POST['review'], $_POST['restaurant_id'], $_POST['author']);
    $newReview->save();
    return $app['twig']->render('restaurant.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurant' => $newRestaurant, 'reviews' => $newRestaurant->getReviews(),'topRestaurants'=> Restaurant::getAllOrderByRating()));
});

$app->get('/author/{id}', function($id) use ($app){
    $newReview = Reviews::find($id);
    $dump = $newReview->getReviewsByAuthor();
    // var_dump($dump);
    return $app['twig']->render('author.html.twig', array('cuisines' => Cuisine::getAll(),'topRestaurants'=> Restaurant::getAllOrderByRating(), 'reviews' => $dump));
});

$app->post('/rating/{id}', function($id) use ($app){
    $newRestaurant = Restaurant::find($id);
    $newRestaurant->addLike();
    var_dump($newRestaurant);
    return $app['twig']->render('restaurant.html.twig', array('cuisines' => Cuisine::getAll(), 'restaurant' => $newRestaurant, 'reviews' => $newRestaurant->getReviews(), 'topRestaurants'=> Restaurant::getAllOrderByRating()));
});


  return $app;
 ?>
