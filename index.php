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
// session_start();
 require 'header.php';
 require 'DbConnection.php';
 require 'Location.php';
// echo $_SESSION['is_admin'];
if (isset($_SESSION['is_admin'])&&$_SESSION['is_admin'] == 1) {
    header('location: admin/index.php');
}

$Dbconn = new DbConnection();
$Location = new Location();
$data = $Location->fetchLocationAvai($Dbconn->conn);
// print_r($data);

?>
    <div class="container-fluid">
        <!-- <img src="2.jpeg" alt=""> -->
        <div class="container text-center">
            <h3 class="display-4">Book a City Taxi to your destination in town</h3>
            <p class="headpara">Choose from a range of categories and prices</p>

            <div class="row text-dark">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <span id="header">CITY TAXI</span>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Your everyday travel partner</h5>
                            <h6>AC Cabs for point to point travel</h6>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="pickup">PICKUP</label>
                                    </div>
                                    <select class="form-control g" id="pickup">
                                        <option value="">Current</option>
                                        <?php
                                        foreach ($data as $row) {
                                            ?>
                                                <option value="<?php echo $row['name'] ?>">
                                            <?php echo $row['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                        <!-- <option value="charbagh">Charbagh</option>
                                        <option value="indira nagar">Indira Nagar</option>
                                        <option value="bbd">BBD</option>
                                        <option value="barabanki">Barabanki</option>
                                        <option value="faizabad">Faizabad</option>
                                        <option value="basti">Basti</option>
                                        <option value="gorakhpur">Gorakhpur</option> -->
                                    </select>
                                </div>
                                <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="drop">DROP</label>
                                    </div>
                                    <select class="form-control g" id="drop">
                                        <option value="">Destination</option>
                                        <?php
                                        foreach ($data as $row) {
                                            ?>
                                                <option value="<?php echo $row['name'] ?>">
                                            <?php echo $row['name'] ?></option>
                                            <?php
                                        }
                                        ?>
                                        <!-- <option value="charbagh">Charbagh</option>
                                        <option value="indira nagar">Indira Nagar</option>
                                        <option value="bbd">BBD</option>
                                        <option value="barabanki">Barabanki</option>
                                        <option value="faizabad">Faizabad</option>
                                        <option value="basti">Basti</option>
                                        <option value="gorakhpur">Gorakhpur</option> -->
                                    </select>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="cab">CAB TYPE</label>
                                    </div>
                                    <select class="form-control g" id="cab" onchange="cabType()">
                                    <option value="">Cab</option>
                                        <option value="cedmicro">CedMicro</option>
                                        <option value="cedmini">CedMini</option>
                                        <option value="cedroyal">CedRoyal</option>
                                        <option value="cedsuv">CedSUV</option>
                                    </select>
                                </div>
                                </div>
                                <div class="input-group mb-3" id="luggage">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                        id="inputGroup-sizing">LUGGAGE</span>
                                    </div>
                                    <input type="text" id="lugg" class="form-control" aria-label="Small" placeholder="Enter weight in KG" onkeypress="return checkNum()">
                                </div>
                            <!-- <a id="calculate" class="btn w-100">Calculate Fare</a> -->
                            <!-- Button trigger modal -->
                                <button type="button" class="btn w-100 btn-primary mt-3" name="booknow" data-toggle="modal" id="calculate" data-target="#exampleModal">
                                    Calculate Fare
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Your Ride Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-left" id="msg-body">
                                        <!-- <p id="pickloc"></p>
                                        <p id="droploc"></p>
                                        <p id="distance"></p>
                                        <p id="price"></p>
                                        <p id="cab"></p> -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="sendRequest" >Request Taxi</button>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    require 'footer.php';
?>