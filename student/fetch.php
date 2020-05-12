<?php
session_start();
include('../dbcon.php');
$output = '';
if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($con, $_POST["query"]);
    $query = "
	SELECT * FROM major_classes
	WHERE courseAbrv LIKE '%".$search."%'
	OR courseName LIKE '%".$search."%' 
	";
}
else
{
    $query = "SELECT major_classes.courseAbrv, major_classes.courseName, major_classes.creditHours FROM major_classes JOIN courses_major_xref ON major_classes.courseId = courses_major_xref.course_id JOIN elective_groups ON courses_major_xref.elective_group_id = elective_groups.elective_group_id WHERE elective_groups.elective_group_name='Cybersecurity Core'";
}
$result = mysqli_query($con, $query);
if(mysqli_num_rows($result) > 0)
{
    $output .= '
	    		<div class="table-responsive">
					<table style="border-collapse:collapse padding-left:100px padding-right:100px" class="table table-hover table-sm table-bordered table-dark table-striped">
						<tr class="grid_4">
							<th>Course ID</th>
							<th>Course Name</th>
							<th>Number of Credits</th>
						</tr>
						';
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
			<tr>
				<td>'.$row["courseAbrv"].'</td>
				<td>'.$row["courseName"].'</td>
				<td>'.$row["creditHours"].'</td>
				<td>
					<button id="button" style="background-color: black" class="btn btn-danger btn-sm mt-auto" type="button" onClick=addClass(\''.$row["courseAbrv"].'\',\''.$row["courseName"].'\',\''.$row["creditHours"].'\')>Add</button>
				</td>
			</tr>
		';
    }
    echo $output;
}
else
{
    echo 'Data Not Found';
}
?>