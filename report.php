<?php
error_reporting(1);
include('includes/configuration.php');
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report</title>
    <style>
           body{
               background:#666;
               padding:.7rem 10%;
           }
            .main-report{
            border: .1px solid gray;
        }

th {
  text-align: left;
}

.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 20px;
  border-collapse:collapse;
}

.table-bordered {
  border: .3px solid #ddd;
}

.table-striped > tbody > tr:nth-of-type(odd) {
  background-color: #f9f9f9;
}
.table-responsive {
  overflow-x: auto;
  min-height: 0.01%;
}

*{
    font-family:century Gothic;
}
.allreport{
                    padding: 2rem 6rem;
                    background:white;
                }
                .backbtn{
                    padding:1rem;
                    margin-left:-8rem;
                    position: absolute;
                }
                .backbtn button{
                    outline:none;
                    border:none;
                    padding:.6rem 1.5rem;
                    border-radius:.2rem;
                }
                .backbtn button:hover{
                    background:lightblue;
                }
                .printmedia{
                    margin:1rem;
                }
               

            @media print{
                body{
                    padding:0 1rem;
                    background:white;
                }
                .allreport{
                    padding: 1rem;
                }
        
                .printmedia{
                    display: none;
                }
                .backbtn{
                    display:none;
                }
            }
    </style>
