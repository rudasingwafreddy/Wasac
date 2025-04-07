<?php
include('includes/session.php');
include('includes/config.php');
include('includes/configuration.php');

if ($_SESSION["username"]) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Category</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
</head>
<body>
<div class="main-wrapper">

    <?php include('includes/topbar.php'); ?>

    <div class="content-wrapper">
        <div class="content-container">
            <?php
            if ($rolecheck['user_role'] == 'Administrator') {
                include('includes/leftbar.php');
            } else {
                include('includes/userleftbar.php');
            }
            ?>

            <div class="main-page">
                <div class="container-fluid">
                    <div class="row page-title-div">
                        <div class="col-md-6">
                            <h2 class="title">Manage Penalty</h2>
                        </div>
                    </div>

                    <section class="section">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <h5>View Penalty Info</h5>
                                        </div>

                                        <div class="panel-body p-20">
                                            <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Category</th>
                                                        <th>Meter Number</th>
                                                        <th>Customer Account</th>
                                                        <th>Installment Amount</th>
                                                        <th>Billing Date</th>
                                                        <th>Penalty Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                              <?php
$sql = "SELECT m.*, p.status FROM money m LEFT JOIN penalty p ON m.customer_account = p.customer_account";
$query = $dbh->prepare($sql);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);

if ($query->rowCount() > 0) {
    foreach ($results as $result) {
        // Check if 30 days have passed since m_date
        $billingDate = strtotime($result->m_date);
        $currentDate = time();
        $daysPassed = ($currentDate - $billingDate) / (60 * 60 * 24);

        // Button properties based on penalty status
        if ($result->status == 'paid') {
            $buttonClass = "btn btn-secondary";  // Grayed out button
            $buttonText = "No Penalty";
            $disabled = "disabled";  // Disable the button
        } else {
            $buttonClass = ($daysPassed >= 30) ? "btn btn-danger penalty-btn" : "btn btn-secondary";
            $buttonText = ($daysPassed >= 30) ? "Approve Penalty" : "No Penalty";
            $disabled = ($daysPassed < 30) ? "disabled" : "";  // Disable button until 30 days have passed
        }
?>
<tr>
    <td><?php echo htmlentities($result->category); ?></td>
    <td><?php echo htmlentities($result->meter_number); ?></td>
    <td><?php echo htmlentities($result->customer_account); ?></td>
    <td><?php echo htmlentities($result->divided_amount); ?></td>
    <td><?php echo htmlentities($result->m_date); ?></td>
    <td>
        <button class="<?php echo $buttonClass; ?>"
                data-account="<?php echo $result->customer_account; ?>"
                data-meter="<?php echo $result->meter_number; ?>"
                <?php echo $disabled; ?>>
            <?php echo $buttonText; ?>
        </button>
    </td>
</tr>
<?php
    }
}
?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Penalty Modal -->
<div id="penaltyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Approve Penalty</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="insert_penalty.php" method="post">
                    <div class="form-group">
                        <label>Customer Account</label>
                        <input type="text" id="customer_account" name="customer_account" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Meter Number</label>
                        <input type="text" id="meter_number" name="meter_number" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Penalty Amount</label>
                        <input type="text" name="penalty_amount" class="form-control" value="5000" readonly>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" name="description" class="form-control" value="Penalty" readonly>
                    </div>
                    <div class="form-group">
                        <label>Penalty Date</label>
                        <input type="text" name="penalty_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Penalty</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $(".penalty-btn").click(function () {
        var customerAccount = $(this).data("account");
        var meterNumber = $(this).data("meter");

        $("#penaltyModal").modal("show");
        $("#customer_account").val(customerAccount);
        $("#meter_number").val(meterNumber);
    });
});
</script>
</body>
</html>

<?php } else { header("Location: index.php"); } ?>
