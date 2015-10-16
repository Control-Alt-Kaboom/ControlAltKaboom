<?php
# --------------------------------------------------------------------------------------------------
# File: InflectorTest.php
# Desc: PHPUNIT Test for the \ControlAltKaboom\Inflector object
# --------------------------------------------------------------------------------------------------

use ControlAltKaboom\AppBase\Inflector;

class InflectorTest extends PHPUnit_Framework_TestCase {

	protected $obj = NULL;
	protected $info = NULL;
	
	protected function setUp() {
		$this->obj = new ControlAltKaboom\AppBase\Inflector;
	}

  /**
    * Test Data Provider for Pluralize and Singularize Tests
  */
  public function providerPluralData() {
    
    $i=0;
    return array(
      array("status", "statuses"),      # Rule 1
      array("ox",     "oxen"),          # Rule 2
      array("mouse",  "mice"),          # Rule 3
      array("matrix", "matrices"),      # Rule 4
      array("search", "searches"),      # Rule 5
      array("query",  "queries"),       # Rule 6
      array("archive","archives"),      # Rule 7
      array("half",   "halves"),        # Rule 8
      array("diagnosis",  "diagnoses"), # Rule 9
      array("datum",  "data"),          # Rule 10
      array("person", "people"),        # Rule 11
      array("man",    "men"),           # Rule 12
      array("child",  "children"),      # Rule 13
      array("tomato", "tomatoes"),      # Rule 14
      array("bus",    "buses"),         # Rule 15
      array("alias",  "aliases"),       # Rule 16
      array("octopus","octopi"),        # Rule 17
      array("crisis", "crises"),        # Rule 18
    );
  
  }

  /**
    * Test Data Provider for Singularize Tests
  */
  public function providerSingularData() {
    
    $i=0;
    return array(
      array("statuses",   "status"),    # Rule 1
      array("matrices",   "matrix"),    # Rule 2
      array("suffixes",   "suffix"),    # Rule 3
      array("oxen",       "ox"),        # Rule 4
      array("aliases",    "alias"),     # Rule 5
      array("octopi",     "octopus"),   # Rule 6
      array("crises",     "crisis"),    # Rule 7
      array("shoes",      "shoe"),      # Rule 8
      array("oes",        "o"),         # Rule 9
      array("buses",      "bus"),       # Rule 10
      array("mice",       "mouse"),     # Rule 11
      array("lashes",     "lash"),      # Rule 12
      array("movies",     "movie"),     # Rule 13
      array("series",     "series"),    # Rule 14
      array("queries",    "query"),     # Rule 15
      array("knives",     "knife"),     # Rule 16
      array("hives",      "hive"),      # Rule 17
      array("lives",      "life"),      # Rule 18
      array("analyses",   "analysis"),  # Rule 19
      array("diagnoses",  "diagnosis"), # Rule 20
      array("diagnoses",  "diagnosis"), # Rule 21
      // '/([ti])a$/i'            => '\1um', -- how to test this ? whats the example ?
      array("people",     "person"),    # Rule 23
      array("men",        "man"),       # Rule 24
      array("children",   "child"),     # Rule 25
      array("news",       "news"),      # Rule 26
    );
  }

  /**
    * Test Data Provider for Condition Tests
  */
  public function providerCondition() {

    return array(
      array("document", 0, "document"),
      array("document", 1, "document"),
      array("document", 2, "documents"),
    );      

  }
  /**
   * @dataProvider providerPluralData
   */  
  public function testPluralizeSuccess($singular, $plural) {

    $result = $this->obj->pluralize($singular);

    $this->assertEquals($plural, $result);

  }

  /**
   * @dataProvider providerSingularData
   */  
  public function testSingularize($plural, $singular) {

    $result = $this->obj->singularize($plural);

    $this->assertEquals($singular, $result);

  }


  public function testUnderscoreFromCamel() {

    $originalString = "SomeThingTestableAsString";      
    $expectedResult = "some_thing_testable_as_string";

    $result = $this->obj->underscoreFromCamel($originalString);

    $this->assertEquals($expectedResult, $result);

  }

  public function testUnderscoreFromHuman() {

    $originalString = "Some Thing Testable As String";
    $expectedResult = "some_thing_testable_as_string";

    $result = $this->obj->underscoreFromHuman($originalString);

    $this->assertEquals($expectedResult, $result);

  }

  public function testCamelize() {

    $originalString = "Some Thing Testable As String";
    $expectedResult = "SomeThingTestableAsString";

    $originalString = $this->obj->underscoreFromHuman($originalString);

    $result = $this->obj->camelize($originalString);

    $this->assertEquals($expectedResult, $result);

  }

  public function testHumanize() {

    $originalString = "SomeThingTestableAsString";
    $expectedResult = "Some Thing Testable As String";
 
    $originalString = $this->obj->underscoreFromCamel($originalString);

    $result = $this->obj->humanize($originalString);

    $this->assertEquals($expectedResult, $result);

  }


  /**
   * @dataProvider providerCondition
   */  
  public function testCondition($word, $condition, $expected) {

    $result = $this->obj->condition($word, $condition);

    $this->assertEquals($expected, $result);

  } 

  protected function tearDown() {
		unset($this->obj);
	}
}
?>
