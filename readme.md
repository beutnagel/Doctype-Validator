#Doctype Validator
Test to see if an HTML doctype is valid according to the W3C specifications.

See more at:
https://beutnagel.github.io/Doctype-Validator/

![](https://codeship.com/projects/ff65d870-8a55-0134-9eb2-5a7c9acf56e8/status?branch=master)

##Installation##

Install with Composer

`$ composer require monolog/monolog`

For the current alpha release

`{
	"require": {
        "beutnagel/doctype-validator": "^0.1.1@alpha"
    },
    "minimum-stability": "alpha"
}`

##When is the DOCTYPE required?
For HTML documents the DOCTYPE is required.
For XHTML it may be omitted.

Documents that are both written to be interpreted as HTML and XHTML are known as polyglot markup documents. 

**Sources:**

* https://dev.w3.org/html5/html-author/
* https://www.w3.org/TR/html5/syntax.html#the-doctype

## List of DOCTYPEs accepted by the W3C validator
* HTML5
* XHTML 1.0 Strict
* XHTML 1.0 Transitional
* XHTML 1.0 Frameset
* HTML 4.01 Strict
* HTML 4.01 Transitional
* HTML 4.01 Frameset
* HTML 4.01 + RDFa 1.1
* HTML 3.2
* HTML 2.0
* ISO/IEC 15445:2000 ("ISO HTML")
* XHTML 1.1
* XHTML + RDFa
* XHTML Basic 1.0
* XHTML Basic 1.1
* XHTML Mobile Profile 1.2
* XHTML-Print 1.0
* XHTML 1.1 plus MathML 2.0
* XHTML 1.1 plus MathML 2.0 plus SVG 1.1
* MathML 2.0
* SVG 1.0
* SVG 1.1
* SVG 1.1 Tiny
* SVG 1.1 Basic
* SMIL 1.0
* SMIL 2.0

## HTML Doctype
### The HTML5 DOCTYPE declaration.
`<!DOCTYPE html>`


### The HTML5 legacy compatibility DOCTYPE declaration.
`<!DOCTYPE html SYSTEM "about:legacy-compat">`

`<!DOCTYPE html SYSTEM 'about:legacy-compat'>`

### Quotation marks
Both single '  and double " quotation marks are allowed.

### Case sensitivity
In HTML only the quoted parts are case sensitive. 


### Custom Doctypes
For XHTML you may use a custom DOCTYPE.


### Obsolete But Permitted DOCTYPEs
These are considered conforming, but obsolete in HTML.
Authors are strongly discouraged from using these DOCTYPEs.

**Public identifier only DOCTYPEs**

`<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">`

**Public and system identifiers**

`<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0//EN"
    SYSTEM "http://www.w3.org/TR/REC-html40/strict.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    SYSTEM "http://www.w3.org/TR/html4/strict.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    SYSTEM "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    SYSTEM "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">`



## List of Doctypes (incl. non-W3C)
Source: https://www.totalvalidator.com/support/doctypes.html


**(X)HTML + Aria**

*This DTD can be used to extend HTML and XHTML and adds the WAI-ARIA state and property attributes to all its elements.*

*Note: This is not a formal document type.*

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD HTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd">`
    
* Status: 
* Obsolete: false
* Optional: true
* Alternatives: HTML5


######(source: [W3C XHTML+WAI-ARIA](https://www.w3.org/TR/wai-aria/appendices))

**XHTML + RDFa**
*XHTML + RDFa extends the XHTML markup language with the attributes defined in RDFa Core

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">`

* Status: Recommendation
* Obsolete: false

######(source: [W3C XHTML+RDFa](https://www.w3.org/TR/xhtml-rdfa/))

**HTML + RDFa**
*HTML + RDFa extends the HTML markup language with the attributes defined in RDFa Core

HTML 4.01+RDFa 1.1:
`<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd">`

HTML 4.01+RDFa Lite 1.1:
`<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd">`

HTML 4.01+RDFa 1.0:
`<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd">`


* Status: Recommendation
* Obsolete: false
* Alternatives: HTML5

######(source: [W3C HTML+RDFa](https://www.w3.org/TR/html-rdfa/))

XHTML 1.1:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

XHTML Basic 1.1:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">

XHTML 1.0 Strict:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

XHTML 1.0 Loose:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

XHTML 1.0 Frameset:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">

**XHTML-Print**

*XHTML-Print is designed as a simple XHTML based data stream suitable for printing as well as display. It is based on XHTML Basic. Its targeted usage is for printing in environments where it is not feasible or desirable to install a printer-specific driver and where some variability in the formatting of the output is acceptable.*

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML-Print 1.0//EN" "http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd">`

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML-Print 1.0//EN"
"http://www.w3.org/MarkUp/DTD/xhtml-print10.dtd">`

######(source: [W3C XHTML-Print](https://www.w3.org/TR/xhtml-print/))

* Status: Recommendation
* Obsolete: false



**XHTML Basic**

*XHTML Basic is an XML-based structured markup language primarily used for simple (mainly handheld) user agents, typically mobile devices.*

*XHTML Basic is a subset of XHTML 1.1, defined using XHTML Modularization including a reduced set of modules for document structure, images, forms, basic tables, and object support.*

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN"
"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">`

*(previous version)*

`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">`


###### (sources [W3C XHTML Basic](https://www.w3.org/TR/xhtml-basic/))


**XHTML Mobile Profile (XHTML-MP):**

*XHTML Mobile Profile was a markup specification targeted towards "microbrowsers" on early mobile devices released by Open Mobile Alliance in 2000. XHTML MP was built on top of XHTML-basic, a subset of XHTML 1.0 by W3C.*

`<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">`

`<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.1//EN"
"http://www.openmobilealliance.org/tech/DTD/xhtml-mobile11.dtd">`

`<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN"
"http://www.wapforum.org/DTD/xhtml-mobile10.dtd">`



###### (sources: [Open Alliance Specification](http://technical.openmobilealliance.org/tech/affiliates/wap/wap-277-xhtmlmp-20011029-a.pdf) and [Authoring Guide](http://www.passani.it/gap/))


**WML 2.0**
*Building on Openwave's HDML, Nokia's "Tagged Text Markup Language" (TTML) and Ericsson's proprietary markup language for mobile content, the WAP Forum created the WML 1.1 standard in 1998.[1] WML 2.0 was specified in 2001,[2] but has not been widely adopted. It was an attempt at bridging WML and XHTML Basic before the WAP 2.0 spec was finalized.[3] In the end, XHTML Mobile Profile became the markup language used in WAP 2.0. The newest WML version in active use is 1.3.*

`<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD WML 2.0//EN" "http://www.wapforum.org/DTD/wml20.dtd">`

`<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.1//EN"
   "http://www.wapforum.org/DTD/wml_1.1.xml" >`

<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.3//EN" "http://www.wapforum.org/DTD/wml13.dtd">

<!DOCTYPE wml PUBLIC "-//WAPFORUM//DTD WML 1.2//EN" "http://www.wapforum.org/DTD/wml12.dtd">

http://www.developershome.com/wap/wml/wml_tutorial.asp?page=doctypeDeclaration





HTML 4.01+Aria 1.0:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd">


HTML 4.01 Strict:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

HTML 4.01 Loose:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

HTML 4.01 Frameset:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">

HTML 4.0 Strict:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN" "http://www.w3.org/TR/REC-html40/strict.dtd">

HTML 4.0 Loose:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">

HTML 4.0 Frameset:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Frameset//EN" "http://www.w3.org/TR/REC-html40/frameset.dtd">

**XHTML + MathML + SVG**


`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 plus MathML 2.0 plus SVG 1.1//EN" "http://www.w3.org/2002/04/xhtml-math-svg/xhtml-math-svg.dtd">`

* Status: Retired
* Obsolete: true
* Released: 2002

###### (Source: [W3C An XHTML + MathML + SVG Profile](https://www.w3.org/TR/XHTMLplusMathMLplusSVG/))


**ISO/IEC 15445:**

`<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HTML//EN">`

*Or the alternative long form*

`<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN">`

Also known as "ISO HTML", was published in May 2000 as an ISO/IEC international standard. In the ISO this standard falls in the domain of the ISO/IEC JTC1/SC34 (ISO/IEC Joint Technical Committee 1, Subcommittee 34 – Document description and processing languages). 

###### (source: https://www.cs.tcd.ie/misc/15445/15445.HTML)



**SMIL 3.0**
(https://www.w3.org/TR/SMIL3/)

Note: List of DTDs and modules here: https://www.w3.org/TR/SMIL3/smil-modules.html#smilModulesNSDTDCreation






HTML 3.2:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

HTML 3.2 (alternative):
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">

HTML 3.2 (alternative):
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Draft//EN">

HTML 2.0:
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">

HTML 2.0 (alternative):
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">


## What a DOCTYPE must consist of
A DOCTYPE must consist of the following components, in this order:

1. A string that is an ASCII case-insensitive match for the string "<!DOCTYPE".
2. One or more space characters.
3. A string that is an ASCII case-insensitive match for the string "html".
4. Optionally, a DOCTYPE legacy string or an obsolete permitted DOCTYPE string.
5. Zero or more space characters.
6. A ">" (U+003E) character.

###### (source: https://www.w3.org/TR/html5/syntax.html#the-doctype)

## Sites for testing:
* http://solefest.com/   		(doctype comes after other content)
* http://autodetale.pl/ 		(legacy html5 doctype)
