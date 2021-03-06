<?php
if (isset($manageAccounts)) {
    $clients = $manageAccounts->fetchClients();
    $accounts = $manageAccounts->fetchAccounts();
}

if (isset($_POST['clientSelection'])) {
    if($_POST['clientSelection'] == 'all') {
        $accounts = $manageAccounts->fetchAccounts();
    } else{
        $accounts = array_filter($accounts, "selectedClientAccount");
    }
}

function selectedClientAccount($accounts) {
    return ($accounts->client_id == $_POST['clientSelection']);
}

?>
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
            <td colspan="8" style="padding-bottom: 20px;"><h4>Accounts</h4></td>
        </tr>
        <tr>
            <td colspan="8">
                <form action="manage_accounts.php" method="POST">
                    Filter by Client:
                    <select id="clientSelection" class="client" name="clientSelection" onchange="submit()" required>
                        <option value='' disabled selected>
                            <?php
                            if(isset($_POST['clientSelection'])){
                                echo $_POST['clientSelection'];
                            } else {
                                ?>
                                Select Client
                            <?php } ?>
                        </option>
                        <?php if(isset($_POST['clientSelection'])){ ?>
                                <option value="all">All</option>;
                         <?php } ?>
                        <?php foreach($clients as $c) { ?>
                            <option value="<?php echo $c->client_id ?>"><?php echo $c->client_id?></option>
                        <?php }?>
                    </select>
                </form>
            </td>
        </tr>
        <tr>
            <th>Account Number</th>
            <th>Client ID</th>
            <th>Balance</th>
            <th>Type</th>
            <th>Service</th>
            <th>Level</th>
            <th>Interest Rate</th>
            <th></th>
        </tr>
        <?php foreach($accounts as $a) { ?>
            <tr>
                <td><?php echo $a->account_number ?></td>
                <td><?php echo $a->client_id?></td>
                <td><?php echo $a->balance ?>$</td>
                <td><?php echo $a->account_type ?></td>
                <td><?php echo $a->service_type ?></td>
                <td><?php echo $a->level ?></td>
                <td><?php echo $a->interest_rate ?>%</td>
                <td align="right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $a->account_number;?>">Edit</button>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete<?php echo $a->account_number;?>">Delete</button>
                </td>
            </tr>

            <!-- Update account modal opens when clicking edit button -->
            <div class="modal fade" id="edit<?php echo $a->account_number;?>" role="dialog">
                <div class="modal-dialog" style="width:30%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="post" action="manage_accounts.php" name="update_account" class="form-horizontal">
                                <fieldset>
                                    <legend>Update Account: <?php echo $a->account_number?></legend>
                                    <p>
                                        <input type="hidden" name="account_number" value="<?php echo $a->account_number?>">
                                    </p>
                                    <p>
                                        <label>Service Type</label><br>
                                        <select id="service_type" name="service_type" required>
                                            <option value = "Banking">Banking</option>
                                            <option value = "Investment">Investment</option>
                                            <option value = "Insurance">Insurance</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Level of Banking</label><br>
                                        <select id="level" name="level" required>
                                            <option value = "Personal">Personal</option>
                                            <option value = "Business">Business</option>
                                            <option value = "Corporate">Corporate</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Interest Rate</label><br>
                                        <input id="interest_rate" type="number" step="0.01" name="interest_rate" required />
                                    </p>

                                </fieldset>
                                <div style="padding-top: 10px;">
                                    <input type="submit" name="update_account" value="Update">
                                    <input type="submit" data-dismiss="modal" value="Close">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Delete account modal opens when clicking delete button -->
            <div class="modal fade" id="delete<?php echo $a->account_number;?>" role="dialog">
                <div class="modal-dialog" style="width:20%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="post" action="manage_accounts.php" name="delete_account" class="form-horizontal">
                                <fieldset>
                                    <legend>Delete Account: <?php echo $a->account_number?></legend>
                                    <p>Are you sure you want to delete this account?</p>
                                    <p>
                                        <input type="hidden" name="account_number" value="<?php echo $a->account_number?>">
                                    </p>
                                </fieldset>
                                <div style="padding-top: 10px;">
                                    <input type="submit" name="delete_account" value="Delete">
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