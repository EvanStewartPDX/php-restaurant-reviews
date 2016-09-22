<?php
  Class Reviews
  {
    private $id;
    private $review;
    private $restaurant_id;
    private $author;
    

    function __construct($id=null, $review, $restaurant_id, $author){
      $this->id = $id;
      $this->review = $review;
      $this->restaurant_id =$restaurant_id;
      $this->author = $author;
    }
    function getId(){
      return $this->id;
    }
    function setReview($new_review){
      $this->review = $new_review;
    }
    function getReview(){
      return $this->review;
    }
    function setRestaurant_id($new_restaurant_id){
      $this->restaurant_id = $new_restaurant_id;
    }
    function getRestaurant_id(){
      return $this->restaurant_id;
    }
    function setAuthor($new_author){
      $this->author = $new_author;
    }
    function getAuthor(){
      return $this->author;
    }
    function save(){
      $GLOBALS['DB']->exec("INSERT INTO reviews (reviews, restaurant_id, author) VALUES (
          '{$this->getReview()}',
          '{$this->getRestaurant_id()}',
          '{$this->getAuthor()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM reviews");
    }
    static function getAll(){
      $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews;");
      $allReviews= array();
      if(!empty($returned_reviews)){
        foreach($returned_reviews as $review){
          $id = $review['id'];
          $author = $review['author'];
          $restaurant_id = $review['restaurant_id'];
          $review = $review['reviews'];
          $new_review = new Reviews($id, $review, $restaurant_id, $author);
          array_push($allReviews, $new_review);
        }
      }
      return $allReviews;
    }
    static function find($search_id)
    {
        $found_review = null;
        $allReviews = Reviews::getAll();
        foreach($allReviews as $review){
          $review_id = $review->getId();
          if($review_id == $search_id){
            $found_review = $review;
          }
        }
        return $found_review;
    }
    function getReviewsByAuthor(){
      $returned_reviews = $GLOBALS['DB']->query("SELECT * FROM reviews WHERE author = '{$this->getAuthor()}';");
      $returned_restaurants = Restaurant::getAll();

      $restaurantIdName = array();
      if(!empty($returned_restaurants)){
        foreach($returned_restaurants as $restaurant){
            $id = $restaurant->getId();
            $name = $restaurant->getName();
            $restaurantIdName[$id] =$name;
        }
      }
      $allReviews= array();
      if(!empty($returned_reviews)){
        foreach($returned_reviews as $review){
          $id = $review['id'];
          $author = $review['author'];
          $restaurant_name = $restaurantIdName[$review['restaurant_id']];
          $review = $review['reviews'];
          $new_review = new Reviews($id, $review, $restaurant_name, $author);
          array_push($allReviews, $new_review);
        }
      }
      return $allReviews;
    }

  }

 ?>
