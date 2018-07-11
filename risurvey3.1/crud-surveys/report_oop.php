<?php
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
	function print_report1($student_names){
		//table header
		echo "<br><br>"."<hr><br>"."<span>report1: everage</span>";
		echo "<table border='1'>";
		echo "<tr>";
		echo "<td>人数\项目</td>";
		echo "</tr>";
		echo "<tr><td>姓名</td>";

		foreach($student_names as $name){
			echo "<td width='50' align='center'>$name</td>";
		} 

		echo "</tr>"
		echo "<tr>";
		echo "<td>1.您对此次公开课的评价是？</td>";
	<?php
	foreach($q1 as $q){
		echo "<td align='center'>$q</td>";
	} 
	?>
</tr>
		//
	}
//close Report class	
}

?>

















