@extends('welcome')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-default">
                <input type="submit" class="btn btn-primary" name="Day" value="day" />
                <input type="submit" class="btn btn-primary" name="Week" value="week" />
                <input type="submit" class="btn btn-primary" name="Month" value="month" />
                <input type="submit" class="btn btn-primary" name="Year" value="year" />
                <hr />
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
                    type: 'bar',
                    data: {
                        labels: getLabels(),
                        datasets: [{
                            label: "Links",
                            barPercentage: 0.9,
                            borderWidth:1,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.25)',
                            data: getData(),
                            
                        }]
                    },
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


    @endsection