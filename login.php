<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .header {
            margin: 10px;
            color: black;
        }

        .header::before {
            position: absolute;
            margin-top: -10px;
            margin-left: -18px;
            width: 100%;
            height: 124px;
            content: "";
            background: url("./img/background.webp");
            z-index: -1;
            opacity: 0.5;
        }


        .content {
            display: flex;
            flex-direction: row;
            background-color: #fbc47e;
            height: 500px;
        }

        .nav {
            margin-left: -8px;
            background-image: url("./img/background_intro.webp");
        }

        .intro {
            width: 100%;
        }

        p {
            color: #ff0505;
            opacity: 0.9;
        }

        button {
            border-radius: 5px;
            display: block;
            margin: 25px;
            width: 100px;
        }

        input{
            cursor: pointer;
        }
        button:hover {
            background-color: aquamarine;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>
            Mehta Family School of Data Science and Artificial Intelligence <br> IIT GUWAHATI
        </h2>
        <h3>
            Welcome to our Information Portal
        </h3>
    </div>

    <div class="content">
        <div class="nav">
            <button> <a href="index.php"> About Us</a></button>
            <button> <a href="registration.php"> Registration</a></button>
        </div>
        <div class="output">
            <div class="intro">
                <form action="" method="post">
                    <p> Email(official): <input type="text" name="email"  placeholder="Enter your E-mail"></p>
                    <p> Password: <input type="password" name="password"  placeholder="Enter your Password"></p>

                    <input type="reset" value="Reset" name="reset">
                    <input type="submit" value="Submit" name="submit">

                </form>
            </div>
            <div>
                <?php
                error_reporting(E_ERROR | E_PARSE);
                $flag = 0;
                $servername = "localhost";
                $port_no = 3306;
                $username = "shivam3";
                $password = "sks";
                $myDB = "PortalDB";
                //Name of the database to access
                try {
                    $conn = new PDO("mysql:host=$servername;port=$port_no;dbname=$myDB", $username, $password);
                    // set the PDO error mode to exception
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stm = $conn->query("SELECT * FROM portaldb.userdata");
                    // echo "hi <pre>";
                    while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {
                        // print_r($row);
                        // echo $_POST['email'], $_POST['password'];
                        if ($_POST['email'] == $row['email'] && $_POST['password'] == $row['password']) {
                            $flag = 1;
                            echo "Logged in Successful<br>";
                            header('Location: about.php');
                            // or die();
                            exit();
                        }
                    }
                    
                    if ($flag == 0 && isset($_POST['email']) ) {
                        echo "Email or Password is incorrect<br>";
                    }
                } catch (PDOException $e) {
                    echo "Connection failed: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>