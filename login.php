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
        <a class="navbar-brand" href="/index.php">MFSDSAI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./registration.php">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="./login.php">Login</a>
                </li>

        </div>
    </nav>

    <div class="container d-flex flex-column align-items-center my-5 p-5 bg-secondary text-light">
        <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
            <h3 class="text-center">Login Yourself</h3>
            <form class="p-5" action="" method="post">
                <p> Email(official): <input type="text" name="email" placeholder="Enter your E-mail"></p>
                <p> Password: <input type="password" name="password" placeholder="Enter your Password"></p>
                <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>
            </form>
        </div>
        <div class="bg-danger text-light text-center  m-auto w-50" style="border-radius:15px">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            $flag = 0;
            $servername = "localhost";
            $port_no = 3306;
            $username = "id20433779_shivam";
            $password = "Portaldb@123";
            $myDB = "id20433779_PortalDB";
            //Name of the database to access
            try {
                $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stm = $conn->query("SELECT * FROM id20433779_portaldb.userdata");

                while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                    if ($_POST['email'] == $row['email'] && md5($_POST['password']) == $row['password']) {
                        $flag = 1;
                        echo "<br>Logged in Successful<br>";
                        header('Location: about.php');
                        // or die();
                        exit();
                    }
                }

                if ($flag == 0 && isset($_POST['email'])) {
                    echo "<br>Email or Password is incorrect<br>";
                }
            } catch (PDOException $e) {
                echo "<br>Connection failed: " . $e->getMessage();
            }
            // echo "<br>";
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
