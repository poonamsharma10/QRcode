<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- Styles -->
    <style>
    html,
    body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }

    .full-height {
        height: 100vh;
    }

    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }

    .position-ref {
        position: relative;
    }

    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }

    .content {
        text-align: center;
    }

    .title {
        font-size: 84px;
    }

    .links>a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }

    .m-b-md {
        margin-bottom: 30px;
    }
    </style>
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.js"></script>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <input type="submit" class="btn btn-primary" name="Day" value="day" />
                    <input type="submit" class="btn btn-primary" name="Week" value="week" />
                    <input type="submit" class="btn btn-primary" name="Month" value="month" />
                    <input type="submit" class="btn btn-primary" name="Year" value="year" />
                  
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>

                </div>
            </div>
        </div>

        <script>
        const today = moment();
        // Today
        const nowHours = today.format('HH');
        const Hours = Array(Number(nowHours)).fill().map((e, i) => i);
        // Last Week
        const Weekdays = Array(7).fill().map((e, i) => today.subtract(i, 'days').format('dddd'))
        //  this month
        const Monthdays = Array(Number(today.endOf('month').format("DD"))).fill().map((e, i) => (i + 1)
            .toString())
        const Months = moment.months()


        $(document).ready(function() {
            let filterValue = 'day'
            const getLabels = () => {
                switch (filterValue) {
                    case 'day':
                        return Hours.map(h => h + ':00')
                        break;
                    case 'week':
                        return Weekdays
                        break;
                    case 'month':
                        return Monthdays
                        break;
                    case 'year':
                        return Months
                        break;

                    default:
                }
            }

            const displayChart = () => {
                $.get(`chart/${filterValue}`, function(response) {
                    // day Data
                    let dayData = Hours.map(h => {
                        let links = response.filter(res => new Date(res.created_at)
                            .getHours() ===
                            h);
                        return links.length;
                    })

                    // week Data
                    let weekData = Weekdays.map(day => {
                        let links = response.filter(res => moment(res.created_at).format(
                            'dddd') === day);
                        return links.length;
                    })

                    let monthData = Monthdays.map(day => {
                        let links = response.filter(res => moment(res.created_at).format(
                            'DD') === day);
                        return links.length;
                    })
                    let yearData = Months.map(month => {
                        let links = response.filter(res => moment(res.created_at).format(
                            'MMMM') === month);
                        return links.length;
                    })


                    const getData = () => {
                        switch (filterValue) {
                            case 'day':
                                return dayData
                                break;
                            case 'week':
                                return weekData
                                break;
                            case 'month':
                                return monthData
                                break;
                            case 'year':
                                return yearData
                                break;
                            default:

                        }
                    }

                    var ctx = document.getElementById("canvas").getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: getLabels(),
                            datasets: [{
                                label: "Links",
                                backgroundColor: 'rgba(255, 255, 255, 0)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: getData(),
                            }]
                        },

                        options: {
                            scales: {
                                yAxes: [{
                                    stacked: true
                                }]
                            }
                        }
                    });

                });
            }
            displayChart();
            $('.btn').click(function() {
                filterValue = $(this).val();
                displayChart();


            })
        });
        </script>



        <!-- <div class="content d-block">
            <h3>Refresh page to test QR code svg generator .</h3>
            <div class="visible-print text-center">

            </div>



        </div> -->
    </div>
</body>

</html>