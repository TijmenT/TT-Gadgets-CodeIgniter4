
function AddToCart(productID) {
    $.ajax({
        url: '/add-to-cart/' + productID,
        type: 'GET',
        success: function (result) {
            var popup = document.getElementById("cart-popup");
            popup.textContent = result;
            popup.style.display = "block";
            setTimeout(function () {
                popup.style.display = "none";
            }, 2000);
        }
    });
}
function UpdateCart(productID, newAmount){
    if(newAmount == 0){
        if(confirm("Weet u zeker dat u dit wilt verwijderen uit uw winkelwagen?")){
            $.ajax({
                url: '/update-cart/' + productID + "/" + 0,
                type: 'GET',
                success: function (result) {
                    window.location.reload()
                }
            });
        }
    }
    else{
        if(newAmount > 10){
            $.ajax({
                url: '/update-cart/' + productID + "/" + 10,
                type: 'GET',
                success: function (result) {
                    window.location.reload()
                }
            }); 
        }else{
        $.ajax({
            url: '/update-cart/' + productID + "/" + newAmount,
            type: 'GET',
            success: function (result) {
                window.location.reload()
            }
        }); 
    }
    }
    
}

function ApplyCoupon(){
    var coupon = document.getElementsByName("korting")[0].value;
    $.ajax({
        url: '/apply-coupon/' + coupon,
        type: 'GET',
        success: function (result) {
            if(!isNaN(result)){
                window.location.reload();
                }
            else
            {
                console.log(result);
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Invalid coupon or expired.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function RemoveDiscount(){
    $.ajax({
        url: '/remove-discount',
        type: 'GET',
        success: function (result) {
            if(result == "removed"){
                window.location.reload();
                }
            else
            {
                var popup = document.getElementById("cart-popup");
                popup.textContent = " Failed to delete discount.";
                popup.style.display = "block";
                setTimeout(function () {
                    popup.style.display = "none";
                }, 2000);
            }
        }
    });
}

function ProcessOrder(){
    console.log(document.getElementById('shippingSelect').value)
    if(document.getElementById('shippingSelect').value == "fast"){
        fastshipping = true;
    }
    else if(document.getElementById('shippingSelect').value == "standaard"){
        fastshipping = false;
    }
    $.ajax({
        url: '/checkout-order/'+fastshipping,
        type: 'GET',
        success: function (result) {
            if(result){
                location.href = result
            }
        }
    });
}

function NeedsLogin(){
    location.href = "/login";
}


