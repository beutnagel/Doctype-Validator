<?php
    /**
     * Doctype-Validator
     * User: beutnagel
     * Date: 30/10/2016
     * Time: 12.14
     */

    namespace Beutnagel;


    class Doctype_Error
    {
        private static $instance;

        public static function getInstance() {
            if (null === static::$instance) {
                static::$instance = new Doctype_Error();
            }

            return static::$instance;
        }

        private $error_list = array(
            "No DOCTYPE found" => array(
                "name"          =>  "No DOCTYPE found",
                "description"   =>  "It was not possible to find a DOCTYPE of any kind in the source provided",
            ),
/*            "Missing keyword DOCTYPE" => array(
                "name"          =>  "Missing keyword DOCTYPE",
                "description"   =>  "The keyword DOCTYPE has to be present at the beginning of a doctype",
            ),*/
/*            "Wrong case for keyword DOCTYPE" => array(
                "name"          =>  "Wrong case for keyword DOCTYPE",
                "description"   =>  "The keyword DOCTYPE has to be in uppercase, i.e. \"DOCTYPE\"",
            ),*/
            "Invalid kind keyword" => array(
                "name"          =>  "Invalid kind keyword",
                "description"   =>  "The \"kind\" is invalid. Must be either 'PUBLIC' or 'SYSTEM",
            ),
            "Invalid Formal Public Identifier" => array(
                "name"          =>  "Invalid Formal Public Identifier",
                "description"   =>  "The FPI must follow this structure: prefix//owner_of_the_DTD//description_of_the_DTD//ISO 639_language_identifier",
            ),
            "Invalid FPI language identifier" => array(
                "name"          =>  "Invalid FPI language identifier",
                "description"   =>  "The language identifier must be valid ISO 639",
            ),
            "Invalid length of FPI language identifier" => array(
                "name"          =>  "Invalid length of FPI language identifier",
                "description"   =>  "The language identifier must be 2 characters only (ISO 639)",
            ),
            "Attributes not allowed" => array(
                "name"          =>  "Attributes not allowed",
                "description"   =>  "Attributes are not allowed in DTDs",
            ),
            "More than one DOCTYPE" => array(
                "name"          =>  "More than one DOCTYPE",
                "description"   =>  "Only one DOCTYPE is allowed per document.",
            ),
            "Should be uppercase" => array(
                "name"          =>  "Should be uppercase",
                "description"   =>  "Only text in uppercase is valid",
            ),
            "Unknown fragment" => array(
                "name"          =>  "Unknown fragment",
                "description"   =>  "This is not a valid part of a dtd",
            ),
            "Missing root element" => array(
                "name"          =>  "Missing root element",
                "description"   =>  "A root element is the first thing that must be declared, e.g. html",
            ),
            "Unknown root element" => array(
                "name"          =>  "Unknown root element",
                "description"   =>  "This is not a known root element",
            ),
        );

        public static function getError($name,$source = null){
            return static::getInstance()->error_list[$name];
        }

    }