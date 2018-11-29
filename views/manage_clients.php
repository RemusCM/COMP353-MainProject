<?php

if (isset($manageClients)) {
    $clients = $manageClients->fetchAllClients();
    $branches = $manageClients->fetchBranchesForForm();
}
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        td, th { padding:5px 15px 0 15px; }
    </style>
</head>
<body>
<div class="col-md-12 well" style="position:absolute; top:10%; left:2.5%; width:95%;">
    <table width="100%">
        <tr>
            <td colspan="10" style="padding-bottom: 20px;"><h4>Clients</h4></td>
        </tr>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>DOB</th>
            <th>Joined</th>
            <th>Address</th>
            <th>Category</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Branch</th>
            <td></td>
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
                <td align="right" width="180px">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $c->client_id;?>">Edit</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete<?php echo $c->client_id;?>">Delete</button>
                </td>
            </tr>

            <!-- Update client modal opens when clicking edit button -->
            <div class="modal fade" id="edit<?php echo $c->client_id;?>" role="dialog">
                <div class="modal-dialog" style="width:30%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="post" action="manage_clients.php" name="update_client" class="form-horizontal">
                                <fieldset>
                                    <legend>Update Client: <?php echo $c->client_id?></legend>
                                    <p>
                                        <input type="hidden" name="client_id" value="<?php echo $c->client_id?>">
                                    </p>
                                    <p>
                                        <label>Name</label><br>
                                        <input id="name" type="text" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" name="name" required />
                                    </p>
                                    <p>
                                        <label>Date of Birth</label><br>
                                        <input id="dob" type="date" name="dob" required />
                                    </p>
                                    <p>
                                        <label>Address</label><br>
                                        <input id="address" type="text" pattern="^\w+( \w+)*$" name="address" required />
                                    </p>
                                    <p>
                                        <label>Phone Number</label><br>
                                        <input id="phone" type="tel" pattern="[1-9]\d{2}-\d{3}-\d{4}" name="phone" placeholder="###-###-####" required />
                                    </p>
                                    <p>
                                        <label>Email</label><br>
                                        <input id="email" type="email" name="email" required />
                                    </p>
                                    <p>
                                        <label>Category</label><br>
                                        <select id="category" name="category" required>
                                            <option value = "Basic">Basic</option>
                                            <option value = "Premium">Premium</option>
                                            <option value = "Senior">Senior</option>
                                            <option value = "Student">Student</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Branch</label><br>
                                        <select id="branch" name="branch" required>
                                            <?php foreach($branches as $b) { ?>
                                                <option value="<?php echo $b->branch_id ?>"><?php echo $b->area?>, <?php echo $b->city?></option>
                                            <?php }?>
                                        </select>
                                    </p>
                                </fieldset>
                                <div style="padding-top: 10px;">
                                    <input type="submit" name="update_client" value="Update">
                                    <input type="submit" data-dismiss="modal" value="Close">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Delete client modal opens when clicking delete button -->
            <div class="modal fade" id="delete<?php echo $c->client_id;?>" role="dialog">
                <div class="modal-dialog" style="width:20%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="post" action="manage_clients.php" name="delete_client" class="form-horizontal">
                                <fieldset>
                                    <legend>Delete Client: <?php echo $c->client_id?></legend>
                                    <p>Are you sure you want to delete this client?</p>
                                    <p>
                                        <input type="hidden" name="client_id" value="<?php echo $c->client_id?>">
                                    </p>
                                </fieldset>
                                <div style="padding-top: 10px;">
                                    <input type="submit" name="delete_client" value="Delete">
                                    <input type="submit" data-dismiss="modal" value="Close">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        <?php }?>
    </table>

</div>
</body>
</html>