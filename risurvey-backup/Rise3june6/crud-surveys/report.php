<?php
require_once "pdo.php";
session_start();
?>

<p>survey summary and report</p>
<form method="post">

<p>which class
<input type="text" name="class_number">
</p>

<p><input type="submit" value="Start Queue"/>

</form>


<?php
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
    $input_class=$_POST['class_number'];
    $flag2=0;
    echo "input_class is : $input_class<br><br>";
//
    //    $stmt = $pdo->query("
    //  buggy code: I use query rather than prepare

    $stmt = $pdo->prepare("
SELECT `survey_id`, 
`average`,`q11`, `text1`,`text2`,`text3`, 
`student_name`,`d_teacher`,
`co_tea`,`open_date`,`ordinal`,`class_number`
FROM
`surveys`
WHERE
`class_number` = :class_number
    ");

    $stmt->execute(array(
        ':class_number'=>$input_class
    ));
    
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
	
	$survey_id=htmlentities($row['survey_id']);

	foreach($row as $value){
        echo "$value<br>";
	} 
    echo"<br>";
}

}

?>

