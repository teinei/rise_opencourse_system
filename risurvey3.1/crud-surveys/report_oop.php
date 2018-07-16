<?php
//require_once "pdo.php";
//report oop
//http://www.php.cn/php-weizijiaocheng-360746.html
class Report{
	//
	var $input_class='';
	//report1 variables
	var $student_names=array();
	var $q1=array();
	var $q2=array();
	var $q3=array();
	var $q4=array();
	var $q5=array();
	//
	//report1 var set 2
	var $class_total=0;
	var $row_average=0;
	var $count=0;
	//
	//report2 vars
	var $open_date=0;
	var $ordinal=0;
	var $text1='';
	var $text2='';
	var $text3='';
	//
	//report3 vars
	var $q11_array=array();
	var $q11s1=0;//for those choose 1
	var $q11s2=0;//choose 2
	var $q11s3=0;//choose 3 of q11
	var $q11s4=0;//choose 4
	//
	var $main_teacher=0;
	var $co_teacher=0;
	//
	//
	function print_report1($input_class){
		//require_once "pdo.php";
		include "pdo.php";
		//echo "$pdo";
		var_dump($pdo);
		//table header
		echo "<br><br>"."<hr><br>"."<span>report1: everage</span>";
		//table open
		echo "<table border='1'>";
		
		$count=0;
		$class_total=0;
		
		//read questions from db
		//prepare sql select has :placeholder
		$stmt = $pdo->prepare(" 
		SELECT 
			survey_id, 
			student_name,
			q1, q2, q3, q4, q5,
			average
		FROM
			surveys
		WHERE
			class_number = :class_number
		");
		//replace :var to $var
		$stmt->execute(array(
			':class_number'=>$input_class
		));
		
		//print report1
		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//loop through $stmt key-values pairs
			$row_array=array();//
			foreach($row as $value){
				//echo "<td>$value</td>";
				$row_array[]=$value;
			} 
			//
			$survey_id=htmlentities($row['survey_id']);
			$student_names[]=$row_array[1];
			$q1[]=$row_array[2];
			$q2[]=$row_array[3];
			$q3[]=$row_array[4];
			$q4[]=$row_array[5];
			$q5[]=$row_array[6];
			
			//calculate everage
			$class_total = $class_total+$row_array[7];
			$count=$count+1;
			$class_average=$class_total/$count*10;
			$class_average=number_format($class_average,2);//take 2 digits after decimal point
			//end of while body
		}//close while loop
		//
		echo "<tr>";
		echo "<td>人数\项目</td>";
		//
		for($i=0;$i<$count;$i++){
			$a=$i+1;
			echo "<td align='center'>$a</td>";
		}
		//
		echo "</tr>";
		
		echo "<tr><td>姓名</td>";
		foreach($student_names as $name){
			//echo "<td width='50' align='center'>$name</td>";
			echo "<td align='center'>$name</td>";
		} 		
		echo "</tr>";
		
		echo "<tr>";//q1
		echo "<td>1.您对此次公开课的评价是？</td>";
		foreach($q1 as $q){
			echo "<td align='center'>$q</td>";
		}
		echo "</tr>";
		
		//
		echo "<tr>";//q1
		echo "<td>";
		echo "2.您对班级老师的授课满意度如何？";
		echo "</td>";
		foreach($q2 as $q){
			echo "<td align='center'>$q</td>";
		} 
		echo "</tr>";
		
		//q3
		echo "<tr>";
		echo "<td>";
		echo "3.您觉得班级老师对孩子的关爱程度如何？";
		echo "</td>";

		foreach($q3 as $q){
			echo "<td align='center'>$q</td>";
		} 

		echo "</tr>";//q4
		echo "<tr>";
		echo "<td>";
		echo "4.您对老师定期与您沟通孩子学习情况的满意度如何？";
		echo "</td>";
		foreach($q4 as $q){
			echo "<td align='center'>$q</td>";
		} 
		echo "</tr>";
		
		echo "<tr>";//q5
		echo "<td>";
		echo "5.您对中心整体教学服务质量的满意度如何？";
		echo "</td>";
		foreach($q5 as $q){
			echo "<td align='center'>$q</td>";
		} 
		//$colspan=$count-1;
		echo "</tr>";
		
		echo "<tr>";//average
		echo "<td>";
		echo "平均值";
		echo "</td>";
		//
		/*
		echo "<td colspan='<?='".$count.'?>'. "align='right'>"
			.sprintf("%.2f",$class_average)
			.$class_average."%";
		*/
		//
		echo "<td colspan=".$count.'"'." align='right'>"
			.sprintf("%.2f",$class_average)
			.$class_average."%";
		/*
		<td colspan="<?=$count?>" align="right">
		<?=$class_average?>%
		*/
		echo "</td>";
		echo "</tr>";
		echo "</tr>";

		//
		//end of table
		echo "</table>";
		/**/
	} //close print report1 function
	//
	//
	//
} //close Report class

?>
<form method="post">
		<p>which class
		<input type="text" name="class_number">
		</p>
		<input type="submit" value="Start Queue"/>
</form>

<?php
//$input_class_form='';
$input_class='';
if(isset($_POST['class_number'])){
    echo "class_number is set<br>";
	$input_class=$_POST['class_number'];
    //echo "input_class is : $input_class_form";
	echo "input_class is : $input_class";
}
	//
?>

<?php
//
$report1 = new Report();
//$report1->$input_class=$input_class;
$report1->print_report1($input_class);
?>