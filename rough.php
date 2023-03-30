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
    <a class="navbar-brand" href="#">MFSDSAI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="./index.php">LogOut</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./new_associated_faculties.php">New Entry for Faculty</a>
        </li>
        <li class="nav-item">
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
  <div class="container d-flex flex-column my-5 py-5 bg-secondary text-light">
    <div class="d-flex justify-content-around">
      <div class="bg-dark m-3 p-3">
        <h3 class="text-center">Book Availablity</h3>
        <form class="p-5" action="" method="post">
          <p>Name of the book: <input type="text" name="bkname" placeholder="Enter Book Name" required="required"> </p>
          <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
          <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>
        </form>
      </div>
    </div>
    <div class="bg-success text-light text-center m-auto w-25">
      <?php
      error_reporting(E_ERROR || E_PARSE);
      if ($_POST['submit'] == "Submit") {
        $servername = "localhost";
        $port_no = 3306;
        $username = "shivam3";
        $password = "sks";
        $myDB = "PortalDB";
        try {
          $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          if (isset($_POST['bkname'])) {
            $b = $conn->query("SELECT* FROM PortalDB.books");
            $r = $conn->query("SELECT* FROM PortalDB.reserves");
            $s = $conn->query("SELECT* FROM PortalDB.students");
            $flag1 = 0;
            $b_id;
            $s_id;
            echo "Reservation status: \t";
            while ($row = $b->fetch(PDO::FETCH_ASSOC)) {
              if ($_POST['bkname'] == $row['bname']) {
                $b_id = $row['bid'];
                $flag1 = 1;
              }
            }
            while ($row = $r->fetch(PDO::FETCH_ASSOC)) {
              if ($b_id == $row['bid']) {
                $s_id = $row['sid'];
                $flag2 = 1;
              }
            }
            if ($flag2 == 1) {
              while ($row = $s->fetch(PDO::FETCH_ASSOC)) {
                if ($s_id == $row['sid']) {
                  echo "Issued by ", $row['sname'];
                }
              }
            }

            if ($flag1 == 0) {
              echo "Book is not in our repository <br>";
            }
            if ($flag2 == 0 && $flag1 == 1) {
              echo "Book is available to rent <br>";
            }
          }
        } catch (PDOException $e) {
          echo "Connection Failed <br>" . $e->getMessage();
        }
      }
      ?>
    </div>

  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>