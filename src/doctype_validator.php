<?php
namespace Beutnagel;

    /*
    |--------------------------------------------------------------------------
    | Doctype Validator
    |--------------------------------------------------------------------------
    |
    | Validate a doctype to check if it is a valid doctype.
    | Structure of this class
    | - constructor
    | - validate (public)
    | - analyse
    | - DTD functions
    | - FPI analyser
    |
    */



/**
 * Class Doctype_Validator
 * @package Beutnagel
 */

class Doctype_Validator
{

	/**
	 * Doctype_Result object container.
	 */
	private $result;

	/**
	 * Doctype_Validator constructor.
     */
	public function __construct()
	{
	}





	/*
    |--------------------------------------------------------------------------
    | VALIDATE
    |--------------------------------------------------------------------------
    */


	/**
	 * @param $subject
     */
	public function validate($subject) {
		$this->result = new Doctype_Result;

		// determine input type
		$result = $subject;

		// URL
		//  $subject starts with "http" or "https"
		if(strpos($subject,"http")===0) {
			$result = $this->validateUrl($subject);
		}

		// STRING
		//  $subject contains "<"
		elseif(strpos($subject,"<")>=0) {
			$result = $this->validateString($subject);
		}


		// FILE
		// TODO make regex pattern
		//  $subject contains either:
		//		- a "/"
		//		- regex pattern for asdsad.asdsa
		//		- no line breaks
		elseif(false) {
			$result = $this->validateFile($subject);
		}

		return $this->analyse($result);
	}

	/**
	 * @param $subject
	 */
	public function validateString($subject) {

		// find dtd in string
		$dtd = $this->findDtdInString($subject);
		return $dtd;
	}

	/**
	 * @param $subject
	 */
	public function validateUrl($subject) {
		// load from url

		// find dtd in string

		// send dtd to validateDTD

		echo "input: url<br>";
	}

	/**
	 * @param $subject
	 */
	public function validateFile($subject) {
		// load from url

		// find dtd in string

		// send dtd to validateDTD

		echo "input: file<br>";

	}




	/*
    |--------------------------------------------------------------------------
    | ANALYSE
    |--------------------------------------------------------------------------
    */

	/**
	 * @param $subject
     */
	public function analyse($dtd)
	{
		/* dissect the DTD
		 * 	  <!DOCTYPE "root_element" "kind" "fpi" ["si"] [subset]>
		 *	root_element: 	(should be "html")
		 *	kind:			public | system
		 *	fpi:			(Formal Public Identifier) "prefix//owner//description//language"
		 *	si:				(System Identifier) uri to DTD
		 *	subset:			optional, note: content of this is NOT validated
		 */


        // TODO include internal subset declarations (starts with [ - see https://en.wikipedia.org/wiki/Document_type_declaration)


        // ### CLEAN AND PREPARE DTD #####################
		// clean up the dtd
		$clean_dtd = $this->cleanDtd($dtd["full"]);

		// transform DTD string into array
		$dtd_array = $this->dtdToArray($clean_dtd);

		$analysed_dtd = array();


        // ### ROOT ELEMENT #####################
		// check root element
		$analysed_dtd["root_element"] = $dtd_array[0];


        // ### KIND #####################
		// check kind
        if(isset($dtd_array[1])){
            $analysed_dtd["kind"] = $dtd_array[1];
            // check uppercase kind
            $this->isUppercase($analysed_dtd["kind"],"kind");

        } else {
           $analysed_dtd["kind"] = null; 
        }

		// Kind is NULL
		if (is_null($analysed_dtd["kind"])) {
			// check due to NULL-allowing DTDs
		}
		// Kind is something else than "public" or "system"
		elseif(strtolower($analysed_dtd["kind"]) != "system" && strtolower($analysed_dtd["kind"]) != "public") {
			// Invalid kind keyword
			$analysed_dtd["errors"][] = $this->reportError("Invalid kind keyword",$analysed_dtd["kind"]);
		}


        // ### FPI #####################
		// check FPI
        if(isset($dtd_array[2])) {
            $analysed_dtd["fpi"] = $dtd_array[2];
            $analysed_dtd["fpi"] = $this->analyseFPI($analysed_dtd["fpi"]);

        } else {
            $analysed_dtd["fpi"] = null;
        }



        // ### URI #####################
        if(isset($dtd_array[3])) {
             // check URI
             $analysed_dtd["uri"] = $dtd_array[3];

        } else {
            $analysed_dtd["uri"] = null;
        }


        // ### FRAGMENTS #####################
        // if more fragments than the max 4 in a valid dtd
        if(count($dtd_array)>4) {
            for($i=4;$i<count($dtd_array);$i++) {
                $analysed_dtd["unknown fragments"][] = $dtd_array[$i];
                $this->reportError("Unknown fragment",$dtd_array[$i]);
            }
        } else {
        }
        // all fragments of the DTD
        $this->result->setResult("fragments",$analysed_dtd);


        // ### MATCH #####################
        // exact match
        $this->result->setResult("match",$this->compareToExisting($analysed_dtd));



		return $this->result;
	}




