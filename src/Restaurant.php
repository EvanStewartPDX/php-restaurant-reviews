<?php
  class Restaurant
  {
    private $id;
    private $name;
    private $cuisine_id;
    private $neighborhood;
    private $must_eats;
    private $price_range;
    private $rating;

    function __construct($id = null, $name, $cuisine_id, $neighborhood, $must_eats, $price_range, $rating=0){
      $this->id = $id;
      $this->name = $name;
      $this->cuisine_id = $cuisine_id;
      $this->neighborhood = $neighborhood;
      $this->must_eats = $must_eats;
      $this->price_range = $price_range;
      $this->rating = $rating;
    }
    function getId (){
      return $this->id;
    }
    function setName($new_name){
      $this->name = $new_name;
    }
    function getName(){
      return $this->name;
    }
    function setCuisine_id($new_cuisine_id){
      $this->cuisine_id = $new_cuisine_id;
    }
    function getCuisine_id(){
      return $this->cuisine_id;
    }
    function setNeighborhood($new_neighborhood){
      $this->neighborhood = $new_neighborhood;
    }
    function getNeighborhood(){
      return $this->neighborhood;
    }
    function setMust_eats($new_must_eats){
      $this->must_eats = $new_must_eats;
    }
    function getMust_eats(){
      return $this->must_eats;
    }
    function setPrice_range($new_price_range){
      $this->price_range = $new_price_range;
    }
    function getPrice_range(){
      return $this->price_range;
    }
    function setRating($new_rating){
      $this->rating = $new_rating;
    }
    function getRating(){
      return $this->rating;
    }
    function save()
    {
      $GLOBALS['DB']->exec("INSERT INTO restaurants (name, cuisine_id, neighborhood, must_eats, price_range, rating) VALUES (
      '{$this->getName()}',
      {$this->getCuisine_id()},
      '{$this->getNeighborhood()}',
      '{$this->getMust_eats()}',
      '{$this->getPrice_range()}',
      '{$this->getRating()}');
      ");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function getAll(){
      $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants;");
      $allRestaurants = array();
      if(!empty($returned_restaurants)){
        foreach($returned_restaurants as $restaurant){
          $id = $restaurant['id'];
          $name = $restaurant['name'];
          $cuisine_id = $restaurant['cuisine_id'];
          $neighborhood = $restaurant['neighborhood'];
          $must_eats = $restaurant['must_eats'];
          $price_range = $restaurant['price_range'];
          $rating = $restaurant['rating'];
          $new_restaurant = new Restaurant($id, $name, $cuisine_id, $neighborhood, $must_eats, $price_range, $rating);
          array_push($allRestaurants, $new_restaurant);
        }
      }
      return $allRestaurants;
    }
    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM restaurants");
    }
    static function find($search_id)
    {
      $found_restaurant = null;
      $allRestaurants = Restaurant::getAll();
      foreach($allRestaurants as $restaurant){
        $restaurant_id = $restaurant->getId();
        if($restaurant_id == $search_id){
          $found_restaurant = $restaurant;
        }
      }
      return $found_restaurant;
    }
    function getReviews(){
      $reviews = array();
      $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE restaurant_id = {$this->getId()};");
      foreach($returned_reviews as $review){
        $id = $review['id'];
        $reviewText= $review['reviews'];
        $restaurant_id =$review['restaurant_id'];
        $author = $review['author'];
        $new_review = new Reviews($id, $reviewText, $restaurant_id, $author);
        array_push($reviews, $new_review);
      }
      return $reviews;
    }
  }
 ?>
