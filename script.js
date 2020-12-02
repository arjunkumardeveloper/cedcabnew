
function cabType() {
    var cab = document.getElementById('cab').value;
    if (cab == "cedmicro") {
        document.getElementById('luggage').style.display = 'none';
    } else {
        document.getElementById('luggage').style.display = 'flex';
    }
}
function checkNum() {
    if ((event.keyCode > 47) && (event.keyCode < 58)) {
        return true;
    } else {
        alert("Please enter numeric value only !");
        return false;
    }
}
// $('#submit').click(function(){
//     alert('hi');
// });
// $( "#pickup" ).change(function() {
//     // alert( "Handler for .change() called." );
//     var pick = $(this).val();
//     // alert(pick);
//     $('#drop').each(function(){
//         console.log($(this).text());
//         if ($(this).text() == pick) {
//             $('#drop option[value='+pick+']').hide();
//         } else {
//             $('#drop option[value='+pick+']').show();
//         }
//     });
//   });

$(document).ready(function() {
    $('#calculate').click(function() {
        // alert('hi');
        var pickup = document.getElementById('pickup').value;
        var drop = document.getElementById('drop').value;
        var cab = document.getElementById('cab').value;
        var lugg = document.getElementById('lugg').value;
        // alert(pickup, drop, cab, lugg);
        if (pickup == "") {
            alert("Pickup field is mandatory");
            return false;
        } else if (drop == "") {
            alert("Destination field is mandatory");
            return false;
        } else if (cab == "") {
            alert("CAB type is mandatory");
            return false;
        } else if (pickup == drop) {
            alert('Choose different location');
            return false;
        } else {
           // console.log(pickup, drop, cab, lugg);
           $.ajax({
                url : 'calculate.php',
                type : 'POST',
                data : {
                    pickup : pickup,
                    drop : drop, 
                    cab : cab, 
                    lugg : lugg,
                    submit: true
                },
                dataType : 'json',
                success : function(result) {
                    // alert(result);
                    // document.getElementById('price').innerHTML = "Price: "+result['price']+"/-";
                    // document.getElementById('distance').innerHTML = "Distance: "+result['distance']+" KM";
                    if (result) {
                        // document.getElementById('calculate').innerHTML = "Total Fare: " + result['price'] + "/-";

                        // $('#sendRequest').show();msg-body
// alert(result);
console.log(result);
                        document.getElementById('msg-body').innerHTML = "Total Distance: " + result['distance'] + "KM <br> Total Fare: " + result['price'] + "/- <br> Pickup Location: " + result['pickup'] + "<br> Drop Location: " + result['drop'] + "<br> Cab Type: " + result['cab'] + "<br> Luggage: " + result['lugg'];

                        // document.getElementById('distance').innerHTML = "Total Distance: "+result['distance']+" KM";
                        // document.getElementById('price').innerHTML = "Total Fare: "+result['price']+"/-";
                        // document.getElementById('pickloc').innerHTML = "Pickup Location: "+result['pickup'];
                        // document.getElementById('droploc').innerHTML = "Drop Location: "+result['drop'];
                        // document.getElementById('cab').innerHTML = "Drop Location: "+result['cab'];
                        // alert('success');
                    }
                    // console.log(result['price']);
                },
                error: function(error) {
                    alert('error');
                    // console.log()
                }
           });
        }
    });
    // $('input, select').focus(function() {
    //     document.getElementById('calculate').innerHTML = "Calculate Fare";
    // });
    $('#sendRequest').click(function(){
        // alert('hii');
        var pickup = document.getElementById('pickup').value;
        var drop = document.getElementById('drop').value;
        var cab = document.getElementById('cab').value;
        var lugg = document.getElementById('lugg').value;

        console.log(pickup, drop, cab, lugg);
        $.ajax({
            url: 'calculate.php',
            method: 'POST',
            data: {
                pickup : pickup,
                drop : drop,
                cab : cab,
                lugg : lugg,
                operation: true
            },
            
            success: function(msg) {
                // console.log(msg);
                // alert(msg);
                if (msg == true) {
                    // $(location).attr('href', 'login.php');
                    // alert("Login First");
                    window.location.href = "login.php";
                } else {
                    // alert('Your Ride Request send successfully !');
                    window.location.href = "member/index.php";
                }
            },
            error: function(error) {
                alert(errro);
            }

        });
        
    });
});