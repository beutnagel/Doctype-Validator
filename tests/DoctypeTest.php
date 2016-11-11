<?php

namespace Beutnagel;
use \PHPUnit\Framework\TestCase;

class DoctypeTest extends TestCase
{
	public function testDoctypeValidatorObjectReturned () {
		$dt = new Doctype_Validator();
        $this->assertInstanceOf('Beutnagel\\Doctype_Validator', $dt);
	}
	public function testDoctypeResultObjectReturned () {
		$dt = new Doctype_Result();
        $this->assertInstanceOf('Beutnagel\\Doctype_Result', $dt);
	}

	public function testDoctypeResultObjectReturnedFromValidator () {
		$dt = new Doctype_Validator();
		$result = $dt->validate("<!DOCTYPE html>");
        $this->assertInstanceOf('Beutnagel\\Doctype_Result', $result);
	}


}