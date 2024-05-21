<html>
<head><title> <h1>School Certification Form</h1> </title></head>
<style>
  
body {
    background-image: url('https://wallpaperaccess.com/full/2474789.png');
}
</style>
<style>
  body {
    color: white;
  }
</style>

<h1 align="center"> University Certification </h1> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <table border="5" cellpadding="5" cellspacing="1">
<form method="post" action="assign3.php">
    


    <br><hr><br>
    <fieldset>
        <label for="idno">ID Number:</label>
        <input type="number" id="idno" name="idno" min="1111" max="9999" value="<?php echo isset($_POST['idno']) ? $_POST['idno'] : '' ?>" required><br><br>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" name="fname" pattern="[A-Za-z]{2,10}" title="must be between 2 - 10 letters" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : '' ?>" required size="12"> 
        <label for="mname">Middle Name:</label>
        <input type="text" id="mname" name="mname" pattern="[A-Za-z]{2,10}" title="must be between 2 - 10 letters" value="<?php echo isset($_POST['mname']) ? $_POST['mname'] : '' ?>" required size="12"> 
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" name="lname" pattern="[A-Za-z]{2,10}" title="must be between 2 - 10 letters" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : '' ?>" required size="12"><br><br>

        <label>Gender:</label>
        <input type="radio" id="male" name="gender" checked required value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") echo "checked"; ?>>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") echo "checked"; ?>>
        <label for="female">Female</label><br><br>
        <?php 
            echo "<font size=4 color=darkred>"."* Please select your gender"."</font>";
        ?>
    </fieldset>
    <br><hr>
    <fieldset>
    <fieldset>
<label>Courses: </label> 
<input type="checkbox" id="Science" name="courses[]" required checked value="Science" <?php if(isset($_POST['courses']) && in_array("Science", $_POST['courses'])) echo "checked"; ?>><label for="Science">Science</label>
<input type="checkbox" id="English" name="courses[]" required checked value="English" <?php if(isset($_POST['courses']) && in_array("English", $_POST['courses'])) echo "checked"; ?>><label for="English">English</label>
<input type="checkbox" id="Math" name="courses[]" required checked value="Math" <?php if(isset($_POST['courses']) && in_array("Math", $_POST['courses'])) echo "checked"; ?>><label for="Math">Math</label>
<input type="checkbox" id="PE" name="courses[]" required checked value="PE" <?php if(isset($_POST['courses']) && in_array("PE", $_POST['courses'])) echo "checked"; ?>><label for="PE">PE</label><br><br>

<label for ="Science">Science Mark: </label><input type="number" min="35" max="99" required id="Science" name="n1" value="<?php echo isset($_POST['n1']) ? $_POST['n1'] : '' ?>"><br><br>
<label for ="English">English Mark: </label><input type="number" id="English" min="35" max="99" required name="n2" value="<?php echo isset($_POST['n2']) ? $_POST['n2'] : '' ?>"><br><br>
<label for ="Math">Math Mark: </label><input type="number" id="Math" min="35" max="99" required name="n3" value="<?php echo isset($_POST['n3']) ? $_POST['n3'] : '' ?>"><br><br>
<label for ="PE">PE Mark: </label><input type="number" id="PE" min="35" max="99" required name="n4" value="<?php echo isset($_POST['n4']) ? $_POST['n4'] : '' ?>"><br><br>

</fieldset>
<br><hr>
<textarea id="remark" name="remark" cols="45" rows="8"><?php echo isset($_POST['remark']) ? $_POST['remark'] : '' ?></textarea><br><br>
<label for="genders">Select a gender or math score for menu driven:</label>
  <select name="genders">
    <option value="">All Students</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
  </select>
  <select name="math">
    <option value="">All Scores</option>
    <option value="80">80+</option>
    <option value="90">90+</option>
  </select>
<hr><br>
<input type="submit" value="Send Data" style="width: 200px; height: 50px;"> <br><br> <hr><br> 
<h3>MYSQL:</h3>

</form>
</body>
</html>

<?php
$idno = $_POST['idno'];
$fname = $_POST['fname'];
$mname = $_POST['mname'];
$lname = $_POST['lname'];
$gender = $_POST['gender'];
$courses = implode(", ", $_POST['courses']);
$n1 = $_POST['n1'];
$n2 = $_POST['n2'];
$n3 = $_POST['n3'];
$n4 = $_POST['n4'];
$remark = $_POST['remark'];
$genders = $_POST['genders'];
$math = $_POST['math'];
$k = mysqli_connect("localhost", "root") or die("couldn't connect to mysql server");
if ($k == true) {
  echo ("connection established");
} else {
  echo ("connection not established");
}
echo ("<br>");


$a = "CREATE DATABASE NASSER";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("DATABASE IS CREATED");
} else {
  echo "DATABASE CREATION: " . mysqli_error($k);
}
echo ("<br>");

$a = "USE NASSER";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("DATABASE CALLED NASSER IS BEING USED");
} else {
  echo "There's an error: " . mysqli_error($k);
}
echo ("<br>");

$a = "CREATE TABLE student (
    idno INT(4) PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(10) NOT NULL,
    mname VARCHAR(10) NOT NULL,
    lname VARCHAR(10) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    courses VARCHAR(50) NOT NULL,
    science INT(3) NOT NULL,
    english INT(3) NOT NULL,
    math INT(3) NOT NULL,
    PE INT(3) NOT NULL,
    remark VARCHAR(50) NOT NULL
)";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("table is created");
} else {
  echo "Query execution failed: " . mysqli_error($k);
}

