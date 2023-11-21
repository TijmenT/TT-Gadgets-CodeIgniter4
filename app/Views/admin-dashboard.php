<?php
        $request = service('request');

$uri = $request->uri->getPath();

if (str_contains($uri, "week")) {
    $filtertype = "week";
    $differencetext = " vergeleken met vorige week";
    ?>
    <script>
    window.onload = function() {
        document.getElementsByClassName('week--timespand')[0].selected = true;
    };
    </script>
    <?php
}
elseif(str_contains($uri,"maand")) {
    $filtertype = "month";
    $differencetext = " vergeleken met vorige maand";
    ?>
    <script>
    window.onload = function() {
        document.getElementsByClassName('maand--timespand')[0].selected = true;
    };
    </script>
    <?php

}
elseif(str_contains($uri,"altijd")) {
    $filtertype = "altijd";
    $differencetext = "";
    ?>
    <script>
    window.onload = function() {
        document.getElementsByClassName('altijd--timespand')[0].selected = true;
    };
    </script>
    <?php

}else{
    $filtertype = "vandaag";
    $differencetext = " vergeleken met gisteren";

}

$hoursCountToday = [
    '00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0,
    '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0,
    '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0,
    '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0,
    '20' => 0, '21' => 0, '22' => 0, '23' => 0
];

$hoursCountYesterday = [
    '00' => 0, '01' => 0, '02' => 0, '03' => 0, '04' => 0,
    '05' => 0, '06' => 0, '07' => 0, '08' => 0, '09' => 0,
    '10' => 0, '11' => 0, '12' => 0, '13' => 0, '14' => 0,
    '15' => 0, '16' => 0, '17' => 0, '18' => 0, '19' => 0,
    '20' => 0, '21' => 0, '22' => 0, '23' => 0
];

$totalToday = 0;
foreach ($orders_one as $order) {
    $hour = substr($order['time'], 0, 2);
    $totalToday += $order['amount'];
    if (isset($hoursCountToday[$hour])) {
        $hoursCountToday[$hour]+= $order['amount'];
    }
}
$totalYesterday = 0;
foreach ($orders_two as $order) {
    $hour = substr($order['time'], 0, 2);
    $totalYesterday += $order['amount'];
    if (isset($hoursCountYesterday[$hour])) {
        $hoursCountYesterday[$hour]+= $order['amount'];
    }
}

if ($totalToday == 0) {
    $percentageDifference = ($totalYesterday == 0) ? 0 : 100;
} else {
    $percentageDifference = (($totalToday - $totalYesterday) / abs($totalToday)) * 100;
}




?>

<head>
    <script src="../assets/js/chart.js"></script>
</head>

<body>
<style>
    #myChart {
        max-width: 150rem !important;
        max-height: 35rem !important;
    }

    #productChart {
        max-width: 90rem !important;
        max-height: 35rem !important;
    }
</style>
<div class="stats--container">
<div id="stats-grid-item" class="renevue--container">
    <select onchange="ChangeTimeSpan()" class="timespan--picker" name="timespand" id="">
        <option class="day--timespand" value="">Vandaag</option>
        <option class="week--timespand" value="week">Week</option>
        <option class="maand--timespand" value="maand">Maand</option>
        <option class="altijd--timespand" value="altijd">Altijd</option>
    </select>
    <h1 id="revenue--header" >€<?php echo number_format($totalToday, 2, ',', '.'); ?></h1>
    <?php
    if(substr($percentageDifference, 0, 1) == "-"){
    ?>
    <h1 id="revenue--difference" ><span style="color: red;"><span class="countup"><?php echo number_format($percentageDifference,0)?></span>%</span><?php echo $differencetext?></h1>
    <?php
    }
    else{
        ?>
            <h1 id="revenue--difference" ><span style="color: green;">+<span class="countup"><?php echo number_format($percentageDifference,0)?></span>%</span><?php echo $differencetext?></h1>

    <?php
    }
    ?>
</div>
<div id="stats-grid-item" class="sales--container">
<canvas id="myChart"></canvas>
</div>
<div id="stats-grid-item" class="topproducts--container">
<canvas id="productChart"></canvas>
</div>
<div id="stats-grid-item" class="counts--container">
<a href="/admin-users" style="text-decoration: none; color: black" class="count--item" ><img class="count--img" width="150px" src="../assets/img/countprofile.png"/><h1 class="count--label">Gebruikers</h1><br><h1 class="count--amount" ><?php echo $usersamount;?></h1></a>
<a href="/admin-products" style="text-decoration: none; color: black" class="count--item" ><img class="count--img" width="150px" src="../assets/img/products.png"/><h1 class="count--label">Producten</h1><br><h1 class="count--amount" ><?php echo $productsamount;?></h1></a>
<a href="/admin-orders" style="text-decoration: none; color: black" class="count--item" ><img class="count--img" width="150px" src="../assets/img/order.png"/><h1 class="count--label">Orders</h1><br><h1 class="count--amount" ><?php echo $ordersamount;?></h1></a>
<a href="/admin-coupons" style="text-decoration: none; color: black" class="count--item" ><img class="count--img" width="150px" src="../assets/img/coupon.png"/><h1 class="count--label">Coupons</h1><br><h1 class="count--amount" ><?php echo $couponsamount;?></h1></a>
</div>
</div>

