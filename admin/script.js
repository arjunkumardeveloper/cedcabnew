$(document).ready(function() {
    $('#submit').click(function() {
        // alert('click');
        var oldpass = $('#oldPass').val();
        var newpass = $('#newPass').val();
        var connewpass = $('#conNewPass').val();

        // console.log(oldpass, newpass, connewpass);
        if (newpass == connewpass) {
            $.ajax({
                url: 'ajaxRequest.php',
                type: 'POST',
                data: {
                    oldpass : oldpass,
                    newpass : newpass,
                    connewpass : connewpass,
                    action : 'changePass' 
                }, 
                success: function(msg) 
                {
                    // alert(msg);
                    if (msg == true) {
                        window.location = "logout.php";
                    } else {
                        alert("Old Password Does Not Match !");
                    }
                }
            });
        } else {
            // console.log("error");
            alert('New password and confirm password should be same !');
        }
    });

    $('.editInfo').click(function() {
        var id = $(this).data('id');
        console.log(id);
        // alert('hii');
        $('.form').show();

        $.ajax({
            url: 'ajaxRequest.php',
            type: 'POST',
            data: {
                locid : id,
                action : 'fetchForUpdate' 
            },
            dataType: "JSON", 
            success: function(msg) 
            {
                console.log(msg);
                // $('#name').text("n");
                $("#fetchname").val(msg[0]['name']);
                $('#fetchdis').val(msg[0]['distance']);
                $('#locid').val(msg[0]['id']);
                
            }
        });
    });

    $('#updateInfo').click(function() {
        var name = $("#fetchname").val();
        var distance =  $('#fetchdis').val();
        var locid = $('#locid').val();
        // alert(mobile);
        // console.log(name, mobile);
        if ((name != "") && (distance != "")) {
            $.ajax({
                url: 'ajaxRequest.php',
                type: 'POST',
                data: {
                    name : name,
                    distance : distance,
                    locid : locid,
                    action : 'Update' 
                },
                success: function(msg) 
                {
                    alert(msg);
                   window.location.reload();
                    
                }
            });
        }
    });

    $('#allRideSort').change(function(){
        $('#addRideTable').hide();
        var selectData = $(this).val();
        // alert(selectData);

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'sorting'
            },
            dataType : 'JSON',
            success : function(msg) 
            {
                
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#allRideResult').html(html);
            }
        });
    });

    $('#allRideFilter').change(function() {
        $('#addRideTable').hide();

        let selectData = $(this).val();
        // alert(selectData);

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'allRideFilter'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#allRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });

    });

    $('#pendingRideSort').change(function(){
        let selectData = $(this).val();
        // alert(selectData);
        $('#pendingRideTable').hide();

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'pendingRideSort'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#allRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });

    $('#pendingRideFilter').change(function(){
        let selectData = $(this).val();
        // alert(selectData);
        $('#pendingRideTable').hide();

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'pendingRideFilter'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#allRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });


    $('#compeleteRideSort').change(function(){
        let selectData = $(this).val();
        // alert(selectData);
        $('#compeleteRideTable').hide();

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'compeleteRideSort'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#completeRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });


    $('#compeleteRideFilter').change(function(){
        let selectData = $(this).val();
        // alert(selectData);
        $('#compeleteRideTable').hide();

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'compeleteRideFilter'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance</th><th>Luggage Weight</th><th>Total Fare</th><th>Cab Type</th><th>Status</th><th>Customer id</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = '<form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Pending" name="pending"></form><form action="allRide.php" method="post" class="cancleRide"><input type="hidden" name="rideid" value="+msg[i]["ride_id"]+"><input type="submit" value="Cancle" name="cancle"></form>';
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+msg[i]['luggage']+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+msg[i]['customer_user_id']+"</td><td><form action='allRide.php' method='post'  style='display: inline;'><input type='hidden' name='rideid' value='+msg[i]['ride_id']+'><input type='submit' value='Delete' name='submit'></form></td></tr>";
                }
                html += "</table>";
                $('#completeRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });
});

