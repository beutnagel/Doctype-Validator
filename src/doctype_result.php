<?php
namespace Beutnagel;

	/*
    |--------------------------------------------------------------------------
    | Doctype Result
    |--------------------------------------------------------------------------
    |
    | This result object holds the results generated by the Doctype Validator class.
    |
    */


/**
 * Class Doctype_Result
 * @package Beutnagel
 */
class Doctype_Result
{


    /**
     * Doctype_Result constructor.
     */
    public function __construct()
    {

    }

    /**
     * Automatically assign a result/value pair to the result object
     *
     * @param string $result   Name of the result, e.g. "valid"
     * @param string $value    The value to assign to the result
     *
     * @return boolean
     */
    public function setResult($result,$value)
    {
        if(property_exists("Doctype_Result",$result)){
           $this->$$result = $value;
            return true;
        } else {
            return false;
        }
    }


	/**
	 * Whether the result is an exact match for an existing public doctype.
	 *
	 * @var bool
	 */
	private $exact_match = false;

    /**
	 * @return boolean
	 */
	public function isExactMatch()
	{
		return $this->exact_match;
	}



	/**
     * Whether the result is a valid doctype, i.e. does it conform to the
     * structural definition of a doctype.
	 * @var bool
     */
	private $valid = false;

	/**
	 * @return boolean
     */
	public function isValid() {
		return $this->valid;
	}


    /**
     * If not an exact match for an existing doctype, this is the best
     * guess as to which doctype was meant.
     *
     * @var bool
     */
    private $best_guess = "none";

    /**
     * @return string "none" or name of existing doctype
     */
    public function bestGuess()
    {
        return $this->best_guess;
    }






} // end class