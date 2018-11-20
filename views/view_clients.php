<?php

if (isset($manageClients)) {
    $clients = $manageClients->fetchAllClients();
}
?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        td, th { padding:5px 15px 0 15px; }
    </style>
</head>
<html>
<div class="col-md-12 well" style="position:absolute; top:10%; left:10%; width:80%;">
    <table>
        <caption>Clients</caption>
        <tr>
            <th>Card Number</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Joined</th>
            <th>Address</th>
            <th>Category</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Branch</th>
        </tr>
        <?php foreach($clients as $c) { ?>
            <tr>
                <td><?php echo $c->client_id ?></td>
                <td><?php echo $c->name ?></td>
                <td><?php echo $c->date_of_birth ?></td>
                <td><?php echo $c->joining_date ?></td>
                <td><?php echo $c->address ?></td>
                <td><?php echo $c->category ?></td>
                <td><?php echo $c->email_address ?></td>
                <td><?php echo $c->phone_number ?></td>
                <td><?php echo $c->branch_id ?></td>
            </tr>
        <?php }?>
    </table>

</div>
</html>