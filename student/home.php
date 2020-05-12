<?php
  session_start();
  //now here we need to check whether it is accessing or not
 // if(isset($_SESSION['uid'])){

 // }//if not then we will redirect it to login page.
 // else{
  //../ means if the session destroy and you are again accessing the
  //student home page then it will redirect you to the login page to login first
 // header('location:../login.php');
//}
?>

<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Management System</title>
  <link href = "../css/style.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>
<body>
    <nav class="admintitle">
    <h1 align = "center" >Welcome to Schedule Planner </h1>
    <h4><a href="../logout.php" style="float:right; padding-right: 60px; color:#fff; font-size:20px;">Logout</a></h4>
    </nav>

    <br>
    <br>

    <?php
      include('../dbcon.php');
      $sql = "SELECT major_classes.courseAbrv, major_classes.courseName, major_classes.creditHours FROM major_classes JOIN courses_major_xref ON major_classes.courseId = courses_major_xref.course_id JOIN elective_groups ON courses_major_xref.elective_group_id = elective_groups.elective_group_id WHERE elective_groups.elective_group_name='Computer Science Core'";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        echo "<div style=\"padding-left: 50px \">
                <table id = \"compSciCore\" style=\"width: auto;\" class=\"table table-hover table-sm table-bordered table-dark table-striped\">
                  <tr><td colspan=\"5\" style=\"text-align:center\">Computer Science Core Classes</td></tr>
                  <tr>
                    <th> Course Abrv </th>
                    <th> Course Name </th>
                    <th> Credits </th>
                    <th> Add/Remove </th>
                  </tr>";
      //Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row["courseAbrv"]."</td>
                  <td>".$row["courseName"]."</td>
                  <td>".$row["creditHours"]."</td>
                  <td>
                    <button id=\"button\" style=\"background-color: black\" class=\"btn btn-danger btn-sm mt-auto\"  type=\"button\" onClick=addClass()>Add</button>
                  </td>                  
                </tr>";
        }
        echo "</table> </div>";
      } else {
        echo "0 results";
      }

      $con->close();
    ?>
    <br>
    <div style="padding-left:1200px">
      <table  id= "schedule" style="width:auto" class="table table-hover table-sm table-bordered table-dark table-striped">
        <tr><td>Spring 2020 Schedule</td></tr>
        <tr>
          <th> Course Abrv </th>
          <th> Course Name </th>
          <th> Credits </th>
          <th> Add/Remove </th>
        </tr>
      </table>
    </div>
    <?php
      include('../dbcon.php');
      $sql = "SELECT major_classes.courseAbrv, major_classes.courseName, major_classes.creditHours FROM major_classes JOIN courses_major_xref ON major_classes.courseId = courses_major_xref.course_id JOIN elective_groups ON courses_major_xref.elective_group_id = elective_groups.elective_group_id WHERE elective_groups.elective_group_name='Software Engineering Core'";
      $result = $con->query($sql);

      if ($result->num_rows > 0) {
        echo "<div style=\"padding-left: 50px \">
                <table id = \"softEngCore\" style=\"width: auto;\" class=\"table table-hover table-sm table-bordered table-dark table-striped\">
                  <tr><td colspan=\"5\" style=\"text-align:center\">Software Engineering Core Classes</td></tr>
                  <tr>
                    <th> Course Abrv </th>
                    <th> Course Name </th>
                    <th> Credits </th>
                    <th> Add/Remove </th>
                  </tr>";
      //Output data of each row
        while($row = $result->fetch_assoc()) {
          echo "<tr>
                  <td>".$row["courseAbrv"]."</td>
                  <td>".$row["courseName"]."</td>
                  <td>".$row["creditHours"]."</td>
                  <td>
                    <button id= \"button\" style=\"background-color: black\" class=\"btn btn-danger btn-sm mt-auto\" type=\"button\" onClick=addClass()>Add</button>
                  </td>
                </tr>";
        }
        echo "</table> </div>";
      } else {
        echo "0 results";
      }

      $con->close();
    ?>    
    <br>
    <br>
    <div class="container">
        <br />
        <h2 align="center">Search All Classes Below</h2>
        <div class="form-group">
          <div class="input-group">
              <input type="text" name="search_text" id="search_text" placeholder="Enter course name, or course code" class="form-control" />
          </div>
        </div>  
    </div>
    <br />
    <div id="result"></div>
</body>
</html>

<script>
    $(document).ready(function(){
        load_data();
        function load_data(query){
            $.ajax({
                url:"fetch.php",
                method:"post",
                data:{query:query},
                success:function(data){
                    $('#result').html(data);
                }
            });
        }

        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }
            else{
                load_data();
            }
        });
    });

    function addClass(){
      var table1 = document.getElementById("compSciCore"),
      table2 = document.getElementById("schedule"),
      buttons = document.getElementById("button");

      console.log("Val1 = " + buttons.length);
        for(var i = 0; i < buttons.length; i++){
          if(buttons[i].onClick){
            var newRow = table2.insertRow(table2.length),
            cell1 = newRow.insertCell(0),
            cell2 = newRow.insertCell(1),
            cell3 = newRow.insertCell(2),
            cell4 = newRow.insertCell(3);

            cell1.innerHTML = table1.rows[i+1].cells[0].innerHTML;
            cell2.innerHTML = table1.rows[i+1].cells[1].innerHTML;
            cell3.innerHTML = table1.rows[i+1].cells[2].innerHTML;
            cell4.innerHTML = "<button id='button' type='button' onClick=removeClass()>Remove</button>";
          }
        }
    }




</script>
