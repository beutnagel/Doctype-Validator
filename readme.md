#Doctype Validator
Test to see if an HTML doctype is valid according the W3C specifications.



##When is the DOCTYPE required?
For HTML documents the DOCTYPE is required.
For XHTML it may be omitted.

Documents that are both written to be interpreted as HTML and XHTML are known as polyglot markup documents. 

**Sources:**

* https://dev.w3.org/html5/html-author/
* https://www.w3.org/TR/html5/syntax.html#the-doctype


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

(X)HTML5:
<!DOCTYPE html>

(X)HTML5 (alternative):
<!DOCTYPE html SYSTEM "about:legacy-compat">

XHTML 1.1+Aria 1.0:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/xhtml-aria-1.dtd">

XHTML 1.1+RDFa 1.1:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd">

XHTML 1.1+RDFa 1.0:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">

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

XHTML-Print 1.0:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML-Print 1.0//EN" "http://www.w3.org/TR/xhtml-print/xhtml-print10.dtd">

XHTML Basic 1.0:
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.0//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">

XHTML Mobile Profile 1.2:
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">

HTML 4.01+Aria 1.0:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML+ARIA 1.0//EN" "http://www.w3.org/WAI/ARIA/schemata/html4-aria-1.dtd">

HTML 4.01+RDFa 1.1:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa11-1.dtd">

HTML 4.01+RDFa Lite 1.1:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa Lite 1.1//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfalite11-1.dtd">

HTML 4.01+RDFa 1.0:
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/html401-rdfa-1.dtd">

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

ISO/IEC 15445:
<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HTML//EN">

ISO/IEC 15445 (alternative):
<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN">

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

###### https://www.w3.org/TR/html5/syntax.html#the-doctype

## Sites for testing:
* http://solefest.com/   		(doctype comes after other content)
* http://autodetale.pl/ 		(legacy html5 doctype)