    /*
    |--------------------------------------------------------------------------
    | DTD FUNCTIONS
    |--------------------------------------------------------------------------
    */

    private function cleanDtd($dtd_full)
	{
		// TODO check for missing > and other non-conforming features
		$clean_dtd = str_ireplace("<!doctype","",$dtd_full);
		$clean_dtd = str_ireplace(">","",$clean_dtd);
		$clean_dtd = ltrim($clean_dtd);

		return $clean_dtd;
	}

	private function dtdToArray($clean_dtd)
	{
		// check for attributes (which are not allowed)
		if(stripos($clean_dtd,'="') || stripos($clean_dtd,"='")) {
			$this->reportError("Attributes not allowed");

			// clean up the string so parser can continue:
			// - first replace quotations with placeholder
			$clean_dtd = str_ireplace('="',"=€quote€",$clean_dtd);
			$clean_dtd = str_ireplace("='","=€quote€",$clean_dtd);

			// then use preg_replace to find the end quote and the content in between
			$clean_dtd =preg_replace("/€quote€([\s\S]*?)\"/im", "€quote€$1€quote€", $clean_dtd);
			$clean_dtd= preg_replace("/€quote€([\s\S]*?)'/im", "€quote€$1€quote€", $clean_dtd);

			// transform into array
			$dtd_array = str_getcsv($clean_dtd," ");

			// replace placeholders with qoutations again
			for($i=0;$i<count($dtd_array);$i++) {
				$dtd_array[$i] = str_ireplace("€quote€",'"',$dtd_array[$i]);
			}

		} else {
			// if no attributes, just transform into array
			$dtd_array = str_getcsv($clean_dtd," ");
		}
		return $dtd_array;
	}



    /**
     * Find dtd in string and return it
     *
     * @param $string String containing DTD
     *
     * @return array DTD matches
     */
    private function findDtdInString($string)
    {
        // use regext pattern to find DTDs
        $matches = $result = array();
        // http://www.regexpal.com/?fam=95970
        // <!doctype([\s\S]*?)>
        $regex = "/<!doctype([\s\S]*?)>/i";
        preg_match_all($regex,$string,$matches);
        if(count($matches[0])>1) {
            $this->reportError("More than one DOCTYPE");
            return $result;
        } else if(count($matches[0])===0) {
            $this->reportError("No DOCTYPE found");
            return false;
        }
        $result = array(
            "full" => $matches[0][0], // the full DTD
            "details" => ltrim($matches[1][0]), // the details, without <!DOCTYPE and >
        );
        $this->result->setResult("original",$result);

        return $result;
    }







    /*
    |--------------------------------------------------------------------------
    | FPI ANALYSER
    |--------------------------------------------------------------------------
    */

    /**
     * @param $fpi string
     */
    private function analyseFPI($fpi) {

        // FPI (Formal Public Identifier)
        // "prefix//owner_of_the_DTD//description_of_the_DTD//ISO 639_language_identifier"
        // e.g. <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
        // http://xmlwriter.net/xml_guide/doctype_declaration.shtml

        // TODO check that the FPI is enclosed in " double qoutes (else not valid)

        // Take into account ISO HTML dtd which does not have a prefix
        if(stripos($fpi,"ISO")===0) {
            // add empty prefix so it also has 4 parts
            $fpi = "//".$fpi;
        }
        // transform into array
        $fpi_arr = explode("//", $fpi);

        if(count($fpi_arr)!==4) {
            $this->reportError("Invalid Formal Public Identifier",$fpi);
        }

        $result = array(
            "prefix" 		=> 	$fpi_arr[0],
            "owner" 		=>	$fpi_arr[1],
            "description" 	=>	$fpi_arr[2],
            "language"		=>	$fpi_arr[3],
        );

        // check for language errors
        $this->validateFpiLanguage($result["language"]);

        // check uppercase errors
        $this->isUppercase($result["owner"],"owner");// todo check if this is true
        $this->isUppercase($result["language"],"language");

        return $result;
    }



