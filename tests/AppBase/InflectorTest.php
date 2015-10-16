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
      array("suffixes",   "suffix"),    # Rule 2
      array("oxen",       "ox"),        # Rule 2
      array("aliases",    "alias"),     # Rule 2
      array("octopi",     "octopus"),   # Rule 2
      array("crises",     "crisis"),    # Rule 2
      array("shoes",      "shoe"),      # Rule 2
      array("oes",        "o"),         # Rule 2
      array("buses",      "bus"),       # Rule 2
      array("mice",       "mouse"),     # Rule 2
      array("lashes",     "lash"),      # Rule 2
      array("movies",     "movie"),     # Rule 2
      array("series",     "series"),    # Rule 2
      array("queries",    "query"),     # Rule 2
      array("knives",     "knife"),     # Rule 2
      array("hives",      "hive"),      # Rule 2
      array("lives",      "life"),      # Rule 2
      array("analyses",   "analysis"),  # Rule 2
      array("diagnoses",  "diagnosis"), # Rule 2
      array("diagnoses",  "diagnosis"), # Rule 2
      // '/([ti])a$/i'            => '\1um', -- how to test this ? whats the example ?
      array("people",     "person"),    # Rule 2
      array("men",        "man"),       # Rule 2
      array("children",   "child"),       # Rule 2
      array("news",       "news"),       # Rule 2
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

	
//	/**
//	 * @dataProvider data
//	 */
//	public function testAddNumbers($expected, $actual_1, $actual_2) {
//		$this->assertEquals($expected, $this->obj->add($actual_1,$actual_2));
//	}
//	
//	/**
//	 * @expectedException InvalidArgumentException
//	 */
//	public function testThrowsExceptionForNonNumeric(){
//		$this->assertEquals(3, $this->obj->add(1, array()));
//	}
//
//
//
//
//  public function testTrueIsTrue()
//  {
//      $foo = false;
//      $this->assertTrue($foo);
//  }


	
	protected function tearDown() {
		unset($this->obj);
	}
}
?>
