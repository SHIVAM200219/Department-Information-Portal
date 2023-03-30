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
                    <a class="nav-link active" href="./registration.php">Registration</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>

        </div>
    </nav>


    <div class="container d-flex flex-column align-items-center my-5 p-5 bg-secondary text-light">
    <div class="bg-dark m-3 p-3" style="flex:1; border-radius:50px">
            <h3 class="text-center">Register Yourself</h3>
            <form class="p-5" action="" method="post">
                <p class="p-1"> First Name: <input type="text" name="first_name" placeholder="Enter your First Name" required="required"></p>
                <p class="p-1"> Last Name: <input type="text" name="last_name" placeholder="Enter your Last Name"></p>
                <p class="p-1">
                    <label for="gender">Choose Gender:</label>
                    <select name="gender" id="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </p>
                <p class="p-1"> Date of Birth: <input type="date" max='1997-12-31' name="dob" placeholder="Enter your Date of Birth" required="required"></p>
                <p class="p-1"> Email(official): <input type="text" name="email" placeholder="Enter your E-mail" required="required"></p>
                <p class="p-1"> Password: <input type="password" name="password" placeholder="Enter your Password" required="required"></p>
                <p class="p-1"> Confirm Password: <input type="text" name="confirm_password" placeholder="Confirm your Password" required="required"></p>
                <button type="reset" value="Reset" name="reset" class="btn btn-danger m-2">Reset</button>
                <button type="submit" value="Submit" name="submit" class="btn btn-success m-2">Submit</button>

            </form>
        </div>
        <div class="bg-danger text-light text-center  m-auto w-50" style="border-radius:15px">
            <?php
            error_reporting(E_ERROR | E_PARSE);
            $strong_password = 0;
            $cap_character = 0;
            $small_character = 0;
            $special_character = 0;
            $numeric_character = 0;
            $duplicate_email = 0;
            $str = $_POST['password'];
            if (strlen($str) < 8  && isset($_POST['email'])) {
                echo "<br>Password should be of minimum 8 characters <br>";
            } else if (isset($_POST['email'])) {
                $chars = str_split($str);
                foreach ($chars as $char) {

                    if ($char >= "0" && $char <= "9") {
                        $numeric_character = 1;
                    } elseif ($char >= "A" && $char <= "Z") {
                        $cap_character = 1;
                    } elseif ($char >= "a" && $char <= "z") {
                        $small_character = 1;
                    } else {
                        $special_character = 1;
                    }
                }
                if ($small_character == 0) {
                    echo "<br>There should be at least one Small Character<br>";
                }
                if ($cap_character == 0) {
                    echo "<br>There should be at least one Capital Character<br>";
                }
                if ($special_character == 0) {
                    echo "<br>There should be at least one Special Character<br>";
                }
                if ($numeric_character == 0) {
                    echo "<br>There should be at least one Numeric Character<br>";
                }
                if ($cap_character == 1 && $small_character == 1 && $special_character == 1 && $numeric_character == 1) {
                    $strong_password = 1;
                }
            }
            if ($_POST['submit'] == "Submit") {
                if ($_POST['password'] != $_POST['confirm_password']) {
                    echo "<br>Password didn't match while confirmation<br>";
                } elseif (!(strpos($_POST['email'], "@"))) {
                    echo "<br>Invalid E-mail Address<br>";
                } elseif ($strong_password == 1 && $duplicate_email == 0) {
                    $servername = "localhost";
                    $port_no = 3306;
                    $username = "id20433779_shivam";
                    $password = "Portaldb@123";
                    $myDB = "id20433779_portaldb";
                    try {
                        $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stm = $conn->query("SELECT * FROM id20433779_portaldb.userdata");
                        while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                            if ($_POST['email'] == $row['email']) {
                                echo "<br>Email already exists<br>";
                                $duplicate_email = 1;
                            }
                        }

                        if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['gender']) && isset($_POST['dob']) && isset($_POST['email']) && isset($_POST['password']) && $duplicate_email == 0) {

                            $sql = "INSERT INTO id20433779_portaldb.userdata (first_name,last_name, gender, dob, email, password) VALUES (:first_name,:last_name, :gender, :dob, :email, :password)";
                            $stmt = $conn->prepare($sql);
                            $stmt->EXECUTE(
                                array(
                                    ':first_name' => $_POST['first_name'],
                                    ':last_name' => $_POST['last_name'],
                                    ':gender' => $_POST['gender'],
                                    ':dob' => $_POST['dob'],
                                    ':email' => $_POST['email'],
                                    ':password' => md5($_POST['password'])
                                )
                            );
                            echo "Registered successfully<br>";
                        }
                    } catch (PDOException $e) {
                        echo "Connection failed: " . $e->getMessage();
                    }
                }
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
