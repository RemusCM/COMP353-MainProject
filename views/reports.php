<?php
if (isset($reports)) {
    $president = $reports->fetchPresident();
    $branches = $reports->fetchBranches();
    $cities = $reports->fetchCities();
    $services = $reports->fetchServices();
    $client_count = $reports->fetchClientCount();
    $employee_count = $reports->fetchEmployeeCount();
    $headOffice = headOffice($branches, $president);
}

function headOffice($branches, $president) {
    foreach($branches as $b){
        if($b->branch_id == $president->branch_id){
            return $b->area . ', ' . $b->city;
        }
    }
    return null;
}

if (isset($_POST['branchSelection'])) {
    $branchLoss = $reports->fetchEmployeeSalariesByBranch($_POST['branchSelection']);
}

if (isset($_POST['citySelection'])) {
    $cityLoss = $reports->fetchEmployeeSalariesByCity($_POST['citySelection']);
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
<div>
    <div class="col-md-12 well" style="position:absolute; top:10%; left:2.5%; width:30%;">
        <table width="100%">
            <tr>
                <td colspan="2" style="padding-bottom: 20px;"><h4>Bank Report</h4></td>
            </tr>
            <tr>
                <th>President: </th>
                <td><?php echo $president->name ?></td>
            </tr>
            <tr>
                <th>Head Office: </th>
                <td><?php echo $headOffice ?></td>
            </tr>
            <tr><td style="padding-bottom: 20px;"></td></tr>
            <tr>
                <th>Number of Employees: </th>
                <td><?php echo $employee_count->ecount ?></td>
            </tr>
            <tr>
                <th>Number of Clients: </th>
                <td><?php echo $client_count->ccount ?></td>
            </tr>
            <tr><td style="padding-bottom: 20px;"></td></tr>
            <tr>
                <th>Service</th>
                <th>General Manager</th>
            </tr>
            <?php foreach($services as $s) { ?>
                <tr>
                    <td><?php echo $s->service_type ?></td>
                    <td><?php echo $reports->fetchEmployeeById($s->manager_id) ?></td>
                </tr>
            <?php }?>
            <tr><td style="padding-bottom: 20px;"></td></tr>
            <tr>
                <th colspan="2">Annual Losses</th>
            </tr>
            <tr>
                <td>Overall: </td>
                <td><?php echo $reports->fetchOverallEmployeeSalaries() ?>$</td>
            </tr>
            <tr>
                <td>
                    <form action="index.php" method="POST" style="margin-bottom: 0">
                        By branch:
                        <select id="branchSelection" name="branchSelection" onchange="submit()" required>
                            <option value='' disabled selected>
                                <?php
                                if(isset($_POST['branchSelection'])){
                                    echo $_POST['branchSelection'];
                                } else {
                                    ?>
                                    Branch
                                <?php } ?>
                            </option>
                            <?php foreach($branches as $b) { ?>
                                <option value="<?php echo $b->branch_id ?>"><?php echo $b->branch_id?></option>
                            <?php }?>
                        </select>
                    </form>
                </td>
                <?php if($branchLoss) { ?>
                    <td><?php echo $branchLoss ?>$</td>
                <?php } else if (isset($_POST['branchSelection'])) { ?>
                    <td>0$</td>
                <?php } else { ?>
                    <td></td>
                <?php }?>
            </tr>
            <tr>
                <td>
                    <form action="index.php" method="POST" style="margin-bottom: 0">
                        By city:
                        <select id="citySelection" name="citySelection" onchange="submit()" required>
                            <option value='' disabled selected>
                                <?php
                                if(isset($_POST['citySelection'])){
                                    echo $_POST['citySelection'];
                                } else {
                                    ?>
                                    City
                                <?php } ?>
                            </option>
                            <?php foreach($cities as $c) { ?>
                                <option value="<?php echo $c->cityName ?>"><?php echo $c->cityName?></option>
                            <?php }?>
                        </select>
                    </form>
                </td>
                <?php if($cityLoss) { ?>
                    <td><?php echo $cityLoss ?>$</td>
                <?php } else if (isset($_POST['citySelection'])) { ?>
                    <td>0$</td>
                <?php } else { ?>
                    <td></td>
                <?php }?>
            </tr>
        </table>
    </div>

    <div class="col-md-12 well" style="position:absolute; top:10%; right:2.5%; width:62.5%;">
        <table width="100%">
            <tr>
                <td colspan="6" style="padding-bottom: 20px;"><h4>Branches</h4></td>
            </tr>
            <tr>
                <th>Branch</th>
                <th>Manager</th>
                <th>Location</th>
                <th>Opening Date</th>
                <th>Phone</th>
                <th>Fax</th>
            </tr>
            <?php foreach($branches as $b) { ?>
                <tr>
                    <td><?php echo $b->branch_id ?></td>
                    <td><?php echo $b->manager_name?></td>
                    <td><?php echo $b->area?>, <?php echo $b->city?></td>
                    <td><?php echo $b->opening_date ?></td>
                    <td><?php echo $b->phone ?></td>
                    <td><?php echo $b->fax ?></td>
                </tr>
            <?php }?>
        </table>
    </div>
</div>
</body>
</html>