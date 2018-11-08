<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
Hey, <?php echo $_SESSION['user_name']; ?>. You are logged in.
Try to close this browser tab and open it again. Still logged in! ;)

<div class="menu">
    <ul>
        <li>
            <a class="active" href="home_page.php">Accounts</a>
        </li>
        <li>
            <a href="">Open Account</a>
        </li>
        <li>
            <a href="">Transfer Money</a>
        </li>
        <li>
            <a href="">Pay Bills</a>
        </li>
        <li>
            <a href="">E-Transfer</a>
        </li>
        <li style="float:right">
            <!-- because people were asking: "index.php?logout" is just my simplified form of "index.php?logout=true" -->
            <a href="index.php?logout">Logout</a>
        </li>
    </ul>

    <!-- taken from w3school-->
    <style>
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #333;
        }

        li {
            float: left;
            border-right:1px solid #bbb;
        }

        li:last-child {
            border-right: none;
        }

        li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        li a:hover:not(.active) {
            background-color: #111;
        }

        .active {
            background-color: #4CAF50;
        }
    </style>
</div>
