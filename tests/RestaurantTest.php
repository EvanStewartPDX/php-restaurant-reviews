<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Restaurant.php";
    // require_once "src/Restaurant.php";
    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Restaurant::deleteAll();
        }
        function test_getName()
        {
            //Arrange
            $name = "El Rodeo";
            $cuisine_id = 3;
            $neighborhood  = "downtown";
            $must_eats = "tamales";
            $price_range = "hella expensive";
            $test_Restaurant = new Restaurant(null, $name, $cuisine_id, $neighborhood, $must_eats, $price_range);
            //Act
            $result = $test_Restaurant->getNeighborhood();
            //Assert
            $this->assertEquals($neighborhood, $result);
        }
        function test_getId()
        {
          //array_change_key_case
          $id = null;
          $name = "El Rodeo";
          $cuisine_id = 3;
          $neighborhood  = "downtown";
          $must_eats = "tamales";
          $price_range = "hella expensive";
          $test_Restaurant = new Restaurant(null, $name, $cuisine_id, $neighborhood, $must_eats, $price_range);
          $test_Restaurant->save();

          //Act
          $result = $test_Restaurant->getId();
          // var_dump($result);
          //Assert
          $this->assertEquals(true, is_numeric($result));

        }
        function test_save()
        {
        //arrange
        $name = "El Rodeo";
        $cuisine_id = 3;
        $neighborhood  = "downtown";
        $must_eats = "tamales";
        $price_range = "hella expensive";
        $test_Restaurant = new Restaurant(null, $name, $cuisine_id, $neighborhood, $must_eats, $price_range);
        $test_Restaurant->save();

        //Act
        $result = Restaurant::getAll();

        //Assert
        $this->assertEquals($test_Restaurant, $result[0]);
        }

        function test_getAll(){
          //array_change_key_case
          // $name = "Mexican";
          // $cuisine_d = ""
          $test_Restaurant = new Restaurant(null, "El Rodeo", 4, "NE", "burritos", "cheap");
          $test_Restaurant2 = new Restaurant(null, "Santeria", 5, "Pearl", "tacos", "super cheap");
          $test_Restaurant->save();
          $test_Restaurant2->save();

          $allRestaurants = Restaurant::getAll();


          $this->assertEquals([$test_Restaurant, $test_Restaurant2], $allRestaurants);
        }
      }
?>
