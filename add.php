<?php
include 'db.php';

$name = $mobile = $address = $email = $role = $designation = $status = $marital_status = $dob = $gender = $image = "";
$edit_id = "";

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$edit_id");
    $row = $result->fetch_assoc();

    $name = $row['name'];
    $mobile = $row['mobile'];
    $address = $row['address'];
    $email = $row['email'];
    $role = $row['role'];
    $designation = $row['designation'];
    $status = $row['status'];
    $marital_status = $row['marital_status'];
    $dob = $row['dob'];
    $gender = $row['gender'];
    $image = $row['image'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    $address = $_POST["address"];
    $email = $_POST["email"];
    $role = $_POST["role"];
    $designation = $_POST["designation"];
    $status = $_POST["status"];
    $marital_status = $_POST["marital_status"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    
    if (!empty($_FILES["image"]["name"])) {
        $image = "uploads/" . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image);
    }

    if ($edit_id) {
        $sql = "UPDATE users SET name='$name', mobile='$mobile', address='$address', email='$email', 
                role='$role', designation='$designation', status='$status', marital_status='$marital_status', 
                dob='$dob', gender='$gender', image='$image' WHERE id=$edit_id";
    } else {
        $sql = "INSERT INTO users (name, mobile, address, email, role, designation, status, marital_status, dob, gender, image) 
                VALUES ('$name', '$mobile', '$address', '$email', '$role', '$designation', '$status', '$marital_status', '$dob', '$gender', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User saved successfully!'); window.location='dashboard.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $edit_id ? 'Edit' : 'Add' ?> User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div style="background: linear-gradient(to right, #1e3c72, #2a5298); color: white; padding: 15px; text-align: left; font-size: 24px; font-weight: bold;">
        <?= $edit_id ? 'Edit' : 'Add' ?> User
    </div>
    <div class="container mt-4">
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-bordered">
                <tr>
                    <td><label>Name:</label><input type="text" name="name" class="form-control" value="<?= $name ?>" required></td>
                    <td><label>Mobile:</label><input type="text" name="mobile" class="form-control" value="<?= $mobile ?>" required></td>
                </tr>
                <tr>
                    <td><label>Address:</label><textarea name="address" class="form-control" required><?= $address ?></textarea></td>
                    <td><label>Email:</label><input type="email" name="email" class="form-control" value="<?= $email ?>" required></td>
                </tr>
                <tr>
                    <td><label>Role:</label><input type="text" name="role" class="form-control" value="<?= $role ?>" required></td>
                    <td><label>Designation:</label><input type="text" name="designation" class="form-control" value="<?= $designation ?>" required></td>
                </tr>
                <tr>
                    <td>
                        <label>Status:</label>
                        <select name="status" class="form-control">
                            <option value="Active" <?= $status == "Active" ? 'selected' : '' ?>>Active</option>
                            <option value="Inactive" <?= $status == "Inactive" ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </td>
                    <td>
                        <label>Marital Status:</label>
                        <select name="marital_status" class="form-control">
                            <option value="Married" <?= $marital_status == "Married" ? 'selected' : '' ?>>Married</option>
                            <option value="Unmarried" <?= $marital_status == "Unmarried" ? 'selected' : '' ?>>Unmarried</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label>Date of Birth:</label><input type="date" name="dob" class="form-control" value="<?= $dob ?>" required></td>
                    <td>
                        <label>Gender:</label>
                        <select name="gender" class="form-control">
                            <option value="Male" <?= $gender == "Male" ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= $gender == "Female" ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= $gender == "Other" ? 'selected' : '' ?>>Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label>Profile Image:</label>
                        <input type="file" name="image" class="form-control">
                        <?php if ($image): ?>
                            <img src="<?= $image ?>" width="50">
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary"><?= $edit_id ? 'Update' : 'Submit' ?></button>
        </form>
    </div>
</body>
</html>
