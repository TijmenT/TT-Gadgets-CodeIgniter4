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