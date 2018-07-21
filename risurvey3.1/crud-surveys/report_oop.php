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
		//var_dump($pdo);
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
			."%";
		/*
		echo "<td colspan=".$count.'"'." align='right'>"
			.sprintf("%.2f",$class_average)
			.$class_average."%";
		*/
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


	function print_report2($input_class){
		//
		include "pdo.php";
		$count=1;
		$open_date=0;
	    $ordinal=0;
	    $text1='';
	    $text2='';
	    $text3='';
		//prepare statement with placeholder
		$stmt = $pdo->prepare(" 
		SELECT survey_id, 
		open_date,
		ordinal,
		text1, text2, text3
		FROM
		surveys
		WHERE
		class_number = :class_number
		");
		//replace placeholder
		$stmt->execute(array(
		':class_number'=>$input_class
		));
		//
		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//
			$row_array=array();	
			$survey_id=htmlentities($row['survey_id']);
			//
			foreach($row as $value){
			//echo "<td>$value</td>";
			$row_array[]=$value;
			} 
			//
			//$row_array[0]:survey_id
			//$row_array[1]:open_date
			//$row_array[2]:ordinal
			//$row_array[3]:text1
			//$row_array[4]:text2
			//$row_array[5]:text3
			if($count==1){ //only assign once 
				//because these variables have same value every row
				echo "<br>";
				$open_date=$row_array[1];
				//echo "open_date: $open_date";
				$ordinal=$row_array[2];
				//echo "<br>ordinal: $ordinal";
			}
			//check if text is empty, if it is not empty
			//add '. ' to the end.
			//text1
			$text_temp=$row_array[3];
			$text_length=strlen($text_temp);
			//echo "<br>text_Length: $text_length";	
			$text1 .= $row_array[3];
			if($text_length>0) $text1 .='. ';
			//text2
			$text_temp=$row_array[4];
			$text_length=strlen($text_temp);
			$text2 .= $row_array[4];
			if($text_length>0) $text2 .='. ';
			//text3
			$text_temp=$row_array[5];
			$text_length=strlen($text_temp);
			$text3 .= $row_array[5];
			if($text_length>0) $text3 .='. ';
			//increment $count
			$count=$count+1;
		}//close while loop
		//
		echo "<hr><br>";
		echo "<span>report2: comments</span>";
		//table start
		echo "<table border='1' width='610'>";
		//row 1
		echo "<tr>";
		echo "<td>班级名称</td>";
		echo "<td><?= $input_class ?></td>";
		echo "</tr>";
		//row 2
		echo "<tr>";
		echo "<td>日期</td>";
		echo "<td><?= $open_date ?>(第<?=$ordinal?>次)</td>";
		echo "</tr>";
		//row 3
		echo "<tr>";
		echo "<td>是否按计划进行及滞后的原因</td>";
		echo "<td>是</td>";
		echo "</tr>";
		//row 4
		echo "<tr>";
		echo "<td>如果正在考虑或不打算续报下一年，具体考量的点</td>";
		echo "<td>$text1</td>";
		echo "</tr>";
		//row 5
		echo "<tr>";
		echo "<td>公开课孩子的进步点</td>";
		echo "<td>$text2</td>";
		echo "</tr>";
		//row 6
		echo "<tr>";
		echo "<td>家长建议</td>";
		echo "<td>";
		echo "$text3";
		echo "</td>";
		echo "</tr>";
		echo "</table>";//close table
		//
		//
		//
		//
	}//close print_report2 function
	//
	//
	//
	function print_report3($input_class){
		//
		//table 3
		include "pdo.php";
		$count=0;
		//prepare placeholder
		$stmt = $pdo->prepare(" 
		SELECT 
		survey_id, 
		class_number,
		ordinal,
		q11,
		d_teacher,
		co_tea
		FROM
		surveys
		WHERE
		class_number = :class_number
		");
		//replace placeholder with variable
		$stmt->execute(array(
		':class_number'=>$input_class
		));
		//
		//
		while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$row_array=array();
			//
			$survey_id=htmlentities($row['survey_id']);
			foreach($row as $value){
				if($count<1){	
					//echo "<td>$value</td>";	
				}//close if
				$row_array[]=$value;
			} //close foreach
			//
			$main_teacher=$row_array[4];
			$co_teacher=$row_array[5];
			//
			$count=$count+1;
			//$row_array expired here,
			$q11_array[]=$row_array[3];
			//echo 
			$class_number=$row_array[1];
			$ordinal=$row_array[2];
			if($row_array[3] == 1){
				$q11s1 = $q11s1+1;
			}elseif($row_array[3] == 2){
				$q11s2+=1;
			}elseif($row_array[3] ==3){
				$q11s3+=1;
			}elseif($row_array[3] ==4){
				$q11s4+=1;
			}else{
			}
			//
			$report3=array();
			//
			//echo "<tr>";
			//
		}//close while loop
		//
		$report3[]="<p>".$class_number."第".$ordinal."次公开课，<br>";
		$report3[]="应出勤人数".$count."人，<br>";
		$report3[]="实际出勤".$count."人，<br><br>";

		$report3[]=$q11s1."人已续报，<br>";
		$report3[]=$q11s2."人会续报，<br>";
		$report3[]=$q11s3."人正在考虑，<br>";
		$report3[]=$q11s4."人不续报 <br></p>";
		//$report3[]=
		//$report3[]=
		$report_email=
			"<p>".$class_number."第".$ordinal."次公开课，<br>"
			."应出勤人数".$count."人，<br>"
			."实际出勤".$count."人，<br><br>"
			.$q11s1."人已续报，<br>"
			.$q11s2."人会续报，<br>"
			.$q11s3."人正在考虑，<br>"
			.$q11s4."人不续报 <br></p>";
		echo "$report_email"."<br><br>";
		//
	}//close print_report3
	//
	//
	//
	function add_to_weekly_report_db($input_class){
		//
		include "pdo.php";
		//
		$stmt = $pdo->prepare("SELECT * FROM 
		survey_sum WHERE class_name = :xyz");
		$stmt->execute(array(":xyz" => $input_class));
		$row_pdo = $stmt->fetch(PDO::FETCH_ASSOC);
		//
		if ( $row_pdo === false && isset($_POST['class_number'])){
			//
			echo "<br>insert data";
			$sql = "INSERT INTO survey_sum ( 
			average,
			open_date, class_name,
			text1, text2, text3,
			main_teacher, co_teacher
			)VALUES ( 
			:average,
			:open_date, :class_name,
			:text1, :text2, :text3,
			:main_teacher, :co_teacher
			)";
			//
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
			':average' => $class_average,
			':open_date' => $open_date,
			':class_name' => $input_class,
			':text1'=>$text1, 	
			':text2'=>$text2,
			':text3'=>$text3,
			':main_teacher'=>$main_teacher,
			':co_teacher'=>$co_teacher
			));
			//
		}elseif($row_pdo!=false){//end if start elseif
			//
			//entry exist
			echo "<br>update data<br>";
			//update db
			$sql = "UPDATE
			survey_sum 
				SET 
			average=:average,
			open_date=:open_date, class_name=:class_name,
			text1=:text1, text2=:text2, text3=:text3,
			main_teacher=:main_teacher, co_teacher=:co_teacher
				WHERE
			class_name=:class_name";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(array(
				':average' => $class_average,
				':class_name' => $input_class,
				':open_date' => $open_date,
				':text1'=>$text1, 	
				':text2'=>$text2,
				':text3'=>$text3,
				':main_teacher'=>$main_teacher,
				':co_teacher'=>$co_teacher
			));
			//
			//
		}else{
			//
			echo '<p style="color:red">'."bada data".'</p>';
		}
		//close else
	}//close function add_to_weekly_report_db()
	//
	//
	//
	function dir_name($input_class){
		//
		echo "<br><br>$input_class"
			."第"."$ordinal"."次公开课_"
			."$open_date"."_"
			."$main_teacher"."_"."$co_teacher<br><br><br>";
		//
	}
	//
	//
} //close Report class
?>