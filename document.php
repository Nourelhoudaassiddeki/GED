<?php
include('doc.php');
if (isset($_POST["submit"])) {
    $pseudo = $_POST["pseudo"];
    $fonction = $_POST["fonction"];
    $service = $_POST["services"];
    $password = $_POST["password"];
    $passwd = $_POST["passwd"];
    $privileges = $_POST["privileges"];
    $privilege = "";
    foreach($privileges as $row){
        $privilege .= $row . ",";
    }
    $privilege = rtrim($privilege, ",");

    $picture = $_FILES["picture"]["name"];
    $extension = pathinfo($picture, PATHINFO_EXTENSION);
    $folder = "uploads/" . $picture;

    // Move uploaded file
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $folder)) {
        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO nouna (PSEUDO, FONCTION, SECTION, MOT_DE_PASS, PASSWD, PRIVILEGE, pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sssssss", $pseudo, $fonction, $service, $password, $passwd, $privilege, $picture);
            if ($stmt->execute()) {
                echo "<script>alert('Data inserted successfully');</script>";
            } else {
                echo "<script>alert('Data not inserted');</script>";
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "<script>alert('Failed to upload picture');</script>";
    }

    // Password validation
    $error_msg = [];
    if (empty($password)) {
        $error_msg['password'] = "Password is required";
    }
    if (empty($passwd)) {
        $error_msg['passwd'] = "Confirm password is required";
    }
    if ($password != $passwd) {
        $error_msg['pass3'] = "Passwords don't match";
    }
}

$result = mysqli_query($conn, "SELECT * from nouna");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>aero</title>
</head>
<body class="bg-dark">
<aside style="width: 100; padding-left: 15px; float: right; margin-right: 0%; margin-left: 50px; background-color: lightgray; position: relative; top: 50px;">
    <div class="form_validation">
        <div class="error_msg">
            <?php
            if (isset($error_msg['passwd'])) {
                echo $error_msg['passwd'];
            }
            if (isset($error_msg['pass3'])) {
                echo $error_msg['pass3'];
            }
            ?>
        </div>
        <form action="" method="post" autocomplete="off" style="height: 100%;" enctype="multipart/form-data">
            <label for=""><h2>Add users</h2></label><hr>
            <label for="">Pseudo:</label><br>
            <input type="text" name="pseudo" placeholder="user_name" style="margin: 10px; margin-left: 50px;" required><br/><br/>
            <label for="">Fonction:</label><br>
            <input type="text" name="fonction" placeholder="fonction" style="margin: 10px; margin-left: 50px;" required><br/><br/>
            <label for="">Service/Section:</label><br>
            <select name="services" required><br/><br/>
                <option value="Select service" selected hidden>Select service</option><br>
                <option value="agent d'embarquement">agent d'embarquement</option><br>
                <option value="agent de securite">agent de securite</option><br><br>
                <option value="agent d'assistance aux passagers">agent d'assistance aux passagers</option><br>
                <option value="service technique navigation">service technique navigation</option><br>
                <option value="section controle aerien">section controle aerien</option><br>
            </select><br/><br/>
            <label for="">Password:</label><br/><br/>
            <input type="password" name="password" placeholder="password" style="margin: 10px; margin-left: 50px;" required><br/><br/>
            <label for="">Confirm Password:</label><br/><br/>
            <input type="password" name="passwd" placeholder="password" style="margin: 10px; margin-left: 50px;" required><br/><br/>
            <label for="" style="margin: 10px;">Privilege:</label><br/><br/>
            <input type="checkbox" style="margin-top: 10px;" name="privileges[]" value="Download docs">Download docs<br/><br/>
            <input type="checkbox" style="margin-top: 10px;" name="privileges[]" value="Add docs">Add docs<br/><br/>
            <input type="checkbox" style="margin-top: 10px;" name="privileges[]" value="delete docs">Delete docs<br/><br/>
            <input type="checkbox" style="margin-top: 10px; margin-bottom: 10px;" name="privileges[]" value="Access to all docs">Access to all docs<br/><br/>
            <label for="">Profile pic:</label><br/><br/>
            <input type="file" name="picture" style="margin-top: 10px; margin-bottom: 10px;" required accept="image/png, image/jpeg"><br/><br/>
            <button type="submit" style="margin-top: 10px; margin-bottom: 4px;" name="submit">Add user</button>
        </form>
    </div>
</aside>
<div class="container">
    <div class="row mt-5">
        <div class="col">
            <div class="card mt-5">
                <div class="card-header">
                    <h2 class="display-6 text-center">Users Management</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Pseudo</th>
                                <th>Fonction</th>
                                <th>Section</th>
                                <th>Privilege</th>
                                <th>Profile</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($result)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['PSEUDO']); ?></td>
                                <td><?php echo htmlspecialchars($row['FONCTION']); ?></td>
                                <td><?php echo htmlspecialchars($row['SECTION']); ?></td>
                                <td><?php echo htmlspecialchars($row['PRIVILEGE']); ?></td>
                                <td><img src= '".$row[pic]."' height='100px' width='100px' alt=''></td>
                                <td><a href="#" class="btn btn-primary">Edit</a></td>
                                <td><a href="#" class="btn btn-danger">Delete</a></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-GLhlTQ8tTAR9uOe4B3zMoj5DDs5bF7RTI5KTkW4rbhO5gppylUuF5yLck2zPvcIb" crossorigin="anonymous"></script>
</body>
</html>