</head>
<body>
    <div class="backbtn">
        <button class="btn btn-primary" onclick="window.location='reporte.php'">Back</button>
    </div>
    <div class="allreport">
       
        <div class="main-report" style="Padding:1rem">
        <style>
                            th{
                                background:#2196F3;
                                color:white;
                                padding: .3rem;
                                padding-left:-200px;
                            }
                             
                             
                               table tr,td,th{
                                  font-family:-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        
                               }
                               .h2{
                                   font-weight:500;
                               }
                               .datereport{
                                   margin-left:76%;
                                   font-weight:500;
                               }
                               .dail{
                                   font-size:1.5rem;
                                   font-weight:400;
                               }
                               .total{
                                    background:lightgreen;
                                    color:#000;
                                    font-weight:500;
                                    padding-left:2rem;
                                    
                               }
                               .totals{
                                    background:lightgray;
                                    color:#000;
                                    font-weight:500;
                                    padding-left:2rem;
                                    
                               }
                               .title, .g{
                                   text-align:left;
                                   padding-left:2rem;
                                   font-weight:700;
                               }
                               h2{
                                   font-weight:650;
                               }
                            </style>
                    <div class="h2">
                        <img src="./images/logo1.png" alt="Festimo">
                       
                        <h4><img  height="20" width="20" src="images/company.png"/> WASAC Group</h4>
                        <h4 style="margin-top:-.5rem;"> <img height="20" width="20" src="images/external-location-maps-locations-those-icons-lineal-those-icons-6.png"/> Nyanza</h4>
                        <h4 style="margin-top:-.5rem;"> <img height="20" width="20"  src="images/external-call-mobile-telephone-those-icons-fill-those-icons.png"/> +250 781 110 859</h4>
                        
                        
        
        
                    </div>
                    <div class="datereport">
                        Date: <?php
                        if (isset($_POST['searchcategory'])) {
                            # code...
                        
                        echo $_POST['search'];} ?>
                    </div>
                    <div class="dail">
                       <h4><img  height="20" width="20"  src="images/day-view.png"/> Daily Water Bill Report</h4> 
                    </div>
                    <hr>
            
                    <div class="tableee">
                        <table  border="1" class="table table-striped table-bordered">
                        <tr>
                            <th style="line-height:1rem ; font-size:.82rem" colspan="3" class="title"><img  height="14" width="20"  src="images/title.png"/> <?php echo " Assigned Meter"; ?></th>
                        </tr>
                   

                       
                            <tr>
                <?php if (isset($_POST['searchcategory'])) {
        $SearchTerm = $_POST['search'];
        $recordlunch = mysqli_query($conn,"SELECT * FROM `lunch` WHERE CONCAT(`e_date`) LIKE '%$SearchTerm%' 
        
        
        "); // fetch data from database                       
        while($datalunch = mysqli_fetch_assoc($recordlunch)){  ?>
                <td style="line-height:1rem; padding:0 2rem; font-size:.85rem"><?php echo $datalunch['e_worker']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<?php echo $datalunch['meter_used']; ?>)M³</td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.85rem"><?php echo $datalunch['amaount']; ?> </td>
        
        </tr>
        <?php
             $ttlunch = $ttlunch + $datalunch['amaount'];
            }}
        ?>
        <tr class="totals">
        
                <td style="font-size:.82rem"   class="g"> <img  height="12" width="20" src="images/total-sales-1.png"/><?php echo "Total"; ?> </td>
                <td style="padding:0 2rem; font-size:.82rem" ><?php echo $ttlunch; ?>  Rwf</td>
        
        </tr>
        <?php
        
        //get list category
        //$records = mysqli_query($conn,"SELECT * FROM `expense` ,`sub-details` WHERE `expense`.e_id = `sub-details`.e_id AND `expense`.e_date='$SearchTerm'"); // fetch data from database
        
        //search list category
        
        if (isset($_POST['searchcategory'])) {
        $SearchTerm = $_POST['search'];
        $records = mysqli_query($conn,"SELECT * FROM `expense` ,`sub-details` WHERE CONCAT(`e_date`) LIKE '%$SearchTerm%' AND  `expense`.e_id = `sub-details`.e_id  "); // fetch data from database
        
        while($data = mysqli_fetch_assoc($records)){ 
        
    
         ?>
         
                        <tr>
                            <th style="line-height:1rem ; font-size:.77rem; font-weight:480" colspan="2" class="title"><img  height="14" width="20"  src="images/title.png"/> <?php echo $data['e_title']; ?></th>
                        </tr>
                        <tr>
                
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php echo $data['e_detail']; ?></td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php if( $data['e_amount'] > 0){ echo $data['e_amount']; } ?> </td>
        
        </tr>
        <tr>
                
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php echo $data['e_detail2']; ?></td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php if( $data['e_amount2'] > 0){echo $data['e_amount2'];} ?></td>
        
        </tr>
        <tr>
                
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;" ><?php echo $data['e_detail3']; ?></td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php if( $data['e_amount3'] > 0){ echo $data['e_amount3']; }?></td>
        
        </tr>
        <tr>
              
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php echo $data['e_detail4']; ?></td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php if( $data['e_amount4'] > 0){ echo $data['e_amount4']; }?></td>
        
        </tr>
        <tr>
             
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php echo $data['e_detail5']; ?></td>
                <td style="line-height:1rem; padding:0 2rem; font-size:.82rem;"><?php  if( $data['e_amount5'] > 0){echo $data['e_amount5'];} ?> </td>
        
        </tr>
        <?php   
        $tt= $data['e_amount'] + $data['e_amount2'] + $data['e_amount3'] + $data['e_amount4'] + $data['e_amount5'];  ?>
        <tr class="totals">
             
                <td  style=" font-size:.82rem" class="g"> <img  height="12" width="20" src="images/total-sales-1.png"/><?php echo "Total"; ?> </td>
                <td style="padding:0 2rem; font-size:.82rem" ><?php echo $tt; ?>  Rwf</td>
        
        </tr>
        
        
        <?php   
        
        
        $sum = $sum+$tt;
        
        }}?>
        <tr class="total">
            <td  style="  font-weight:500;" class="g"><img  height="13" width="20" src="images/total-sales-1.png"/>Amount payed</td>
            <td style="  text-align:right; font-weight:500; "><?php echo number_format($sum+$ttlunch);  ?>&nbsp;&nbsp;&nbsp; Rwf</td>
        </tr>
        <tr class="total"  style="background-color:rgb(255, 229, 82)">
            <?php 
            
        $s = mysqli_query($conn,"SELECT * FROM `money`  WHERE CONCAT(`m_date`) LIKE '%$SearchTerm%'");
            while($d=mysqli_fetch_array($s)){
                $input = $d['new_money'];
                $total= $input+$total;
            }
            ?>
            <td style="  font-weight:500;" class="g"><img  height="13" width="20" src="images/total-sales-1.png"/>total amount to be pay</td>
            <td style="  font-weight:500;   text-align:right;"><?php echo number_format($total);   ?>&nbsp;&nbsp;&nbsp; Rwf</td>
        </tr>
        <tr class="total"  style="background-color:rgb(91, 150, 98)">
            <td style="  font-weight:500; " class="g">BALANCE</td>
            <td style="  font-weight:500;  text-align:right;"><?php echo number_format($total-($sum+$ttlunch));  ?>&nbsp;&nbsp;&nbsp; Rwf</td>
        </tr><tr class="total" style="background-color:rgb(255, 99, 71);">
    <td style="font-weight:500;" class="g"><img height="13" width="20" src="images/penalty.png"/> Total Penalties</td>
    <td style="font-weight:500; text-align:right;">
        <?php
        $totalPenalties = 0;
        $sql = "SELECT customer_account, SUM(penalty_amount) as total_amount, status FROM `penalty` WHERE `penalty_date` LIKE '%$SearchTerm%' GROUP BY customer_account";
        $penaltyQuery = mysqli_query($conn, $sql);

        // Check for errors
        if (!$penaltyQuery) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($penalty = mysqli_fetch_array($penaltyQuery)) {
            echo "<strong>Account:</strong> " . htmlspecialchars($penalty['customer_account']) . " : " . number_format($penalty['total_amount']) . " Rwf<br>";
            $totalPenalties += $penalty['total_amount'];
        }

        echo "<hr><strong>Total:</strong> " . number_format($totalPenalties) . "&nbsp;&nbsp;&nbsp; Rwf";
        ?>
    </td>
