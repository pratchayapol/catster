<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet" />
  <link href="assets/fontawesome/css/brands.css" rel="stylesheet" />
  <link href="assets/fontawesome/css/solid.css" rel="stylesheet" />
  <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<style>
  body {
    font-family: "Lato", sans-serif;
  }

  .sidenav {
    height: 100%;
    width: 250px;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #fff;
    overflow-x: hidden;
    padding-top: 20px;
  }

  .sidenav a {
    padding: 6px 8px 6px 16px;
    text-decoration: none;
    color: #000;
    display: block;
  }

  .sidenav a:hover {
    color: #000;
  }

  .main {
    margin-left: 250px; /* Same as the width of the sidenav */
    padding: 0px 10px;
  }

  @media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
  }

  .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }

      .bd-mode-toggle {
        z-index: 1500;
      }

      .bd-mode-toggle .dropdown-menu .active .bi {
        display: block !important;
      }

      .nav-link a:hover {
        color: #ffffff;
        background-color: #F88020;
      }
</style>
</head>
<body style="background-color: #fff;">

<?php include 'include/sidenav.php'; ?>

  <div class="main">
    <header class="py-3 mb-4 border-bottom">
      <div class="container d-flex flex-wrap justify-content-center">
        <p href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto link-body-emphasis text-decoration-none">
          <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
          <span class="fs-4">Dashboard</span>
        </p>
        <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
        </form>
      </div>
    </header>

    <div class="row mb-5 ms-3">
      <div class="col-lg-3">
        <div class="card text-center">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer text-body-secondary">
            2 days ago
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card text-center">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer text-body-secondary">
            2 days ago
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card text-center">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer text-body-secondary">
            2 days ago
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card text-center">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer text-body-secondary">
            2 days ago
          </div>
        </div>
      </div>
    </div>

    <div class="row ms-3">
      <div class="col-lg-8">
        <div class="card text-center">
            <div class="card">
                <div class="card-body">
                    <canvas id="chLine"></canvas>
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="card text-center">
          <div class="card-header">
            Featured
          </div>
          <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
          <div class="card-footer text-body-secondary">
            2 days ago
          </div>
        </div>
      </div>
    </div>

    <script>
        // chart colors
        var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

        /* large line chart */
        var chLine = document.getElementById("chLine");
        var chartData = {
        labels: ["S", "M", "T", "W", "T", "F", "S"],
        datasets: [{
            data: [589, 445, 483, 503, 689, 692, 634],
            backgroundColor: '#FBE6D4',
            borderColor: '#FFA931',
            borderWidth: 4,
            pointBackgroundColor: '#FFA931'
        }
        ]
        };
        if (chLine) {
        new Chart(chLine, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
            xAxes: [{
                ticks: {
                beginAtZero: false
                }
            }]
            },
            legend: {
            display: false
            },
            responsive: true
        }
        });
        }

        /* large pie/donut chart */
        var chPie = document.getElementById("chPie");
        if (chPie) {
        new Chart(chPie, {
            type: 'pie',
            data: {
            labels: ['Desktop', 'Phone', 'Tablet', 'Unknown'],
            datasets: [
                {
                backgroundColor: [colors[1],colors[0],colors[2],colors[5]],
                borderWidth: 0,
                data: [50, 40, 15, 5]
                }
            ]
            },
            plugins: [{
            beforeDraw: function(chart) {
                var width = chart.chart.width,
                    height = chart.chart.height,
                    ctx = chart.chart.ctx;
                ctx.restore();
                var fontSize = (height / 70).toFixed(2);
                ctx.font = fontSize + "em sans-serif";
                ctx.textBaseline = "middle";
                var text = chart.config.data.datasets[0].data[0] + "%",
                    textX = Math.round((width - ctx.measureText(text).width) / 2),
                    textY = height / 2;
                ctx.fillText(text, textX, textY);
                ctx.save();
            }
            }],
            options: {layout:{padding:0}, legend:{display:false}, cutoutPercentage: 80}
        });
        }

        /* bar chart */
        var chBar = document.getElementById("chBar");
        if (chBar) {
        new Chart(chBar, {
        type: 'bar',
        data: {
            labels: ["S", "M", "T", "W", "T", "F", "S"],
            datasets: [{
            data: [589, 445, 483, 503, 689, 692, 634],
            backgroundColor: colors[0]
            },
            {
            data: [639, 465, 493, 478, 589, 632, 674],
            backgroundColor: colors[1]
            }]
        },
        options: {
            legend: {
            display: false
            },
            scales: {
            xAxes: [{
                barPercentage: 0.4,
                categoryPercentage: 0.5
            }]
            }
        }
        });
        }

        /* 3 donut charts */
        var donutOptions = {
        cutoutPercentage: 85, 
        legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
        };

        // donut 1
        var chDonutData1 = {
            labels: ['Bootstrap', 'Popper', 'Other'],
            datasets: [
            {
                backgroundColor: colors.slice(0,3),
                borderWidth: 0,
                data: [74, 11, 40]
            }
            ]
        };

        var chDonut1 = document.getElementById("chDonut1");
        if (chDonut1) {
        new Chart(chDonut1, {
            type: 'pie',
            data: chDonutData1,
            options: donutOptions
        });
        }

        // donut 2
        var chDonutData2 = {
            labels: ['Wips', 'Pops', 'Dags'],
            datasets: [
            {
                backgroundColor: colors.slice(0,3),
                borderWidth: 0,
                data: [40, 45, 30]
            }
            ]
        };
        var chDonut2 = document.getElementById("chDonut2");
        if (chDonut2) {
        new Chart(chDonut2, {
            type: 'pie',
            data: chDonutData2,
            options: donutOptions
        });
        }

        // donut 3
        var chDonutData3 = {
            labels: ['Angular', 'React', 'Other'],
            datasets: [
            {
                backgroundColor: colors.slice(0,3),
                borderWidth: 0,
                data: [21, 45, 55, 33]
            }
            ]
        };
        var chDonut3 = document.getElementById("chDonut3");
        if (chDonut3) {
        new Chart(chDonut3, {
            type: 'pie',
            data: chDonutData3,
            options: donutOptions
        });
        }

        /* 3 line charts */
        var lineOptions = {
            legend:{display:false},
            tooltips:{interest:false,bodyFontSize:11,titleFontSize:11},
            scales:{
                xAxes:[
                    {
                        ticks:{
                            display:false
                        },
                        gridLines: {
                            display:false,
                            drawBorder:false
                        }
                    }
                ],
                yAxes:[{display:false}]
            },
            layout: {
                padding: {
                    left: 6,
                    right: 6,
                    top: 4,
                    bottom: 6
                }
            }
        };

        var chLine1 = document.getElementById("chLine1");
        if (chLine1) {
        new Chart(chLine1, {
            type: 'line',
            data: {
                labels: ['Jan','Feb','Mar','Apr','May'],
                datasets: [
                    {
                    backgroundColor:'#ffffff',
                    borderColor:'#ffffff',
                    data: [10, 11, 4, 11, 4],
                    fill: false
                    }
                ]
            },
            options: lineOptions
        });
        }
        var chLine2 = document.getElementById("chLine2");
        if (chLine2) {
        new Chart(chLine2, {
            type: 'line',
            data: {
                labels: ['A','B','C','D','E'],
                datasets: [
                    {
                    backgroundColor:'#ffffff',
                    borderColor:'#ffffff',
                    data: [4, 5, 7, 13, 12],
                    fill: false
                    }
                ]
            },
            options: lineOptions
        });
        }

        var chLine3 = document.getElementById("chLine3");
        if (chLine3) {
        new Chart(chLine3, {
            type: 'line',
            data: {
                labels: ['Pos','Neg','Nue','Other','Unknown'],
                datasets: [
                    {
                    backgroundColor:'#ffffff',
                    borderColor:'#ffffff',
                    data: [13, 15, 10, 9, 14],
                    fill: false
                    }
                ]
            },
            options: lineOptions
        });
        }
    </script>
    
  </div>
   
</body>
</html> 
