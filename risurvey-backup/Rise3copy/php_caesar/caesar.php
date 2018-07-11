<?php
//caesar cipher php version

function caesar($input,$key){
	//part 1, declare and assign a-z to alphabet
	$alphabet="";//php variable begin with dollar sign
	//buggy code: 
	//$alphabet;
	//initiale $alphabt, or it will throw an Undefined alphebet error
	for($i='a';$i<'z';$i++){
		echo "$i";
		$alphabet.=$i;
	}
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
		$lowerCurrChar=strtolower($currChar); //convert uppercase to lowercase
		$idx=strpos($alphabet,$lowerCurrChar); //get index of current char in alphabet
		echo "<br>$idx<br>";
		echo "<br>$currChar<br>";
		if($idx!=FALSE){
			$newChar=$shiftedAlphabet[$idx];
			echo "<br>$newChar<br>";
			if(ctype_upper($currChar)) $newChar=strtoupper($newChar);
			if(ctype_lower($currChar)) $newChar=strtolower($newChar);
			$sb .= $newChar;
		}
	}
	echo "<br>$encrypted<br>";
	echo "<br>$sb<br>";
	
	return $sb;
	//
}


$input="Joe";
$key=7;
caesar($input,$key);


?>