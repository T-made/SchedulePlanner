<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <title>Student Management System</title>
  <link href = "../css/style.css" rel="stylesheet" type="text/css">

</head>
<body>
<div class="admintitle">
<h1 align = "center" >Welcome to Schedule Planner </h1>

<!--In order to take an input we need to make a form -->
<form method="POST" >
<!-- table for alignment -->
<table style="width:30%;" align="center" border="1">
   <tr>
    <td colspan="2" align="center" style="color:black;"> Student Information </td>
   </tr>
      <tr>
     <td align ="left" style="color:black;">Choose Year</td>
     <td>
        <select name="std" required>
         <option value = "1">Freshman</option>
         <option value = "2">Sophomore</option>
         <option value = "3">Junior</option>
         <option value = "4">Senior</option>


        </select>
     </td>

      </tr>
      <tr>
       <td align="left"style="color:black;">Enter 700#</td>
         <td>
        <input type="text" name="rollno" required></td>
      </tr>
      <tr>
      <td colspan="2" align="center" > <input type="submit" name="submit" value="Show info"</td>
    </tr>
</table>
</form>
</div>
</body>
</html>
