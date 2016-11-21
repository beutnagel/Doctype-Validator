<?php

namespace Beutnagel;
//use \PHPUnit\Framework\TestCase;

/**
 * Class DoctypeTest
 * @package Beutnagel
 */
class DoctypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     *  Doctype_Validator returns the correct object
     */
    public function testDoctypeValidatorObjectReturned () {
		$dt = new Doctype_Validator();
        $this->assertInstanceOf('Beutnagel\\Doctype_Validator', $dt);
	}

    /**
     *  Doctype_Result returns the correct object
     */
    public function testDoctypeResultObjectReturned () {
		$dt = new Doctype_Result();
        $this->assertInstanceOf('Beutnagel\\Doctype_Result', $dt);
	}

    /**
     *  Validator returns Doctype_Result object
     */
    public function testDoctypeResultObjectReturnedFromValidator () {
		$dt = new Doctype_Validator();
		$result = $dt->validate("<!DOCTYPE html>");
        $this->assertInstanceOf('Beutnagel\\Doctype_Result', $result);
	}

    /**
     *  The result object has the correct attributes
     */
    public function testResultObjectHasAttributes () {
		$dt = new Doctype_Validator();
		$result = $dt->validate("<!DOCTYPE html>");
		$this->assertObjectHasAttribute('errors', $result);
		$this->assertObjectHasAttribute('fragments', $result);
		$this->assertObjectHasAttribute('valid', $result);
        $this->assertObjectHasAttribute('original', $result);
	}

    /**
     *  Test of fragments
     */
    public function testFragmentsHTML5() {
		$dt = new Doctype_Validator();
		$result = $dt->validate("<!DOCTYPE html>");
		$fragments = $result->getFragments();
		$this->assertEquals(
				array(
						'root_element' => 'html',
						'kind' => null,
						'fpi' => null,
						'uri' => null,
				),$fragments);
	}

    /**
     *  Invalid due to extra fragments
     */
    public function testFragmentsInvalidXhtml() {
		$dt = new Doctype_Validator();
		$result = $dt->validate('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">');
        $this->assertFalse($result->isValid());
	}


    /**
     *  Ensure that getValidDoctypesList return a populated array
     */
    public function testListOfValidDtds() {
        $dt = new Doctype_Validator();
        $list = $dt->getValidDoctypesList();
        $this->assertTrue(is_array($list));
        $this->assertTrue(count($list)>0);
    }

    /**
     *  Ensure that getValidFullDoctypesList return a populated array
     */
    public function testListOfFullValidDtds() {
        $dt = new Doctype_Validator();
        $list = $dt->getValidFullDoctypesList();
        $this->assertTrue(is_array($list));
        $this->assertTrue(count($list)>0);
    }

    /**
     *  Run through all valid DTDs and ensure that the validator recognizes them all as valid
     */
    public function testValidityOfFullValidDtdList() {
        $dt = new Doctype_Validator();
        $list = $dt->getValidFullDoctypesList();
        foreach($list as $dtd){
            $this->assertTrue($dt->validate($dtd)->isValid());
        }
    }


    /**
     *  Run through all valid DTDs and ensure that the validator matches them all with a valid DTD
     */
    public function testMatchesOfFullValidDtdList() {
        $dt = new Doctype_Validator();
        $list = $dt->getValidFullDoctypesList();
        foreach($list as $name => $dtd){
            $this->assertNotEmpty($dt->validate($dtd)->matches());
        }
    }






    // TEST ERRORS

    /**
     *  Error case: Missing root element
     */
    public function testErrorMissingRootElement()
    {
        $error = "Missing root element";
        $dt = new Doctype_Validator();
        $result = $dt->validate("<!DOCTYPE >");
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($result->getErrors()[0]["name"]===$error,"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Unknown root element
     */
    public function testErrorUnknownRootElement()
    {
        $error = "Unknown root element";
        $dt = new Doctype_Validator();
        $result = $dt->validate("<!DOCTYPE thisdoesnotexist>");
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($result->getErrors()[0]["name"]===$error,"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Should be uppercase
     */
    public function testErrorShouldBeUppercase()
    {
        $error = "Should be uppercase";
        $dt = new Doctype_Validator();
        $result = $dt->validate("<!doctype html public>");
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($result->getErrors()[0]["name"]===$error,"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Unknown fragment
     */
    public function testErrorUnknownFragment()
    {
        $error = "Unknown fragment";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!doctype html public "-//adssd//jjhj//Jhjh//jhjh//jhjh" "sdfdsfsf" "sdfsdfsdf">');
/*        var_dump($result->getErrors());
        var_dump($this->checkErrorMessageFor("Unknown fragment",$result->getErrors()));*/
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: More than one DOCTYPE
     */
    public function testErrorMoreThanOneDoctype()
    {
        $error = "More than one DOCTYPE";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!doctype html><!DOCTYPE wml>');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Attributes not allowed
     */
    public function testErrorAttributesNotAllowed()
    {
        $error = "Attributes not allowed";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!doctype html xml="sddf">');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Invalid length of FPI language identifier
     */
    public function testErrorInvalidLengthOfFpiLanguageIdentifier()
    {
        $error = "Invalid length of FPI language identifier";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//ENGLISH">');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Invalid FPI language identifier
     */
    public function testErrorInvalidFpiLanguageIdentifier()
    {
        $error = "Invalid FPI language identifier";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//zz">');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Invalid Formal Public Identifier
     */
    public function testErrorInvalidFormalPublicIdentifier()
    {
        $error = "Invalid Formal Public Identifier";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final">');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    /**
     *  Error case: Invalid kind keyword
     */
    public function testErrorInvalidKindKeyword()
    {
        $error = "Invalid kind keyword";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!DOCTYPE HTML PRIVATE "-//W3C//DTD HTML 3.2 Final//EN">');
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error,$result->getErrors()),"Failed to trigger error: 'Invalid kind keyword'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

    // TODO add check for case before testing (is not yet implemented)
/*    public function testErrorWrongCaseForKeywordDOCTYPE()
    {
        $error = "Wrong case for keyword DOCTYPE";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!doctype HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">');
        var_dump($result->getErrors());
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error",$result->getErrors()));
         $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
   }*/

/*    public function testErrorMissingKeywordDOCTYPE()
    {
        $error = "Missing keyword DOCTYPE";
        $dt = new Doctype_Validator();
        $result = $dt->validate('<! HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">');
        var_dump($result->getErrors());
        $this->assertObjectHasAttribute('errors', $result);
        $this->assertTrue($this->checkErrorMessageFor($error",$result->getErrors()));
         $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
   }*/

    /**
     *  Error case: No DOCTYPE found
     */
    public function testErrorNoDOCTYPEFound()
    {
        $error = "No DOCTYPE found";
        $dt = new Doctype_Validator();
        $result = $dt->validate('There is no doctype to be found here');
        $this->assertObjectHasAttribute('errors', $result);
        $status = $this->checkErrorMessageFor($error,$result->getErrors());
        $this->assertTrue($status,"Failed to trigger error: '".$error."'");
        $this->assertFalse($result->isValid(),"Returns isValid:true but there was error in DOCTYPE");
        $this->assertFalse($result->matches(),"A match is return for an invalid DOCTYPE");
    }

            /**
             * @param       $name
             * @param array $errors
             *
             * @return bool
             */
            private function checkErrorMessageFor($name,$errors = array()) {
                foreach ($errors as $error) {
                    if($error["name"] === $name) {
                        return true;
                    }
                }
                return false;
            }




    /*
     *  TEST CASES (EXPECTED BEHAVIOUR)
     */

    /**
     *  XHTML 1.0 Strict +  invalid xml attributes
     *
     *  valid:              false
     *  match:              XHTML 1.0 Strict
     *  unknown fragments:  3
     *  error:               Attributes not allowed
     */
    public function testXhtmlDoctypeWithAttributes()
    {
        $dt = new Doctype_Validator();
        $result = $dt->validate('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">');
        $this->assertFalse($result->isValid(),"Returns as valid when invalid attributes are present");
        $this->assertEquals("XHTML 1.0 Strict",$result->matches());
        $countUnknowFragments = 0;
        foreach ($result->getErrors() as $error) {
            if($error["name"]==="Unknown fragment") {$countUnknowFragments++;}
        }
        $this->assertEquals(3,$countUnknowFragments,"A total of 3 unknown fragments where expected");
        $error = "Attributes not allowed";
        $status = $this->checkErrorMessageFor($error,$result->getErrors());
        $this->assertTrue($status,"Failed to trigger error: '".$error."'");

    }
} // end class


