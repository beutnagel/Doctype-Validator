<!DOCTYPE html>
<html>
<head>
	<title>Doctype Validator</title>
</head>
<body>
<h1>Doctype Validator</h1>


<?php
require_once('src/doctype_validator.php');
require_once('src/doctype_result.php');
require_once('src/Doctype_Error.php');
//include_once 'src/doctype_validator.php';
use Beutnagel\Doctype_Validator;
	//Doctype_Validator::register_autoloader();
$validator = new Doctype_Validator();
//var_dump($validator);
$doctypes = $validator->getDoctypes();
ksort($doctypes);
//var_dump($doctypes);
?>
<section id="doctype_list">
	<h3>List of doctypes recognised</h3>
	<select name="doctype_list" title="List of recognised Doctypes">
<?php
	foreach ($doctypes as $name => $value) {
		echo "<option>".$name."</option>";
		//echo "<code>&lt;!DOCTYPE ".$value["root_element"]." ".$value["kind"]." ".$value["fpi"]." " .$value["si"]."&gt;</code>";
	}
//var_dump($doctypes);
?>
	</select>
</section>
<section id="test">


	<?php

		// fixing github issue#1
		var_dump($validator->validate('<!DOCTYPE html PUBLIC "ISO/IEC 15445:2000//DTD HyperText Markup Language//EN">'));die();

		$dt = new Doctype_Validator();
		$result = $dt->validate("<!DOCTYPE html>")->getFragments();
		//var_dump($result);die();

	?><!--
	<pre><!DOCTYPE html></pre>
	<?php
		$dtd = '<!DOCTYPE html>';

		$result = $validator->validate($dtd);
		var_export($result);

//var_dump($validator->getValidFullDoctypesList());
	?>



	<pre><!DOCTYPE html><!DOCTYPE wap dasdasd></pre>
	<?php
/*		$dtd = '<!DOCTYPE html><!DOCTYPE wap dasdasd>';

		$result = $validator->validate($dtd);
		var_dump($result);

	*/?>

	<pre><!DOCTYPE wap dasdasd></pre>
	--><?php
/*		$dtd = '<!DOCTYPE wap dasdasd>';

		$result = $validator->validate($dtd);
		var_dump($result);
	*/?>


	<pre><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#"></pre>
	<?php
		// from babysam.dk
		$dtd = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">';

		$result = $validator->validate($dtd);
		var_export($result);
	?>




	<?php
	// Examples of DTD with errors
		// babysam.dk - includes xmlns attributes
		// <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:fb="http://ogp.me/ns/fb#">
	?>
</section>
</body>
</html>