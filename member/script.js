if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
function concancle()
{
    var arjun = confirm('Are you sure want to Cancel this ride..?'); 
    if (arjun == true) {
        return true;
    } else {
        return false;
    }
}
$(document).ready(function() {
    $('#submit').click(function() {
        // alert('click');
        var oldpas = $('#oldPass').val();
        oldpass = oldpas.trim();
        var newpas = $('#newPass').val();
        newpass = newpas.trim();
        var connew = $('#conNewPass').val();
        connewpass = connew.trim();

        
        if (oldpass == "") {
            alert('Old password is required !');
            return false;
        } else if (newpass == "") {
            alert('New Password is required');
            return false;
        } else if (connewpass == "") {
            alert('Confirm Password is required');
            return false;
        } else if (oldpass === newpass) {
            alert('Old password and new password could not be same !');
            return false;
        } 

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
                        alert('Your password has been changed successfully !');
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

    $('#editInfo').click(function() {
        // alert('hii');
        $('.form').show();

        $.ajax({
            url: 'ajaxRequest.php',
            type: 'POST',
            data: {
                action : 'fetchForUpdate' 
            },
            dataType: "JSON", 
            success: function(msg) 
            {
                console.log(msg[0]['name']);
                // $('#name').text("n");
                $("#fetchname").val(msg[0]['name']);
                $('#fetchmobile').val(msg[0]['mobile']);
                
            }
        });
    });

    $('#updateInfo').click(function() {
        var name = $("#fetchname").val();
        var mobile =  $('#fetchmobile').val();
        // alert(mobile);
        // console.log(name, mobile);
        if (name == "") {
            alert('Name field is required !');
            return false;
        } else if (mobile == "") {
            alert('Mobile field is required !');
            return false;
        }

        if ((name != "") && (mobile != "")) {
            $.ajax({
                url: 'ajaxRequest.php',
                type: 'POST',
                data: {
                    name : name,
                    mobile : mobile,
                    action : 'Update' 
                },
                success: function(msg) 
                {
                   window.location.reload();
                    
                }
            });
        }
    });

    $('#sortData').change(function() {
        $('#allRideTable').hide();
        var data = $(this).val();
        // alert(data);
        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : data,
                action : 'sorting'
            },
            dataType : 'JSON',
            success : function(msg) 
            {
                // alert(msg[i]['ride_date']);
                // console.log(msg['ride_date']);
                // console.log(msg[0]['ride_date']);
                
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance (in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        // var status = document.write("Approved");
                        status = "Approved";
                    } else {
                        // var status = document.write('Cancelled');
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    if (msg[i]['status'] == 1) {
                        action = "<form action='allRides.php' method='post' class='cancleRide'><input type='hidden' name='rideid' value='"+msg[i]['ride_id']+"'><input type='submit' value='Cancel' name='cancle' onclick='return concancle()'></form>";
                    } else {
                        action = "--";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+ msg[i]['cab'] +"</td><td>"+status+"</td><td>"+action+"</td></tr>";
                }
                html += "</table>";
                $('#Rideresult').html(html);
            }
        });
    });


    $('#filterData').change(function(){
        $('#allRideTable').hide();
        let selectData = $(this).val();
        // alert(selectData);

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'filter'
            },
            dataType : 'JSON',
            success: function(msg)
            {
                // alert(msg);
                console.log(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance (in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        status = "Approved";
                    } else {
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    if (msg[i]['status'] == 1) {
                        action = "<form action='allRides.php' method='post' class='cancleRide'><input type='hidden' name='rideid' value='"+msg[i]['ride_id']+"'><input type='submit' value='Cancel' name='cancle' onclick='return concancle()'></form>";
                    } else {
                        action = "--";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+action+"</td></tr>";
                }
                html += "</table>";
                $('#Rideresult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });

    });

    $('#pendingRideFilter').change(function(){
        $('#pendingRideTable').hide();
        let selectData = $(this).val();
        // alert(selectData);

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'pendingFilter'
            },
            dataType : 'JSON',
            success : function(msg)
            {
                // alert(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance (in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        status = "Approved";
                    } else {
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    if (msg[i]['status'] == 1) {
                        action = "<form action='pendingRides.php' method='post' class='cancleRide'><input type='hidden' name='rideid' value='"+msg[i]['ride_id']+"'><input type='submit' value='Cancel' name='cancle' onclick='return concancle()'></form>";
                    } else {
                        action = "--";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+action+"</td></tr>";
                }
                html += "</table>";
                $('#pendingRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });

    $('#sortDataPendingRide').change(function(){
        $('#pendingRideTable').hide();
        let selectData = $(this).val();
        // alert(selectData);
        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'sortPendingRide'
            },
            dataType : 'JSON',
            success : function(msg)
            {
                // alert(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance (in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th><th>Action</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        status = "Approved";
                    } else {
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    if (msg[i]['status'] == 1) {
                        action = "<form action='pendingRides.php' method='post' class='cancleRide'><input type='hidden' name='rideid' value='"+msg[i]['ride_id']+"'><input type='submit' value='Cancel' name='cancle' onclick='return concancle()'></form>";
                    } else {
                        action = "--";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td><td>"+action+"</td></tr>";
                }
                html += "</table>";
                $('#pendingRideResult').html(html);
            },
            error : function(error)
            {
                alert('error');
            }
        });
    });

    $('#sortDataCompleteRide').change(function(){
        $('#completeRideTable').hide();
        let selectData = $(this).val();
        // alert(selectData);
        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'sortCompleteRide'
            },
            dataType : 'JSON',
            success : function(msg)
            {
                // alert(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance (in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        status = "Approved";
                    } else {
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td></tr>";
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



    $('#completeRideFilter').change(function(){
        $('#completeRideTable').hide();
        let selectData = $(this).val();
        // alert(selectData);

        $.ajax({
            url : 'ajaxRequest.php',
            type : 'POST',
            data : {
                sdata : selectData,
                action : 'completeFilter'
            },
            dataType : 'JSON',
            success : function(msg)
            {
                // alert(msg);
                var html = "<table><tr><th>Sr.No.</th><th>Ride Date</th><th>Pickup Location</th><th>Drop Location</th><th>Total Distance(in km)</th><th>Luggage Weight (in kg)</th><th>Total Fare (Rs)</th><th>Cab Type</th><th>Status</th></tr>";
                sr = 1;
                for (var i = 0; i < msg.length; i++) {
                    if (msg[i]['status']==1) {
                        status = "Pending..";
                    } else if (msg[i]['status'] == 2) {
                        status = "Approved";
                    } else {
                        status = "Cancelled";
                    }

                    if (msg[i]['luggage'] != "") {
                        luggage = msg[i]['luggage'];
                    } else {
                        luggage = "--";
                    }

                    html += "<tr><td>"+ sr++ +"</td><td>"+msg[i]['ride_date']+"</td><td>"+msg[i]['pickup']+"</td><td>"+msg[i]['droplocation']+"</td><td>"+msg[i]['total_distance']+"</td><td>"+luggage+"</td><td>"+msg[i]['total_fare']+"</td><td>"+msg[i]['cab']+"</td><td>"+status+"</td></tr>";
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