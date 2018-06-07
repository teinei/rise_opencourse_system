<html>
<head></head>
<body>
<form method="post" action="">
	<p>input text: <input type="text" name="message"></p>
	<p>key: <input type="text" name="key"></p>
	<input type="submit" name="submit" />
</form>
</body>
</html>
<?php
//caesar cipher php version
/*
in this version i solved the 'baidu' bug which 'a' will not display because $idx=0 
count as FALSE automaticly but not the number '0'

*/

function caesar($input,$key){
	//part 1, declare and assign a-z to alphabet
	$alphabet="";//php variable begin with dollar sign
	//buggy code:
	//$alphabet;
	//initiale $alphabt, or it will throw an Undefined alphebet error
	for($i='a';$i<'z';$i++){ //test case: 'baidu', bug: no z in this string
		echo "<br>";
		echo "$i";
		$alphabet.=$i;
	}
	$alphabet.='z';
	echo "<br>\n";
	echo "$alphabet";

	//shift alphabet with given key
	//echo substr("Hello world",0,10)."<br>";
	//https://www.w3schools.com/php/func_string_substr.asp
	$shiftedAlphabet=substr($alphabet,$key).substr($alphabet,0,$key);
	echo "<br>";
	echo "$shiftedAlphabet";

	//
	$encrypted=$input;
	$sb="";//string builder
	//iterate on string characters
	for($i=0;$i<strlen($encrypted);$i++){
		//
		//$currChar="";
		$currChar = $encrypted[$i];//got current char
		//echo "<br>$currChar<br>";
		$lowerCurrChar=strtolower($currChar); //convert uppercase to lowercase
		//echo "<br>$lowerCurrChar<br>";
		$idx=strpos($alphabet,$lowerCurrChar); //get index of current char in alphabet
		
		echo "<br>$idx :";
		echo " $currChar ";
		
		/*
		if($idx=='0') {
		    $newChar=$shiftedAlphabet[0];
		    echo "idex is 0";
		}
		 */
		if($idx!=FALSE || $idx=='0'){ //baidu a bug solved
			$newChar=$shiftedAlphabet[$idx];
			//echo "got it";
			echo ": $newChar<br>";
			if(ctype_upper($currChar)) $newChar=strtoupper($newChar);
			if(ctype_lower($currChar)) $newChar=strtolower($newChar);
			$sb .= $newChar;
		}
	}
	//echo "<br>$encrypted<br>";
	//echo "<br>$sb<br>";

	return $sb;
	//
}


if(isset($_POST['message'])&&isset($_POST['key']))
{
	$input=htmlentities($_POST['message']);
	$key=htmlentities($_POST['key']);
	$output=caesar($input,$key);
	echo "<br>";
	echo "$input => $output";
}



?>
