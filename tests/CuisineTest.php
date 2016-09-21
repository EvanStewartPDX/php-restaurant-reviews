<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";
    // require_once "src/Restaurant.php";
    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Cuisine::deleteAll();
        }
        function test_getType()
        {
            //Arrange
            $type = "Mexican";
            $test_Cuisine = new Cuisine(null, $type);
            //Act
            $result = $test_Cuisine->getType();
            //Assert
            $this->assertEquals($type, $result);
        }
        function test_getRestaurants()
        {
          //array_change_key_case
          $type = "Italian";
          $id = 99;
          $test_Cuisine = new Cuisine($id, $type);
          $test_Restaurant = new Restaurant(null, "El Rodeo", 4, "NE", "burritos", "cheap");
          $test_Restaurant2 = new Restaurant(null, "Olive Garden", 99, "Pearl", "tacos", "super cheap");
          $test_Restaurant->save();
          $test_Restaurant2->save();

          //Act
          $result = $test_Cuisine->getRestaurants();

          //Assert
          $this->assertEquals($test_Restaurant2, $result[0]);

        }
        function test_save()
        {
        //arrange
        $type = "Italian";
        $id = null;
        $test_Cuisine = new Cuisine($id, $type);
        $test_Cuisine->save();

        //Act
        $result = Cuisine::getAll();

        //Assert
        $this->assertEquals($test_Cuisine, $result[0]);
        }

        function test_getAll(){
          //array_change_key_case
          $type = "Mexican";
          $type2 = "Italian";
          $test_Cuisine = new Cuisine(null, $type);
          $test_Cuisine2 = new Cuisine(null, $type2);
          $test_Cuisine->save();
          $test_Cuisine2->save();

          $allCuisines = Cuisine::getAll();

          $this->assertEquals($allCuisines, [$test_Cuisine, $test_Cuisine2]);
        }
      }
?>
