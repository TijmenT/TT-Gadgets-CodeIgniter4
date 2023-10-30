function SearchOrder(){
    var order_ID = document.getElementsByName("search")[0].value;
    $.ajax({
        url: '/does-order-exist/' + order_ID,
        type: 'GET',
        success: function (result) {
            if(result == "yes"){
                location.href = "/admin-order-info/"+order_ID;
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Order bestaat niet.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function SearchUser(){
    var user_ID = document.getElementsByName("search")[0].value;
    $.ajax({
        url: '/does-user-exist/' + user_ID,
        type: 'GET',
        success: function (result) {
            console.log(result)
            if(!isNaN(result)){
                location.href = "/admin-user-info/"+user_ID;
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " User bestaat niet.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function ResetPassword(customer_ID){
    $.ajax({
        url: '/reset-password/' + customer_ID,
        type: 'GET',
        success: function (result) {
            console.log(result)
            if(result == "success"){
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Wachtwoord resetted.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Kon wachtwoord niet resetten.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function DisableUser(customer_ID){
    $.ajax({
        url: '/disable-user/' + customer_ID,
        type: 'GET',
        success: function (result) {
            console.log(result)
            if(result == "success"){
                window.location.reload();
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Kon gebruiker niet uitschakelen.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function EnableUser(customer_ID){
    $.ajax({
        url: '/enable-user/' + customer_ID,
        type: 'GET',
        success: function (result) {
            console.log(result)
            if(result == "success"){
                window.location.reload();
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Kon gebruiker niet inschakelen.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}