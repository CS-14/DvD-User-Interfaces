<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cashier</title>
    <link rel="stylesheet" href="css/cashier.css">
    <link rel="stylesheet" href="css/cashier_nav.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


</head>

<body>
<section>
    <header>
        <a href="#" class="logo">Cashier</a>
        <br >
        <div class ="logedin" style="color: lightseagreen;"> Welcome <?php echo ( $_SESSION['First_name']); ?> ! </div>

        <div class="toggleMenu" onmouseover="toggleMenu();"></div>
        <ul class="navigation">

            <li><a href="Home.php">Home</a></li>
            <li><a href="service.php">Services</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="logout.php">Log-out</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="#"></a></li>

        </ul>

    </header>

    <div class="navigation2">
        <ul>
            <li>
                <a href="#">
                    <span class="icon1"><i class="#"" aria-hidden="true"></i></span>
                    <span class="title1"></span></a></li>

            <li>
                <a href="orders-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Online orders</span></a></li>

            <li>
                <a href="purchases.php">
                  <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Purchases</span></a></li>


            <li>
                <a href="lending-view.php">
                    <span class="icon1"><i class="fa fa-first-order" aria-hidden="true"></i></span>
                    <span class="title1">Lendings</span></a></li>

            <li>
                <a href="#">
                    <span class="icon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                    <span class="title1">Mails</span></a></li>



        </ul>
    </div>

    <div class="content">
        <div class="contentBx">

                <script>
                    window.onload = function () {

                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            backgroundColor: "lightblue",
                            title:{
                                text: "Daily product sales"
                            },
                            axisX: {
                                valueFormatString: "DD MMM,YY"
                            },
                            axisY: {
                                title: "Temperature (in °C)",
                                suffix: " °C"
                            },
                            legend:{
                                cursor: "pointer",
                                fontSize: 16,
                                itemclick: toggleDataSeries
                            },
                            toolTip:{
                                shared: true
                            },
                            data: [{
                                name: "Myrtle Beach",
                                type: "spline",
                                yValueFormatString: "#0.## °C",
                                showInLegend: true,
                                dataPoints: [
                                    { x: new Date(2017,6,24), y: 31 },
                                    { x: new Date(2017,6,25), y: 31 },
                                    { x: new Date(2017,6,26), y: 29 },
                                    { x: new Date(2017,6,27), y: 29 },
                                    { x: new Date(2017,6,28), y: 31 },
                                    { x: new Date(2017,6,29), y: 30 },
                                    { x: new Date(2017,6,30), y: 29 }
                                ]
                            },
                                {
                                    name: "Martha Vineyard",
                                    type: "spline",
                                    yValueFormatString: "#0.## °C",
                                    showInLegend: true,
                                    dataPoints: [
                                        { x: new Date(2017,6,24), y: 20 },
                                        { x: new Date(2017,6,25), y: 20 },
                                        { x: new Date(2017,6,26), y: 25 },
                                        { x: new Date(2017,6,27), y: 25 },
                                        { x: new Date(2017,6,28), y: 25 },
                                        { x: new Date(2017,6,29), y: 25 },
                                        { x: new Date(2017,6,30), y: 25 }
                                    ]
                                },
                                {
                                    name: "Nantucket",
                                    type: "spline",
                                    yValueFormatString: "#0.## °C",
                                    showInLegend: true,
                                    dataPoints: [
                                        { x: new Date(2017,6,24), y: 22 },
                                        { x: new Date(2017,6,25), y: 19 },
                                        { x: new Date(2017,6,26), y: 23 },
                                        { x: new Date(2017,6,27), y: 24 },
                                        { x: new Date(2017,6,28), y: 24 },
                                        { x: new Date(2017,6,29), y: 23 },
                                        { x: new Date(2017,6,30), y: 23 }
                                    ]
                                }]
                        });
                        chart.render();

                        function toggleDataSeries(e){
                            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            }
                            else{
                                e.dataSeries.visible = true;
                            }
                            chart.render();
                        }

                    }
                </script>

            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        </div>
        <div class="contentBx">

        </div>
    </div>





    <ul class="sci">
        <li><a href="#"><img src="image/facebook.png"></a></li>
        <li><a href="#"><img src="image/instagram.png"></a></li>
        <li><a href="#"><img src="image/twitter.png"></a></li>
    </ul>
</section>
<script type="text/javascript">
    function toggleMenu()
    {
        const toggleMenu = document.querySelector('.toggleMenu');
        const navigation = document.querySelector('.navigation');
        toggleMenu.classList.toggle('active');
        navigation.classList.toggle('active');
    }
</script>


</body>
</html>