</tr><tr class="total" style="background-color:rgb(100, 100, 255)">
    <td style="font-weight:500;" class="g"><img height="13" width="20" src="images/payment.png"/> Total Payments</td>
    <td style="font-weight:500; text-align:right;">
        <?php 
        $paymentTotal = 0;
        $sql = "SELECT customer_account, SUM(amount) AS total_amount FROM `payments` WHERE `payment_date` LIKE '%$SearchTerm%' GROUP BY customer_account";
        $pay = mysqli_query($conn, $sql);

        // Check for errors
        if (!$pay) {
            die("Query failed: " . mysqli_error($conn));
        }

        while ($payment = mysqli_fetch_array($pay)) {
            echo "<strong>Account:</strong> " . htmlspecialchars($payment['customer_account']) . " : " . number_format($payment['total_amount']) . " Rwf<br>";
            $paymentTotal += $payment['total_amount'];
        }

        echo "<hr><strong>Total:</strong> " . number_format($paymentTotal) . "&nbsp;&nbsp;&nbsp; Rwf";
        ?>
    </td>
</tr>

<tr class="total" style="background-color:rgb(91, 150, 98)">
    <td style="font-weight:500;" class="g">FINAL BALANCE</td>
    <td style="font-weight:500; text-align:right;">
        <?php echo number_format($total - ($sum + $ttlunch + $penaltyTotal - $paymentTotal)); ?>&nbsp;&nbsp;&nbsp; Rwf
    </td>
</tr>


        </table>
                    </div>
    
    
    </div>
    
    <div class="printmedia">
        <button has-success onclick="window.print()" style="  padding:.4rem 3rem 0rem .4rem;"> <img src="images/printer-door-open.png"/> <span style="padding:.3rem; position:absolute; ">Print</span></button>
         
    </div>
    
</body>
</html>



