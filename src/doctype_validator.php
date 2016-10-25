<?php
namespace Beutnagel;

    /*
    |--------------------------------------------------------------------------
    | Doctype Validator
    |--------------------------------------------------------------------------
    |
    | Description of this class....
    |
    */
/**
 * Class Doctype_Validator
 * @package Beutnagel
 */

class Doctype_Validator
{

	/**
	 * Doctype_Validator constructor.
     */
	public function __construct()
	{
		echo "validator was initiated";
	}


	/**
	 * @param $subject
     */
	public function validate($subject) {

	}

	/**
	 * @param $subject
     */
	public function validateString($subject) {

	}

	/**
	 * @param $subject
     */
	public function validateUrl($subject) {

	}

	/**
	 * @param $subject
     */
	public function validateFile($subject) {

	}

	// e.g. "HTML5", "XHTML"
	/**
	 * @param $specification
     */
	public function setSpec($specification) {

	}

	/**
	 * @param $specification
	 * @param $subject
     */
	public function isValid($specification,$subject) {

	}


	/**
	 * @param $subject
     */
	public function analyse($subject)
	{
		/* dissect the DTD
		 * 	  <!DOCTYPE "root_element" "kind" "fpi" ["si"] [subset]>
		 *	root_element: 	(should be "html")
		 *	kind:			public | system
		 *	fpi:			(Formal Public Identifier) "prefix//owner//description//language"
		 *	si:				(System Identifier) uri to DTD
		 *	subset:			optional, note: content of this is NOT validated
		 */

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





	/**
	 * @param $fpi
     */
	private function analyseFPI($fpi) {
		$fpi = explode("//", $fpi);
		// count($fpi) should be === 4 parts
		$prefix 		= 	$fpi[0];
		$owner 			=	$fpi[1];
		$description 	=	$fpi[2];
		$language 		=	$fpi[3];
	}



// FPI (Formal Public Identifier)
// "prefix//owner_of_the_DTD//description_of_the_DTD//ISO 639_language_identifier"
// e.g. <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
// http://xmlwriter.net/xml_guide/doctype_declaration.shtml

// https://w3c.github.io/html/syntax.html#doctype
// FPI and URI are also called "public identifier" and "system identifier"

// http://www.regexpal.com/?fam=95970
// <!doctype([\s\S]*?)>

// 1) find doctype with regex above
// 2) dissect capture group. Divide into language, public, system

// TODO: Check which SIs are optional
// list of valid doctypes
	/**
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
		],
		"XHTML 1.0 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Strict//EN",
			"si" 			=> "https://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML 1.0 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML 1.0 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML 1.0 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML 1.1//EN",
			"si" 			=> "https://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML Basic 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML Basic 1.1//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML Basic 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML Basic 1.0//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"HTML 4.0 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.0//EN",
			"si" 			=> "https://www.w3.org/TR/REC-html40/strict.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"HTML 4.0 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.0 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/REC-html40/loose.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"HTML 4.0 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.0 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/REC-html40/frameset.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"HTML 4.01 Strict" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01//EN",
			"si" 			=> "https://www.w3.org/TR/html4/strict.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"HTML 4.01 Transitional" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01 Transitional//EN",
			"si" 			=> "http://www.w3.org/TR/html4/loose.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"HTML 4.01 Frameset" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01 Frameset//EN",
			"si" 			=> "http://www.w3.org/TR/html4/frameset.dtd",
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"XHTML + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"ISO HTML" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "ISO/IEC 15445:2000//DTD HTML//EN",
			"si" 			=> null,
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"ISO HTML (Long form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN",
			"si" 			=> null,
			"si_optional"	=> true,
			"subset" 		=> null,
		],
		"WML 2.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD WML 2.0//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml20.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"WML 1.1" => [
			"root_element" 	=> "wml",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.1//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml_1.1.xml",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"WML 1.2" => [
			"root_element" 	=> "wml",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.2//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml12.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"WML 1.3" => [
			"root_element" 	=> "wml",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD WML 1.3//EN",
			"si" 			=> "http://www.wapforum.org/DTD/wml13.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML Mobile Profile 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.0//EN",
			"si" 			=> "http://www.wapforum.org/DTD/xhtml-mobile10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML Mobile Profile 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.1//EN",
			"si" 			=> "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML Mobile Profile 1.2" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//WAPFORUM//DTD XHTML Mobile 1.2//EN",
			"si" 			=> "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 2.0 (long form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//IETF//DTD HTML 2.0//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 2.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//IETF//DTD HTML//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 3.2" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 3.2 Final//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 3.2 (short form)" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 3.2//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 3.2 (Draft)" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 3.2 Draft//EN",
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML + MathML + SVG" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN",
			"si" 			=> "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 4.01 + Aria 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd",
			"si_optional"	=> false,
			"subset" 		=> null,
		],
		"XHTML-Print" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML-Print 1.0//EN",
			"si" 			=> "http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML-Print (alternative)" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML-Print 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-print10.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 4.01 + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 4.01 + RDFa Lite 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML 4.01 + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML 4.01+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML + RDFa 1.0" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.0//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML + RDFa 1.1" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML+RDFa 1.1//EN",
			"si" 			=> "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"HTML + Aria" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD HTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"XHTML + Aria" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> "-//W3C//DTD XHTML+ARIA 1.0//EN",
			"si" 			=> "http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd",
			"si_optional"	=> null,
			"subset" 		=> null,
		],
/*		"asdasdasdas" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> null,
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"asdasdasdas" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> null,
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
		"asdasdasdas" => [
			"root_element" 	=> "html",
			"kind" 			=> "public",
			"fpi" 			=> null,
			"si" 			=> null,
			"si_optional"	=> null,
			"subset" 		=> null,
		],
*/
	];

	/**
	 * @return array
     */
	public function getDoctypes() {
		return $this->doctypes;
	}

// ISO 639-1 language codes array
	// credit: https://gist.github.com/ddebin/4723054
	/**
	 * @var array
     */
	private $codes = [
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

} // end class

