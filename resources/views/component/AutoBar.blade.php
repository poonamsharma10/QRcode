@extends('welcome')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-default">
                <h4> Links Auto Update View</h4>
                <hr />
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>

    const timeNow = moment().startOf("minute");
    const time =Array(12).fill().map((time,i)=>moment().startOf("minute").minute(Math.floor(timeNow.minute() / 5) * 5).subtract(5*i, "minutes").format("YYYY-MM-DD HH:mm")).reverse();

    $(document).ready(function() {
        const displayChart = () => {
            $.get(`chart/hour`, function(response) {
                const getData=()=>{
                    return time.map(t=> {
                            let links = response.filter(res => {
                                return moment(res.created_at).isBetween(t, moment(t).add(5, "minutes").format("YYYY-MM-DD HH:mm"))
                            }
                        );
                    return links.length;
                })
                }
                const ctx = document.getElementById("canvas").getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: time.map(t=>moment(t).format("HH:mm")),
                        datasets: [{
                            label: "Links",
                            barPercentage: 0.9,
                            borderWidth: 1,
                            borderColor: 'rgb(255, 99, 132)',
                            backgroundColor: 'rgba(255, 99, 132, 0.25)',
                            data: getData(),

                        }]
                    },
                });
                setTimeout(displayChart, 30000);
            });
        }
        displayChart();
    });
    </script>


    @endsection