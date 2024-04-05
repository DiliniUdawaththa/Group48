<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=ucfirst(App::$page)?> - <?=APPNAME?></title>
    <script src="https://kit.fontawesome.com/cbd2a66f05.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/Officer/Dashboard.css">
    <style>
    .error {
        border: 1px solid red;
        color: red;
    }

    .message {
        height: 50px;
        width: 100%;
        margin-bottom: 10px;
    }

    .message p {
        padding: 10px;
        font-size: 1em;
        color: #026334;
        background-color: #a7cfbc;
    }

    .con-button {
        width: 80%;
        background-color: #000000;
        color: white;
        border: none;
        border-radius: 10px;
        height: 50px;
        font-size: 20px;
        margin: auto;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .none-dec {
        text-decoration: none;
    }


    .box1 {
        width: 80%;
        margin: auto;
        text-align: center;
        position: relative;
        top: 50px;
    }
    </style>
</head>

<body>
    <div class="main">
        <div class="sidebar">
            <div class="logo">
                <img src="<?= ROOT ?>/assets/img/logoname.png" class="barimage">
                <br>
            </div>
            <div class="profile">
                <img src="<?= ROOT ?>/assets//img/person.jpg" alt="" class="userimage">
                <br>
                <H3 class="username"><?=Auth::getname();?></H3>
            </div>
            <div class="items">
                <a href="<?=ROOT?>/officer" class="link">
                    <div class="linkbutton1"><i class="fa-solid fa-gauge"></i>Dashboard</div>
                </a>
                <a href="<?=ROOT?>/officer/officerdriverRegistration" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-id-card"></i>Driver Registration</div>
                </a>
                <a href="<?=ROOT?>/officer/driver" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-users"></i>Drivers</div>
                </a>
                <a href="<?=ROOT?>/officer/complains" class="link">
                    <div class="linkbutton"><i class="fa-sharp fa-solid fa-circle-exclamation"></i>Complains</div>
                </a>
                <a href="<?=ROOT?>/officer/standardFare" class="link">
                    <div class="linkbutton"><i class="fa-solid fa-tag"></i>Standard Fare</div>
                </a>
                <a href="#" class="link">
                    <div class="linkbutton2"><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Logout</div>
                </a>
            </div>

            <div class="logout-container">
                <h2>Log Out</h2>
                <p class="logout-text">Are you sure you want to log out?</p>
                <div class="cancel-logout"><button class="cancel-btn">Cancel</button> <button class="logout-btn">Log
                        Out</button></div>
            </div>


        </div>

        <div class="interface">
            <div class="navi">
                <div class="navi1">
                    <h2>Officer Dashboard</h2>
                </div>
            </div>



            <!-- <div class="operation">
                <i class="fa-solid fa-bell"></i>
            </div>
        </div>

        <div class="values">
            <div class="val-box">
                <i class="fa-solid fa-users"></i>
                <div>
                    <span>Customers</span>
                    <h3>1000</h3>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-user-group"></i>
                <div>
                    <span>Drivers</span>
                    <h3>100</h3>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-user-tie"></i>
                <div>
                    <span>Officers</span>
                    <h3>4</h3>
                </div>
            </div>
            <div class="val-box">
                <i class="fa-solid fa-taxi"></i>
                <div>
                    <span>Rides</span>
                    <h3>400</h3>
                </div>
            </div>
        </div>-->


            <!--div class="chart-container">
            <div class="chart-box">
                <div id="chart1" class="chart"></div>
                <div class="chart-label">

                </div>
            </div>
            <div class="chart-box">
                <div id="chart2" class="chart"></div>
                <div class="chart-label">

                </div>
            </div>
            <div class="chart-box">
                <div id="chart3" class="chart"></div>
                <div class="chart-label">

                </div>
            </div>
        </div>-->

            <div class="main-div">
                <div class="box1">
                    <a class="none-dec" href="<?=ROOT?>/officer/driver">
                        <div class="con-button">Drivers</div>
                    </a>
                    <br /><br /><br>
                    <a class="none-dec" href="<?=ROOT?>/officer/officerdriverRegistration">
                        <div class="con-button">Driver Registration</div>
                    </a>
                    <br /><br /><br>
                    <a class="none-dec" href="<?=ROOT?>/officer/complains">
                        <div class="con-button">Complaints</div>
                    </a>
                    <br /><br /><br>
                    <a class="none-dec" href="<?=ROOT?>/officer/standardFare">
                        <div class="con-button">Standard Fare</div>
                    </a>
                </div>
            </div>





        </div>
    </div>


    <script>
    const logout_option = document.querySelector('.linkbutton2')
    const logout_container = document.querySelector('.logout-container')
    const cancel_button = document.querySelector('.cancel-btn')
    const logout_button = document.querySelector('.logout-btn')
    logout_option.addEventListener('click', () => {
        logout_container.style.display = 'block'
    })

    cancel_button.addEventListener('click', () => {
        logout_container.style.display = 'none'
    })

    logout_button.addEventListener('click', () => {
        window.location.href = "<?=ROOT?>/logout";
    })

    /* var options1 = {
         series: [67],
         chart: {
             height: 250,
             // width: '25%',
             type: 'radialBar',
             offsetY: -10
         },
         plotOptions: {
             radialBar: {
                 startAngle: -135,
                 endAngle: 135,
                 dataLabels: {
                     name: {
                         fontSize: '16px',
                         color: undefined,
                         offsetY: 120
                     },
                     value: {
                         offsetY: 76,
                         fontSize: '22px',
                         color: undefined,
                         formatter: function(val) {
                             return val + "%";
                         }
                     }
                 }
             }
         },
         fill: {
             type: 'gradient',
             gradient: {
                 shade: 'dark',
                 shadeIntensity: 0.15,
                 inverseColors: false,
                 opacityFrom: 1,
                 opacityTo: 1,
                 stops: [0, 50, 65, 91]
             },
         },
         stroke: {
             dashArray: 4
         },
         labels: ['Median Ratio'],
     };*/

    var options1 = {
        series: [67],
        chart: {
            height: 250,
            type: 'radialBar',
            offsetY: -10,
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                track: {
                    background: '#e7e7e7',
                    strokeWidth: '97%',
                    startAngle: -135,
                    endAngle: 135,
                    margin: 5,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Median Ratio'],
    };

    var options2 = {
        series: [87],
        chart: {
            height: 250,
            type: 'radialBar',
            offsetY: -10,
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                track: {
                    background: '#e7e7e7',
                    strokeWidth: '97%',
                    startAngle: -135,
                    endAngle: 135,
                    margin: 5,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Median Ratio2'],
    };

    var options3 = {
        series: [17],
        chart: {
            height: 250,
            type: 'radialBar',
            offsetY: -10,
            toolbar: {
                show: false
            },
        },
        plotOptions: {
            radialBar: {
                startAngle: -135,
                endAngle: 135,
                track: {
                    background: '#e7e7e7',
                    strokeWidth: '97%',
                    startAngle: -135,
                    endAngle: 135,
                    margin: 5,
                    dropShadow: {
                        enabled: true,
                        top: 2,
                        left: 0,
                        blur: 4,
                        opacity: 0.24
                    }
                },
                dataLabels: {
                    name: {
                        show: false
                    },
                    value: {
                        offsetY: -2,
                        fontSize: '22px',
                        color: undefined,
                        formatter: function(val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                shadeIntensity: 0.15,
                inverseColors: false,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 50, 65, 91]
            },
        },
        stroke: {
            dashArray: 4
        },
        labels: ['Median Ratio3'],
    };


    /* var options2 = {
         series: [80],
         chart: {
             height: 250,
             //width: '25%',
             type: 'radialBar',
             offsetY: -10
         },
         plotOptions: {
             radialBar: {
                 startAngle: -135,
                 endAngle: 135,
                 dataLabels: {
                     name: {
                         fontSize: '16px',
                         color: undefined,
                         offsetY: 120
                     },
                     value: {
                         offsetY: 76,
                         fontSize: '22px',
                         color: undefined,
                         formatter: function(val) {
                             return val;
                         }
                     }
                 }
             }
         },
         fill: {
             type: 'gradient',
             gradient: {
                 shade: 'dark',
                 shadeIntensity: 0.15,
                 inverseColors: false,
                 opacityFrom: 1,
                 opacityTo: 1,
                 stops: [0, 50, 65, 91]
             },
         },
         stroke: {
             dashArray: 4
         },
         labels: ['Median Ratio'],
     };


     var options3 = {
         series: [10],
         chart: {
             height: 250,
             //width: '25%',
             type: 'radialBar',
             offsetY: -10
         },
         plotOptions: {
             radialBar: {
                 startAngle: -135,
                 endAngle: 135,
                 dataLabels: {
                     name: {
                         fontSize: '16px',
                         color: undefined,
                         offsetY: 120
                     },
                     value: {
                         offsetY: 76,
                         fontSize: '22px',
                         color: undefined,
                         formatter: function(val) {
                             return val;
                         }
                     }
                 }
             }
         },
         fill: {
             type: 'gradient',
             gradient: {
                 shade: 'dark',
                 shadeIntensity: 0.15,
                 inverseColors: false,
                 opacityFrom: 1,
                 opacityTo: 1,
                 stops: [0, 50, 65, 91]
             },
         },
         stroke: {
             dashArray: 4
         },
         labels: ['Median Ratio'],
     };*/


    var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
    chart1.render();

    var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
    chart2.render();

    var chart3 = new ApexCharts(document.querySelector("#chart1"), options3);
    chart3.render();
    </script>

</body>

</html>