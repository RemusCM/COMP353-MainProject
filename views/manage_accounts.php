<?php
if (isset($manageAccounts)) {
    $branches = $manageAccounts->fetchBranchesForForm();
    $clients = $manageAccounts->fetchClients();
    $accounts = $manageAccounts->fetchAccounts();
}

function setSession() {

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
<html>
<div class="col-md-12 well" style="position:absolute; top:10%; left:5%; width:90%;">

    <select id="branchSelection" class="branch" name="branch" required>
        <option value='' disabled selected>Select Branch</option>
        <?php foreach($branches as $b) { ?>
            <option value="<?php echo $b->branch_id ?>"><?php echo $b->area?>, <?php echo $b->city?></option>
        <?php }?>
    </select>

    <select id="clientSelection" class="client" name="client" required>
        <option value='' disabled selected>Select Client</option>
        <?php foreach($clients as $c) { ?>
            <option value="<?php echo $c->client_id ?>"><?php echo $c->client_id?></option>
        <?php }?>
    </select>

    <table width="100%">
        <caption>Accounts</caption>
        <tr>
            <th>Account Number</th>
            <th>Balance</th>
            <th>Type</th>
            <th>Service</th>
            <th>Level</th>
            <th>Interest Rate</th>
        </tr>
        <?php foreach($accounts as $a) { ?>
            <tr>
                <td><?php echo $a->account_number ?></td>
                <td><?php echo $a->balance ?>$</td>
                <td><?php echo $a->account_type ?></td>
                <td><?php echo $a->service_type ?></td>
                <td><?php echo $a->level ?></td>
                <td><?php echo $a->interst_rate ?></td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $a->account_number;?>">Edit</button></td>
                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete<?php echo $a->account_number;?>">Delete</button></td>
            </tr>

            <!-- Update account modal opens when clicking edit button -->
            <div class="modal fade" id="edit<?php echo $a->account_number;?>" role="dialog">
                <div class="modal-dialog" style="width:30%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                            <form role="form" method="post" action="manage_accounts.php" name="update_client" class="form-horizontal">
                                <fieldset>
                                    <legend>Update Account: <?php echo $a->account_number?></legend>
                                    <p>
                                        <input type="hidden" name="account_number" value="<?php echo $a->account_number?>">
                                    </p>
                                    <p>
                                        <label>Service Type</label><br>
                                        <select id="service_type" name="service-type" required>
                                            <option value = "banking">Banking</option>
                                            <option value = "investment">Investment</option>
                                            <option value = "insurance">Insurance</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Level of Banking</label><br>
                                        <select id="level" name="level" required>
                                            <option value = "personal">Personal</option>
                                            <option value = "business">Business</option>
                                            <option value = "corporate">Corporate</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Charge Plan Option</label><br>
                                        <select id="register_input_level" class="login_input" name="charge-plan" required>
                                            <?php foreach($option as $o) { ?>
                                                <option value="<?php echo $o->opt ?>"><?php echo $o->opt ?></option>
                                            <?php }?>
                                        </select>
                                    </p>

                                </fieldset>
                                <div style="padding-top: 10px;">
                                    <input type="submit" name="update_acount" value="Update">
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
</html>