    // https://w3c.github.io/html/syntax.html#doctype
    // FPI and URI are also called "public identifier" and "system identifier"

    // http://www.regexpal.com/?fam=95970
    // <!doctype([\s\S]*?)>


    // TODO: Check which SIs are optional


    public function validateFpiLanguage($lang)
    {
        // check if $lang is a valid ISO 639 language code
        // MUST  be 2 characters long
        if(strlen($lang)!=2) {
            $this->reportError("Invalid length of FPI language identifier",$lang);
            return false;
        }
        // MUST be one of the those defined in $ISO639_lang_codes
        if(!array_key_exists(strtolower($lang),$this->ISO639_lang_codes)) {
            $this->reportError("Invalid FPI language identifier",$lang);
            return false;
        } else {
            return true;
        }
    }

    // ISO 639-1 language codes array
    // credit: https://gist.github.com/ddebin/4723054
    /**
     * @var array
     */
    private $ISO639_lang_codes = [
        'ab'=>'Abkhazian',
        'aa'=>'Afar',
        'af'=>'Afrikaans',
        'ak'=>'Akan',
        'sq'=>'Albanian',
        'am'=>'Amharic',
        'ar'=>'Arabic',
        'an'=>'Aragonese',
        'hy'=>'Armenian',
        'as'=>'Assamese',
        'av'=>'Avaric',
        'ae'=>'Avestan',
        'ay'=>'Aymara',
        'az'=>'Azerbaijani',
        'bm'=>'Bambara',
        'ba'=>'Bashkir',
        'eu'=>'Basque',
        'be'=>'Belarusian',
        'bn'=>'Bengali',
        'bh'=>'Bihari languages',
        'bi'=>'Bislama',
        'nb'=>'Bokm_l, Norwegian',
        'bs'=>'Bosnian',
        'br'=>'Breton',
        'bg'=>'Bulgarian',
        'my'=>'Burmese',
        'es'=>'Castilian',
        'ca'=>'Catalan',
        'km'=>'Central Khmer',
        'ch'=>'Chamorro',
        'ce'=>'Chechen',
        'ny'=>'Chewa',
        'ny'=>'Chichewa',
        'zh'=>'Chinese',
        'za'=>'Chuang',
        'cu'=>'Church Slavic',
        'cu'=>'Church Slavonic',
        'cv'=>'Chuvash',
        'kw'=>'Cornish',
        'co'=>'Corsican',
        'cr'=>'Cree',
        'hr'=>'Croatian',
        'cs'=>'Czech',
        'da'=>'Danish',
        'dv'=>'Dhivehi',
        'dv'=>'Divehi',
        'nl'=>'Dutch',
        'dz'=>'Dzongkha',
        'en'=>'English',
        'eo'=>'Esperanto',
        'et'=>'Estonian',
        'ee'=>'Ewe',
        'fo'=>'Faroese',
        'fj'=>'Fijian',
        'fi'=>'Finnish',
        'nl'=>'Flemish',
        'fr'=>'French',
        'ff'=>'Fulah',
        'gd'=>'Gaelic',
        'gl'=>'Galician',
        'lg'=>'Ganda',
        'ka'=>'Georgian',
        'de'=>'German',
        'ki'=>'Gikuyu',
        'el'=>'Greek, Modern (1453-)',
        'kl'=>'Greenlandic',
        'gn'=>'Guarani',
        'gu'=>'Gujarati',
        'ht'=>'Haitian',
        'ht'=>'Haitian Creole',
        'ha'=>'Hausa',
        'he'=>'Hebrew',
        'hz'=>'Herero',
        'hi'=>'Hindi',
        'ho'=>'Hiri Motu',
        'hu'=>'Hungarian',
        'is'=>'Icelandic',
        'io'=>'Ido',
        'ig'=>'Igbo',
        'id'=>'Indonesian',
        'ia'=>'Interlingua (International Auxiliary Language Association)',
        'ie'=>'Interlingue',
        'iu'=>'Inuktitut',
        'ik'=>'Inupiaq',
        'ga'=>'Irish',
        'it'=>'Italian',
        'ja'=>'Japanese',
        'jv'=>'Javanese',
        'kl'=>'Kalaallisut',
        'kn'=>'Kannada',
        'kr'=>'Kanuri',
        'ks'=>'Kashmiri',
        'kk'=>'Kazakh',
        'ki'=>'Kikuyu',
        'rw'=>'Kinyarwanda',
        'ky'=>'Kirghiz',
        'kv'=>'Komi',
        'kg'=>'Kongo',
        'ko'=>'Korean',
        'kj'=>'Kuanyama',
        'ku'=>'Kurdish',
        'kj'=>'Kwanyama',
        'ky'=>'Kyrgyz',
        'lo'=>'Lao',
        'la'=>'Latin',
        'lv'=>'Latvian',
        'lb'=>'Letzeburgesch',
        'li'=>'Limburgan',
        'li'=>'Limburger',
        'li'=>'Limburgish',
        'ln'=>'Lingala',
        'lt'=>'Lithuanian',
        'lu'=>'Luba-Katanga',
        'lb'=>'Luxembourgish',
        'mk'=>'Macedonian',
        'mg'=>'Malagasy',
        'ms'=>'Malay',
        'ml'=>'Malayalam',
        'dv'=>'Maldivian',
        'mt'=>'Maltese',
        'gv'=>'Manx',
        'mi'=>'Maori',
        'mr'=>'Marathi',
        'mh'=>'Marshallese',
        'ro'=>'Moldavian',
        'ro'=>'Moldovan',
        'mn'=>'Mongolian',
        'na'=>'Nauru',
        'nv'=>'Navaho',
        'nv'=>'Navajo',
        'nd'=>'Ndebele, North',
        'nr'=>'Ndebele, South',
        'ng'=>'Ndonga',
        'ne'=>'Nepali',
        'nd'=>'North Ndebele',
        'se'=>'Northern Sami',
        'no'=>'Norwegian',
        'nb'=>'Norwegian Bokm_l',
        'nn'=>'Norwegian Nynorsk',
        'ii'=>'Nuosu',
        'ny'=>'Nyanja',
        'nn'=>'Nynorsk, Norwegian',
        'ie'=>'Occidental',
        'oc'=>'Occitan (post 1500)',
        'oj'=>'Ojibwa',
        'cu'=>'Old Bulgarian',
        'cu'=>'Old Church Slavonic',
        'cu'=>'Old Slavonic',
        'or'=>'Oriya',
        'om'=>'Oromo',
        'os'=>'Ossetian',
        'os'=>'Ossetic',
        'pi'=>'Pali',
        'pa'=>'Panjabi',
        'ps'=>'Pashto',
        'fa'=>'Persian',
        'pl'=>'Polish',
        'pt'=>'Portuguese',
        'pa'=>'Punjabi',
        'ps'=>'Pushto',
        'qu'=>'Quechua',
        'ro'=>'Romanian',
        'rm'=>'Romansh',
        'rn'=>'Rundi',
        'ru'=>'Russian',
        'sm'=>'Samoan',
        'sg'=>'Sango',
        'sa'=>'Sanskrit',
        'sc'=>'Sardinian',
        'gd'=>'Scottish Gaelic',
        'sr'=>'Serbian',
        'sn'=>'Shona',
        'ii'=>'Sichuan Yi',
        'sd'=>'Sindhi',
        'si'=>'Sinhala',
        'si'=>'Sinhalese',
        'sk'=>'Slovak',
        'sl'=>'Slovenian',
        'so'=>'Somali',
        'st'=>'Sotho, Southern',
        'nr'=>'South Ndebele',
        'es'=>'Spanish',
        'su'=>'Sundanese',
        'sw'=>'Swahili',
        'ss'=>'Swati',
        'sv'=>'Swedish',
        'tl'=>'Tagalog',
        'ty'=>'Tahitian',
        'tg'=>'Tajik',
        'ta'=>'Tamil',
        'tt'=>'Tatar',
        'te'=>'Telugu',
        'th'=>'Thai',
        'bo'=>'Tibetan',
        'ti'=>'Tigrinya',
        'to'=>'Tonga (Tonga Islands)',
        'ts'=>'Tsonga',
        'tn'=>'Tswana',
        'tr'=>'Turkish',
        'tk'=>'Turkmen',
        'tw'=>'Twi',
        'ug'=>'Uighur',
        'uk'=>'Ukrainian',
        'ur'=>'Urdu',
        'ug'=>'Uyghur',
        'uz'=>'Uzbek',
        'ca'=>'Valencian',
        've'=>'Venda',
        'vi'=>'Vietnamese',
        'vo'=>'Volap_k',
        'wa'=>'Walloon',
        'cy'=>'Welsh',
        'fy'=>'Western Frisian',
        'wo'=>'Wolof',
        'xh'=>'Xhosa',
        'yi'=>'Yiddish',
        'yo'=>'Yoruba',
        'za'=>'Zhuang',
        'zu'=>'Zulu'
    ];





