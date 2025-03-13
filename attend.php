<?php
echo "<link rel='stylesheet' href='attendStyle.css'>";
require_once("config.php");
$firstDayOfMonth = date("1-m-Y");
$totalDaysInMonth = date("t", strtotime($firstDayOfMonth));

$sql = "SELECT * FROM tableform";
$fetchingStudents = mysqli_query($con, $sql);

$totalNumberOfStudents = mysqli_num_rows($fetchingStudents);

$studentNamesArray = array();
$studentIdsArray = array();
$count=0;
while($students = mysqli_fetch_assoc($fetchingStudents)){
    $studentNamesArray[]= $students['name'];
    $studentIdsArray[] = $students['id'];
}

?>
    <div class="sidebar">
        <h3>Menu</h3>
        <a href="#" class="option">📋 Attendance</a>
        <a href="#" class="option">📂 Work</a>
    </div>

<?php
include('nav.php');
?>

<div class="attendance-container">
<center><h1 class="heading-attendance">ATTENDANCE MANAGEMENT SHEET</h1></center>
<h3 class="month-attendance">STUDENTS ATTENDANCE MONTH:
<u><font color="red">
    <?php echo strtoupper(date("F", strtotime($firstDayOfMonth))); ?>
</font></u>
</h3>

<table border="1" cellspacing="0" class="table-attendance">
<?php
    for($i=1; $i<=$totalNumberOfStudents+2; $i++){

        if($i == 1){
            echo "<tr>";
            echo "<td rowspan='2'>Name</td>";
                for($j=1; $j<=$totalDaysInMonth; $j++){
                    echo "<td>".$j."</td>";
                }
            echo "</tr>";
        }else if($i == 2){
            echo "<tr>";
            for($j=1; $j<=$totalDaysInMonth; $j++){
                date_default_timezone_set("Asia/Kolkata");
                echo "<td>". date("D",strtotime("+$j Days", strtotime($firstDayOfMonth))) ."</td>";
            }
            echo "</tr>";
        }
        else{
            echo "<tr>";
            echo "<td>".$studentNamesArray[$count]."</td>";
                for($j=1; $j<=$totalDaysInMonth; $j++){
                    echo "<td><select><option></option><option value='p'>P</option><option value='p'>A</option><option value='p'>L</option><option value='p'>H</option></select></td>";
//                    $dateOfAttendance = date("Y-m-$j");
//                    $query = "SELECT attendance FROM attend WHERE id='".$studentIdsArray[$count]."' AND cur_date = '".$dateOfAttendance."'";
//                    $fetchingStudentsAttendance = mysqli_query($con,$query) or die(mysqli_error($con));
//                    $isAttendanceAdded = mysqli_num_rows($fetchingStudentsAttendance);
//                    if($isAttendanceAdded > 0){
//                        $studentAttendance = mysqli_fetch_assoc($fetchingStudentsAttendance);
//                        echo "<td>".$studentAttendance['attendance']."</td>";
//                    }
//                    else{
//                        echo "<td></td>";
//                    }

                }
            echo "</tr>";
            $count++;
        }

    }
?>
</div>
</table>