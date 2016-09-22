<?php
  Class Cuisine
  {
    private $id;
    private $type;

    function __construct($id=null, $type){
      $this->id = $id;
      $this->type = $type;
    }
    function getId(){
      return $this->id;
    }
    function setType($new_type){
      $this->type = $new_type;
    }
    function getType(){
      return $this->type;
    }
    function save(){
      $GLOBALS['DB']->exec("INSERT INTO cuisine (type) VALUES ('{$this->getType()}');");
      $this->id = $GLOBALS['DB']->lastInsertId();
    }
    function getRestaurants(){
      $restaurants = array();
      $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurants WHERE cuisine_id = {$this->getId()};");
      foreach($returned_restaurants as $restaurant){
        $id = $restaurant['id'];
        $name = $restaurant['name'];
        $cuisine_id =$restaurant['cuisine_id'];
        $neighborhood = $restaurant['neighborhood'];
        $must_eats = $restaurant['must_eats'];
        $price_range = $restaurant['price_range'];
        $rating = $restaurant['rating'];
        $new_restaurant = new Restaurant($id, $name, $cuisine_id, $neighborhood, $must_eats, $price_range, $rating);
        array_push($restaurants, $new_restaurant);
      }
      return $restaurants;
    }

    static function getAll(){
      $returned_cuisines = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
      $cuisines = array();
      if(!empty($returned_cuisines)){
        foreach($returned_cuisines as $cuisine){
          $type = $cuisine['type'];
          $id = $cuisine['id'];
          $new_cuisine = new Cuisine($id, $type);
          array_push($cuisines, $new_cuisine);
        }
      }
      return $cuisines;
    }

    static function deleteAll(){
      $GLOBALS['DB']->exec("DELETE FROM cuisine;");
    }
    static function find($search_id){
      $found_cuisine = null;
      $cuisines = Cuisine::getAll();
      foreach($cuisines as $cuisine){
        $cuisine_id = $cuisine->getID();
        if($cuisine_id == $search_id){
          $found_cuisine = $cuisine;
        }
      }
      return $found_cuisine;
    }

  }

 ?>