    private function isUppercase($check,$type = "unknown")
    {
        //var_dump($check !== mb_strtoupper($check));die();
        if(!is_null($check) && $check !== mb_strtoupper($check)) {
            //echo "Is not uppercase as it should be!";
            $this->reportError("Should be uppercase","type ".$type." ".$check);
        }
    }






    /**
     * Find the best guess for the doctype by examining each character
     * one by one with the existing doctypes.
     *
     *
     */
    private function bestGuess()
    {

    }


	private function reportError($errorName,$source = null)
	{
		$error = Doctype_Error::getError($errorName,$source) + array("source"=>$source);
		$this->result->addError($error);
		return $error;

	}


    private function compareToExisting($dtd)
    {
        $match = false;

        // check root element
        if(!isset($dtd["root_element"])){
            $this->reportError("Missing root element");
            return false;
        } elseif(strtolower($dtd["root_element"]) != "html" && strtolower($dtd["root_element"]) !="wml") {
            $this->reportError("Unknown root element",$dtd["root_element"]);
            return false;
        }

        $check = array();
        $check["root_element"] = $dtd["root_element"];
        $check["kind"] = $dtd["kind"];
        if(!is_null($dtd["fpi"])) {
            $check["fpi"] = implode("//",$dtd["fpi"]);
            // compensate for ISO dtd which does not have a prefix
            // and therefore the temp // in front
            // has to be removed
            $check["fpi"] = str_ireplace("//ISO","ISO",$check["fpi"]);
        } else {$check["fpi"] = $dtd["fpi"];}
        $check["si"] = $dtd["uri"];
        $doctype_list = $this->getValidDoctypesList();
        foreach ($doctype_list as $name => $doctype) {
            // compare the $check array with each existing doctype
            // using custom callback function
            //$diff = array_diff_assoc($check,$doctype);

            $diff = array_udiff_assoc($check,$doctype,function ($a,$b) {

                if($a===$b) { // id they are identifacl
                    return 0;
                } elseif(str_ireplace("http:","https:",$a)===$b) { // both http and https can be valid
                    return 0;
                } else {
                    return 1;
                }
            });


            // if there is no difference, there is a match
            if(count($diff)===0){
                $match = $name;
                $this->result->setValid(true);
            }
        }
        return $match;
    }