$a = "insert into student values ('$idno' ,'$fname','$mname','$lname','$gender','$courses','$n1','$n2','$n3','$n4','$remark')";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("values are inserted");
} else {
  echo "Query execution failed: " . mysqli_error($k);
}
$a="update student set science='$n1' where idno=1114";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("Updated Successfully");
} else {
  echo "Query execution failed: " . mysqli_error($k);
}
$a="update student set mname='$mname' where idno=1112";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("Updated Successfully");
} else {
  echo "Query execution failed: " . mysqli_error($k);
}
$select0 = "select * from student";
$a1=mysqli_query($k,$select0);
if ($a1) {
  while ($row = mysqli_fetch_array($a1, MYSQLI_BOTH)) {
  echo "<br>"."<br>"."<br>";
  echo "ID Number = " . $row['idno'] . "<br>";
  echo "Full Name: " . $row["fname"] . " " . $row["mname"] . " ". $row["lname"] . "<br>";
  echo "Gender = " . $row['gender'] . "<br>";
  echo "Courses = " . $row['courses'] . "<br>";
  echo "Science = " . $row['science'] . "<br>";
  echo "English = " . $row['english'] . "<br>";
  echo "Math = " . $row['math'] . "<br>";
  echo "PE = " . $row['PE'] . "<br>";
  echo "Remark = " . $row['remark'] . "<br>";
  echo "<br>";
  }
  }
 else {
  echo "Query execution failed: " . mysqli_error($k);
}

$a = "alter table student add avg float(4,2) after PE";
$a1 = mysqli_query($k, $a);
if ($a1) {
  echo "column added";
} else {
  echo "Query execution failed: " . mysqli_error($k);
}

$a="alter table student add avgrank varchar(2) after avg";
$a1 = mysqli_query($k, $a);
if ($a1) {
  echo "column added";
} else {
  echo "Query execution failed: " . mysqli_error($k);}


$a="delete from student where idno='$idno'";
$a1=mysqli_query($k,$a);
if($a1) { echo "Row deleted";}
else {
  echo "Query execution failed: " . mysqli_error($k);
}
$a="alter table student modify remark varchar(50)";
$a1=mysqli_query($k,$a);
if($a1) { echo "Column modified";}
else {
  echo "Query execution failed: " . mysqli_error($k);
}
$a = "insert into student(idno,fname,mname,lname,gender,courses,science,english,math,pe,remark)
values ('$idno' ,'$fname','$mname','$lname','$gender','$courses','$n1','$n2','$n3','$n4','$remark')";
$a1 = mysqli_query($k, $a);
if ($a1 == true) {
  echo ("values are inserted");
} else {
  echo "Query execution failed: " . mysqli_error($k);
}
$updatee = "UPDATE student SET avg = (science+english+math+PE)/4, avgrank = 
  CASE 
    WHEN (avg >= 90 AND avg <= 99) THEN 'A'
    WHEN (avg >= 80 AND avg <= 89.9) THEN 'B'
    WHEN (avg >= 70 AND avg <= 79.9) THEN 'C'
    WHEN (avg >= 60 AND avg <= 69.9) THEN 'D'
    ELSE 'F'
  END";
$a1 = mysqli_query($k, $updatee);
if ($a1) {
  echo "column updated";
} else {
  echo "Query execution failed: " . mysqli_error($k);
}
$select0 = "select * from student";
$a1 = mysqli_query($k, $select0);
if ($a1) {
  while ($row = mysqli_fetch_array($a1, MYSQLI_BOTH)) {
  echo "<br>"."<br>"."<br>";
  echo "ID Number = " . $row['idno'] . "<br>";
  echo "Full Name: " . $row["fname"] . " " . $row["mname"] . " ". $row["lname"] . "<br>";
  echo "Gender = " . $row['gender'] . "<br>";
  echo "Courses = " . $row['courses'] . "<br>";
  echo "Science = " . $row['science'] . "<br>";
  echo "English = " . $row['english'] . "<br>";
  echo "Math = " . $row['math'] . "<br>";
  echo "PE = " . $row['PE'] . "<br>";
  echo "Remark = " . $row['remark'] . "<br>";
  echo "Average = " . $row['avg'] . "<br>";
  echo "Average Rank = " . $row['avgrank'] . "<br>";
  echo "<br>";
  }
  }
 else {
  echo "Query execution failed: " . mysqli_error($k);
}
if ($genders == 'male') {
  $sql = "SELECT * FROM student WHERE gender = 'male'";
} elseif ($genders == 'female') {
  $sql = "SELECT * FROM student WHERE gender = 'female'";
} elseif ($math == '80') {
  $sql = "SELECT * FROM student WHERE math >= 80";
} elseif ($math == '90') {
  $sql = "SELECT * FROM student WHERE math >= 90";
}  else {
  $sql = "SELECT * FROM student";
}

$results = mysqli_query($k, $sql);
if ($results) {
  while ($row = mysqli_fetch_array($results, MYSQLI_BOTH)) {
    echo "ID: " . $row["idno"] . " - Name: " . $row["fname"] . " " . $row["mname"] . " ". $row["lname"] . "<br>";
  }
} else {
  echo "0 results";
}
mysqli_close($k);
?>


