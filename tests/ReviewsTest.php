<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Reviews.php";
    // require_once "src/Restaurant.php";
    $server = 'mysql:host=localhost;dbname=restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ReviewsTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Reviews::deleteAll();
        }
        function test_author()
        {
          $test_author = "sam";
          $test_review = new Reviews("d", "some text", "3", $test_author);

          $result = $test_review->getAuthor();
          var_dump($test_review);
          $this->assertEquals($test_author, $result);
        }
    }
?>
