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





## Sites for testing:
* http://solefest.com/   		(doctype comes after other content)
* http://autodetale.pl/ 		(legacy html5 doctype)