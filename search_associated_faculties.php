<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>MFSDSAI</title>
  <style>
  </style>
</head>

<body class="bg-info">
  <div class="bg-primary p-2 text-light">
    <h2>
      Mehta Family School of Data Science and Artificial Intelligence <br> IIT GUWAHATI
    </h2>
    <h3>
      Welcome to our Information Portal
    </h3>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/about.php">MFSDSAI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">LogOut</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./new_associated_faculties.php">New Entry for Faculty</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="./search_associated_faculties.php">Search for Faculty</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./queries.php">Courses Departments & Instructor</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./library.php">Library</a>
        </li>

    </div>
  </nav>
  <div class="d-flex flex-column my-5 py-5 bg-secondary text-light">
    <div class="d-flex justify-content-around flex-wrap">
      <div class="bg-dark m-5 p-3" style="flex:1; border-radius:50px">
        <h3 class="text-center">Search by Faculty Name</h3>
        <form class="p-5" action="" method="post">
                        <p> Name: <input type="text" name="name" placeholder="Enter Name" required="required">
                        </p>
          <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
          <button type="submit" value="Submit" name="submit1" class="btn btn-success m-2">Submit</button>

        </form>
      </div>
      <div class="bg-dark m-5 p-3" style="flex:1; border-radius:50px">
        <h3 class="text-center">Search by Department Name</h3>
        <form class="p-5" action="" method="post">
        
                        <p> Department Name: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                        </p>
          <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
          <button type="submit" value="Submit" name="submit2" class="btn btn-success m-2">Submit</button>

        </form>
      </div>

    </div>
    <div class="bg-success text-light text-center  m-auto w-50" style="border-radius:15px">
      <?php
      error_reporting(E_ERROR | E_PARSE);
      $flag = 0;
      $servername = "localhost";
      $port_no = 3306;
      $username = "id20433779_shivam";
      $password = "Portaldb@123";
      $myDB = "id20433779_portaldb";

      //Name of the database to access
      try {
        $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $s = $conn->query("SELECT * FROM id20433779_portaldb.associated_faculties");
        $t = $conn->query("SELECT * FROM id20433779_portaldb.works_in");
        $u = $conn->query("SELECT * FROM id20433779_portaldb.department");
        if ($_POST['submit1'] == "Submit") {
          $flag1 = 0;
          $dep;
          $id;
          $did;
          while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
            if ($_POST['name'] == $row['NAME']) {
              $flag1 = 1;
              $id = $row['ID'];
              echo " Name:-  ", $row['NAME'], "<br> Email:- ", $row['EMAIL'], "<br> Phone No.:- ", $row['PHONE'];
            }
          }
          while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
            if ($id == $row['ID']) {
              $did = $row['DID'];
            }
          }
          while ($row = $u->fetch(PDO::FETCH_ASSOC)) {
            if ($did == $row['DID']) {
              $dep = $row['DNAME'];
              echo "<br>Department:- ", $dep, "<br>";
            }
          }
          if ($flag1 == 0) {
            echo "No Such Name exists<br>";
          }
        }
        if ($_POST['submit2'] == "Submit") {
          $did;
          $id = array();
          $flag2 = 0;
          // $stm = $conn->query("SELECT * FROM id20433779_portaldb.department");
          while ($row = $u->fetch(PDO::FETCH_ASSOC)) {
            if ($_POST['department'] == $row['DNAME']) {
              $did = $row['DID'];
              $flag2 = 1;
              echo "<h3>{$_POST['department']}</h3>";
            }
          }
          while ($row = $t->fetch(PDO::FETCH_ASSOC)) {
            if ($did == $row['DID']) {
              $id[] = $row['ID'];
            }
          }
          while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
            for ($x = 0; $x < count($id); $x++) {
              if ($id[$x] == $row['ID']) {
                echo "Name:-  ", $row['NAME'], "<br> Email:- ", $row['EMAIL'], "<br> Phone No.:- ", $row['PHONE'], "<br><br>";
              }
            }
          }
          if ($flag2 == 0) {
            echo "No Such Department exists<br>";
          }
        }


        // echo $_POST['department'], $d;

      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
      ?>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>