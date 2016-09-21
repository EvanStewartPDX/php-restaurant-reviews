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
      $GLOBALS['DB']->exec("INSERT INTO reviews (review, restaurant_id, author) VALUES ('{$this->getReview()}',{$this->getRestaurant_id()}, '{$this->getAuthor()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM reviews");
    }

  }

 ?>
