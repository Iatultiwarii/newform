<?php
include 'db.php';
$users = $conn->query("SELECT * FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .header {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            width: 100%;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="header">User Dashboard</h2>
        <?php if ($users->num_rows > 0): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Designation</th>
                    <th>Status</th>
                    <th>Marital Status</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['mobile'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td><?= $row['designation'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td><?= $row['marital_status'] ?></td>
                    <td><?= $row['dob'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><img src="<?= $row['image'] ?>" width="50"></td>
                    <td>
                        <a href="add.php?edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="dashboard.php?delete_id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No users found.</p>
        <?php endif; ?>
    </div>

    <?php
    if (isset($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $conn->query("DELETE FROM users WHERE id=$id");
        echo "<script>alert('User deleted successfully!'); window.location='dashboard.php';</script>";
        exit();
    }
    ?>
</body>
</html>
