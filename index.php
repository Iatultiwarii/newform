<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .header {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            color: white;
            padding: 20px;
            text-align: left;
            font-size: 24px;
            font-weight: bold;
            position: relative;
            width: 100%;
            height: 500px;
        }
        .container {
            margin-top: 20px;
        }
        .add{
            position:fixed;
            right: 10px;
            top:50px;
            background-color:rgb(19, 111, 39);
        }
        .dash{
            position: fixed;
            top: 50px;
            left: 10px;
            margin:30px;


        }
      
    </style>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="header">Team</div>
    <div class="container text-center mt-5">
        <div class="d-flex justify-content-between mt-4">
            <a href="add.php" class="btn btn-primary add">+ Add User</a>
            <a href="dashboard.php" class="btn btn-success dash"> View Dashboard</a>

        </div>
    </div>
</body>
</html>