    public function getValidDoctypesList() {
        return $this->doctypes;
    }

    public function getValidFullDoctypesList()
    {
        $list = array();
        foreach ($this->doctypes as $dtd) {
            $full = "<!DOCTYPE ".$dtd["root_element"];
            if(!is_null($dtd["kind"])) {
                $full .= " ".strtoupper($dtd["kind"]);
            }
            if(!is_null($dtd["fpi"])) {
                $full .= ' "'.$dtd["fpi"].'"';
            }
            if(!is_null($dtd["si"])) {
                $full .= ' "'.$dtd["si"].'"';
            }
            $list[] = $full.">";
        }
        return $list;
    }

// list of valid doctypes
	/**
	 * List of existing valid doctypes
	 *
	 * root_element		Which element is the first in the document
	 * kind				public or system
	 * fpi				Formal
	 *
	 *
	 * @var array
     */
	private $doctypes = [
		"HTML5" => [
			"root_element" 	=> "html",
			"kind" 			=> null,
			"fpi" 			=> null,
			"si" 			=> null,
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "both",
		],
		"XHTML 1.0 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Strict//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML 1.0 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML 1.0 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML 1.1//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML Basic 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML Basic 1.1//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML Basic 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML Basic 1.0//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.0 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.0//EN",
			"si" 			=> "http://www.w3.org/TR/REC-html40/strict.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.0 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.0 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/REC-html40/loose.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.0 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.0 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/REC-html40/frameset.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01//EN",
			"si" 			=> "http://www.w3.org/TR/html4/strict.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/html4/loose.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/html4/frameset.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"ISO HTML" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "ISO/IEC 15445:2000//DTD HTML//EN",
			"si" 			=> null,
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"ISO HTML (Long form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN",
			"si" 			=> null,
			"si_optional"	=> true,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"WML 2.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD WML 2.0//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml20.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"WML 1.1" => [
			"root_element" 	=> "wml",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.1//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml_1.1.xml",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"WML 1.2" => [
			"root_element" 	=> "wml",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.2//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml12.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"WML 1.3" => [
			"root_element" 	=> "wml",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.3//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml13.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML Mobile Profile 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.0//EN",
			"si" 			=> "http://www.wapforum.org/DTD/xhtml-mobile10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML Mobile Profile 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.1//EN",
			"si" 			=> "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML Mobile Profile 1.2" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.2//EN",
			"si" 			=> "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"(IETF) HTML 2.0 (long form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//IETF//DTD HTML 2.0//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
        "(IETF) HTML 2.0" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2 Level 2" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML Level 2//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2.0 Level 2" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML 2.0 Level 2//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2 Level 1" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML Level 1//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2.0 Level 1" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML 2.0 Level 1//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2 Strict" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML Strict//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2.0 Strict" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML 2.0 Strict//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2 Strict Level 2" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML Strict Level 2//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2 Strict Level 1" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML Strict Level 1//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 2.0 Strict Level 1" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML 2.0 Strict Level 1//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],





        "(IETF) HTML 2.0 + i18n" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML i18n//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(IETF) HTML 3 Draft" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//IETF//DTD HTML 3.0//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "(W3O) HTML 3 Draft" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//W3O//DTD W3 HTML 3.0//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
        "HTML 3.2 Experimental (with support for Style Sheets)" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//W3C//DTD HTML Experimental 970421//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],







		"HTML 3.2" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 3.2 Final//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 3.2 (short form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 3.2//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 3.2 (Draft)" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 3.2 Draft//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
        "HTML 3.2 (Final)" => [
            "root_element"  => "html",
            "kind"          => "PUBLIC",
            "fpi"           => "-//W3C//DTD HTML 3.2 Final//EN",
            "si"            => null,
            "si_optional"   => null,
            "subset"        => null,
            "quotes"        => "unknown",
        ],
		"XHTML + MathML + SVG" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN",
			"si" 			=> "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 + Aria 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML-Print" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML-Print 1.0//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML-Print (alternative)" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML-Print 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-print10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 + RDFa Lite 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML 4.01 + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"HTML + Aria" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD HTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
		"XHTML + Aria" => [
			"root_element" 	=> "html",
			"kind" 			=> "PUBLIC",
			"fpi" 			=> "-//W3C//DTD XHTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
			"quotes"		=> "unknown",
		],
	];

	/**
	 * @return array
     */
	public function getDoctypes() {
		return $this->doctypes;
	}


public function getValid() {
    return $this->valid;
}



    // e.g. "HTML5", "XHTML"
    /**
     * @param $specification
     */
    public function setSpec($specification) {

    }



    /**
     * @param $doctype
     * @return bool
     */
    public function isValid($doctype) {
        $validate = $this->validate($doctype);
        if($validate->getValid()) {
            return true;
        } else {
            return false;
        }
    }




} // end class

