<?php

if (isset($manageEmployees)) {
    $employees = $manageEmployees->fetchAllEmployees();
    $branches = $manageEmployees->fetchBranchesForForm();
    $schedules = $manageEmployees->fetchSchedules();
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
            <td colspan="10" style="padding-bottom: 20px;"><h4>Employees</h4></td>
            <td align="right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add</button>
            </td>
        </tr>
        <tr>
            <th>Title</th>
            <th>Name</th>
            <th>Address</th>
            <th>Start Date</th>
            <th>Salary</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Holidays</th>
            <th>Sick Days</th>
            <th>Branch</th>
            <td></td>
        </tr>
        <?php foreach($employees as $e) { ?>
        <tr>
            <td><?php echo $e->title ?></td>
            <td><?php echo $e->name ?></td>
            <td><?php echo $e->address ?></td>
            <td><?php echo $e->start_date ?></td>
            <td><?php echo $e->salary ?>$</td>
            <td><?php echo $e->email_address ?></td>
            <td><?php echo $e->phone_number ?></td>
            <td><?php echo $e->holidays ?></td>
            <td><?php echo $e->sick_days ?></td>
            <td><?php echo $e->branch_id ?></td>
            <td align="right" width="300px">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?php echo $e->employee_id;?>">Edit</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#delete<?php echo $e->employee_id;?>">Delete</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#schedule<?php echo $e->employee_id;?>">Schedule</button>
            </td>
        </tr>

        <!-- Update employee modal opens when clicking edit button -->
        <div class="modal fade" id="edit<?php echo $e->employee_id;?>" role="dialog">
            <div class="modal-dialog" style="width:30%;">
                <div class="modal-content">
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" method="post" action="manage_employees.php" name="update_employee" class="form-horizontal">
                            <fieldset>
                                <legend>Update Employee: <?php echo $e->employee_id?></legend>
                                <p>
                                    <input type="hidden" name="employee_id" value="<?php echo $e->employee_id?>">
                                </p>
                                <p>
                                    <label>Position</label><br>
                                    <select id="title" name="title" required>
                                        <option value = "President">President</option>
                                        <option value = "General Manager">General Manager</option>
                                        <option value = "Manager">Manager</option>
                                        <option value = "Customer Service Representative">Custumer Service Representative</option>
                                    </select>
                                </p>
                                <p>
                                    <label>Name</label><br>
                                    <input id="name" type="text" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" name="name" required />
                                </p>
                                <p>
                                    <label>Address</label><br>
                                    <input id="address" type="text" pattern="^\w+( \w+)*$" name="address" required />
                                </p>
                                <p>
                                    <label>Start Date</label><br>
                                    <input id="start_date" type="date" name="start_date" required />
                                </p>
                                <p>
                                    <label>Salary</label><br>
                                    <input id="salary" type="number" step="0.01" min="0" name="salary" required />
                                </p>
                                <p>
                                    <label>Email</label><br>
                                    <input id="email_address" type="email" name="email_address" required />
                                </p>
                                <p>
                                    <label>Phone Number</label><br>
                                    <input id="phone_number" type="tel" pattern="[1-9]\d{2}-\d{3}-\d{4}" name="phone_number" placeholder="###-###-####" required />
                                </p>
                                <p>
                                    <label>Holidays</label><br>
                                    <input id="holidays" type="number" name="holidays" min="0" step="1" required />
                                </p>
                                <p>
                                    <label>Sick Days</label><br>
                                    <input id="sick_days" type="number" name="sick_days" min="0" step="1" required />
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
                                <input type="submit" name="update_employee" value="Update">
                                <input type="submit" data-dismiss="modal" value="Close">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Delete employee modal opens when clicking delete button -->
        <div class="modal fade" id="delete<?php echo $e->employee_id;?>" role="dialog">
            <div class="modal-dialog" style="width:20%;">
                <div class="modal-content">
                    <div class="modal-body" style="padding:40px 50px;">
                        <form role="form" method="post" action="manage_employees.php" name="delete_employee" class="form-horizontal">
                            <fieldset>
                                <legend>Delete Employee: <?php echo $e->employee_id?></legend>
                                <p>Are you sure you want to delete this employee?</p>
                                <p>
                                    <input type="hidden" name="employee_id" value="<?php echo $e->employee_id?>">
                                </p>
                            </fieldset>
                            <div style="padding-top: 10px;">
                                <input type="submit" name="delete_employee" value="Delete">
                                <input type="submit" data-dismiss="modal" value="Close">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            </div>
            <div class="modal fade" id="schedule<?php echo $e->employee_id;?>" role="dialog">
                <div class="modal-dialog" style="width:30%;">
                    <div class="modal-content">
                        <div class="modal-body" style="padding:40px 50px;">
                        <legend>Schedule for Employee <?php echo $e->employee_id;?></legend>

                                <?php foreach($schedules as $s) { ?>
                                        <?php if($s->employee_id == $e->employee_id){?>
                                        <div class="row">
                                            <div class="col-sm-4">
                                        <?php echo $s->day ?>
                                            </div>
                                            <div class="col-sm-4">

                                            <?php echo "Start Time:". $s->start_time ?>
                                            </div>

                                                <div class="col-sm-4">

                                                <?php echo "End Time:". $s->end_time ?>
                                                </div>
                                        </div>
                                        <br>
                                    <?php }?>
                                <?php }?>

                            <div style="padding-top: 10px;">
                                <input type="submit" data-dismiss="modal" value="Close">
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <?php }?>
    </table>

    <!-- Add employee modal opens when clicking add button -->
    <div class="modal fade" id="add" role="dialog">
        <div class="modal-dialog" style="width:30%;">
            <div class="modal-content">
                <div class="modal-body" style="padding:40px 50px;">
                    <form role="form" method="post" action="manage_employees.php" name="add_employee" class="form-horizontal">
                        <fieldset>
                            <legend>Add New Employee:</legend>

                            <p>
                                <label>Position</label><br>
                                <select id="title" name="title" required>
                                    <option value = "President">President</option>
                                    <option value = "General Manager">General Manager</option>
                                    <option value = "Manager">Manager</option>
                                    <option value = "Customer Service Representative">Costumer Service Representative</option>
                                </select>
                            </p>
                            <p>
                                <label>Name</label><br>
                                <input id="name" type="text" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" name="name" required />
                            </p>
                            <p>
                                <label>Address</label><br>
                                <input id="address" type="text" pattern="^\w+( \w+)*$" name="address" required />
                            </p>
                            <p>
                                <label>Start Date</label><br>
                                <input id="start_date" type="date" name="start_date" required />
                            </p>
                            <p>
                                <label>Salary</label><br>
                                <input id="salary" type="number" step="0.01" min="0" name="salary" required />
                            </p>
                            <p>
                                <label>Email</label><br>
                                <input id="email_address" type="email" name="email_address" required />
                            </p>
                            <p>
                                <label>Phone Number</label><br>
                                <input id="phone_number" type="tel" pattern="[1-9]\d{2}-\d{3}-\d{4}" name="phone_number" placeholder="###-###-####" required />
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
                            <input type="submit" name="add_employee" value="Add">
                            <input type="submit" data-dismiss="modal" value="Close">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
</body>
</html>