</body>
</html>


<script defer>
function ChangeTimeSpan(){
    timespan = document.getElementsByName("timespand")[0].value
    location.href = "/admin-dashboard/"+timespan
}


const animationDuration = 2000;
const frameDuration = 1000 / 60;
const totalFrames = Math.round( animationDuration / frameDuration );
const easeOutQuad = t => t * ( 2 - t );

const animateCountUp = el => {
	let frame = 0;
	const countTo = parseInt( el.innerHTML, 10 );
	const counter = setInterval( () => {
		frame++;
		const progress = easeOutQuad( frame / totalFrames );
		const currentCount = Math.round( countTo * progress );

		if ( parseInt( el.innerHTML, 10 ) !== currentCount ) {
			el.innerHTML = currentCount;
		}

		if ( frame === totalFrames ) {
			clearInterval( counter );
		}
	}, frameDuration );
};

const runAnimations = () => {
	const countupEls = document.querySelectorAll( '.countup' );
	countupEls.forEach( animateCountUp );
};


const runAnimations2 = () => {
	const countupEls = document.querySelectorAll( '.count--amount' );
	countupEls.forEach( animateCountUp );
};

runAnimations()
runAnimations2()



const animateRevenue = el => {
    let frame = 0;
    // Parse the number: Remove €, replace ',' with '', and then '.' with ''
    const countToStr = el.innerHTML.substring(1).replace(/\./g, '').replace(',', '.');
    const countTo = parseFloat(countToStr);

    const counter = setInterval(() => {
        frame++;
        const progress = easeOutQuad(frame / totalFrames);
        const currentCount = countTo * progress;

        // Format the number back with € and the German thousand and decimal separators
        const formattedCount = '€' + currentCount.toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        if (el.innerHTML !== formattedCount) {
            el.innerHTML = formattedCount;
        }

        if (frame === totalFrames) {
            clearInterval(counter);
        }
    }, frameDuration);
};



// Call this function in runAnimations or wherever you need
const runRevenueAnimation = () => {
    const revenueEl = document.getElementById('revenue--header');
    animateRevenue(revenueEl);
};
runRevenueAnimation()



const productData = [
            <?php
     
            
            $productQuantities = [];
            
            foreach ($todayproducts as $product) {
                $productName = $product['product_name'];
                
                if (!isset($productQuantities[$productName])) {
                    $productQuantities[$productName] = 1;
                } else {
                    $productQuantities[$productName]++;
                }
            }
            
            $productData = [];
            foreach ($productQuantities as $productName => $quantity) {
                $escapedProductName = addslashes($productName);
                echo "{ name: \"$escapedProductName\", quantity: $quantity },\n";
            }
            ?>
        ];
        
        console.log(productData);
        productData.sort((a, b) => b.quantity - a.quantity);

        const topN = 10;

        if (productData.length > topN) {
            const topProducts = productData.slice(0, topN);
            const remainingQuantity = productData.slice(topN).reduce((acc, product) => acc + product.quantity, 0);
            topProducts.push({ name: "Others", quantity: remainingQuantity });
            productData.length = 0;
            productData.push(...topProducts);
        }

        const products = productData.map(product => product.name);
        const quantities = productData.map(product => product.quantity);

        const ctx = document.getElementById('productChart').getContext('2d');
        const productChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: products,
                datasets: [{
                    data: quantities,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                    ],
                }],
            },
            options: {
                legend: {
                    display: true,
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Product Distribution',
                },
            },
        });




document.addEventListener("DOMContentLoaded", function() {
    const ctx = document.getElementById('myChart').getContext('2d');

    const hoursDataToday = <?php echo json_encode(array_values($hoursCountToday)); ?>;
    const hoursDataYesterday = <?php echo json_encode(array_values($hoursCountYesterday)); ?>;

    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['00', '01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23'],
            datasets: [{
                label: 'Vandaag',
                data: hoursDataToday, 
                borderColor: '#749BC2',
                fill: false,
                pointRadius: 0,
                tension: 0.4
            },
            {
                label: 'Gisteren',
                data: hoursDataYesterday,
                borderColor: '#749BC2',
                fill: false,
                borderDash: [5, 5],
                borderWidth: 6,
                tension: 0.4,
                pointRadius: 0 
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            animation: {
                duration: 1000,
                easing: 'linear',
                onComplete: function() {
                    let chartInstance = this.chart

                }
            }
        }
    });
});
</script>
