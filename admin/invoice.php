<?php
/**
 * The file doc comment
 * php version 7.2.10
 * 
 * @category Class
 * @package  Package
 * @author   Original Author <author@example.com>
 * @license  https://www.cedcoss.com cedcoss 
 * @link     link
 */

//  session_start();
 require '../DbConnection.php';
 require 'header.php';
 require '../Ride.php';

 $Ride = new Ride();
 $Dbconn = new DbConnection();

 
$id = $_GET['id'];

$invoice = $Ride->fetchInvoice($id, $Dbconn->conn);
// allRidesTotal($Dbconn->conn);
// print_r($invoice);
?>
<section>
    <div class="wrapper">
        <h3>Invoice</h3>
        <div class="invoice" id="invoice">
            <p><strong>Ride Request Date: </strong><?php echo $invoice['ride_date']; ?></p>
            <p><strong>Pickup Location: </strong><?php echo $invoice['pickup']; ?></p>
            <p><strong>Drop Location: </strong><?php echo $invoice['droplocation']; ?></p>
            <p><strong>Total Distance: </strong><?php echo $invoice['total_distance']; ?></p>
            <p><strong>Luggage Weight: </strong><?php echo $invoice['luggage']; ?></p>
            <p><strong>Total Fare: </strong><?php echo $invoice['total_fare']; ?></p>
            <p><strong>Cab Type: </strong><?php echo $invoice['cab']; ?></p>
            <a href="completeRide.php" class="active" id="back">Back</a>
            <a onclick="printPageArea('invoice')" class="active" id="active">Print Invoice</a>
        </div>
    </div>
</section>

<script>
    function printPageArea(invoice){
    document.getElementById('active').style.display = 'none';
    document.getElementById('back').style.display = 'none';
    var printContent = document.getElementById(invoice);
    var WinPrint = window.open('', '', 'width=900,height=650');
    WinPrint.document.write(printContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
}
</script>

<?php
    require 'footer.php';
?>