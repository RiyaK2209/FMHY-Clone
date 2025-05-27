<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }

        .btn-back {
            background-color: #007BFF;
            color: white;
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    <?php
        $con = new mysqli('localhost', 'root', '', 'webproj');

        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $txtname = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $con->prepare("SELECT * FROM `loginlog` WHERE `username` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<h2 class='error'>Error: Username already exists. Please choose another one.</h2>";
        } else {
            $stmt = $con->prepare("INSERT INTO `loginlog` (`name`, `email`, `phone`, `username`, `password`) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $txtname, $email, $phone, $username, $password);

            if ($stmt->execute()) {
                echo "<h2 class='success'>User Registered Successfully</h2>";
            } else {
                echo "<h2 class='error'>Error Inserting Record</h2>";
            }
        }

        $stmt->close();
        $con->close();
    ?>

    <button class="btn-back" onclick="window.location.href='login.html';">
        ⬅ Go Back
    </button>
</body>
</html>
