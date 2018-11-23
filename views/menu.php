<?php
session_start();
$admin = $_SESSION['admin_id'];
if($admin){
    $isAdmin = true;
} else {
    $isAdmin = false;
}

?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .navigationLinks {
            float: right;
        }
        .navbar {
            background-color: #f5f5f5;
        }
        .nav-link {
            float: left;
            height: 50px;
            padding: 15px 15px;
            font-size: 14px;
            line-height: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php
if($isAdmin){
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Bank</a>
        <div class="navigationLinks">
            <a class="nav-item nav-link active" href="../index.php">Home</a>
            <a class="nav-item nav-link" href="manage_clients.php">Manage Clients</a>
            <a class="nav-item nav-link" href="../index.php?logout">Logout</a>
        </div>
    </nav>
    <?
}else{
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Bank</a>
        <div class="navigationLinks">
            <a class="nav-item nav-link active" href="list_accounts.php">Accounts</a>
            <a class="nav-item nav-link" href="create_account.php">Create an Account</a>
            <a class="nav-item nav-link" href="../index.php?logout">Logout</a>
        </div>
    </nav>

    <?
}
?>
</body>
</html>