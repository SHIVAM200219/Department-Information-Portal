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
                <li class="nav-item active">
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
    <div class="container d-flex flex-column align-items-center my-5 p-5 bg-secondary text-light">
    <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
            <h3 class="text-center">Enter details of New Faculty</h3>
            <form class="p-5" action="" method="post">
                <p> Name: <input type="text" name="name" placeholder="Enter Name" required="required">
                </p>
                <p> Email(official): <input type="text" name="email" placeholder="Enter E-mail" required="required">
                </p>
                <p> Phone Number: <input type="text" name="phone" placeholder="Enter Phone Number" required="required">
                </p>
                <p> Department: <input type="text" name="department" placeholder="Enter Department Name" required="required">
                </p>
                <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>

            </form>
        </div>
        <div class="bg-danger text-light text-center  m-auto w-50" style="border-radius:15px">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            if ($_POST['submit'] == "Submit") {
                $servername = "localhost";
                $port_no = 3306;
                $username = "id20433779_shivam";
                $password = "Portaldb@123";
                $myDB = "id20433779_portaldb";
                try {
                    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    // echo "Connected successfully<br>";
                    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['department']) && isset($_POST['phone'])) {
                        $dep_data = $conn->query("SELECT * FROM id20433779_portaldb.department");
                        $d;
                        $id;
                        $flag = 0;
                        while ($row = $dep_data->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['department'] == $row['DNAME']) {
                                $d = $row['DID'];
                                $sql_asfc = "INSERT INTO id20433779_portaldb.associated_faculties( NAME, EMAIL, PHONE) VALUES (:name, :email, :phone)";
                                $asfc_data = $conn->prepare($sql_asfc);
                                $asfc_data->EXECUTE(
                                    array(
                                        ':name' => $_POST['name'],
                                        ':email' => $_POST['email'],
                                        ':phone' => $_POST['phone']
                                    )
                                );
        
                                $asfc_dat = $conn->query("SELECT * FROM id20433779_portaldb.associated_faculties");
                                while ($row = $asfc_dat->fetch(PDO::FETCH_ASSOC)) {
                                    if ($_POST['email'] == $row['EMAIL']) {
                                        $id = $row['ID'];
                                        $sql_works = "INSERT INTO id20433779_portaldb.works_in(ID, DID) VALUES (:id, :did)";
                                        $works_data = $conn->prepare($sql_works);
                                        $works_data->EXECUTE(
                                            array(
                                                ':id' => $id,
                                                ':did' => $d
                                            )
        
                                        );
                                        echo "Registered successfully<br>";
                                        $flag = 1;
                                    }
                                }
                            }
                        }
                        if ($flag == 0) {
                            echo "No Such Department exists<br>";
                        }
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
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