@extends('welcome')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-default">
                <h3> Items Tags</h3>
                <hr />
                <div class="panel-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        const tags = ["PRODUCT", "TE", "CATEGORY", "PAGE", "NEW"];
        const displayChart = () => {
            $.get('/items', function(response) {
                const chartColors = {
                    red: 'rgb(255, 99, 132)',
                    orange: 'rgb(255, 159, 64)',
                    yellow: 'rgb(255, 205, 86)',
                    green: 'rgb(75, 192, 192)',
                    blue: 'rgb(54, 162, 235)',
                    purple: 'rgb(153, 102, 255)',
                    grey: 'rgb(231,233,237)'
                };
                const data = tags.map(tag => response.filter(data => data.tags.includes(tag))
                    .length)
                const ctx = document.getElementById("canvas").getContext('2d');
                const myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        datasets: [{
                            data: data,
                            backgroundColor: [
                                chartColors.red,
                                chartColors.yellow,
                                chartColors.blue,
                                chartColors.green,
                                chartColors.purple
                            ]
                        }],

                        labels: tags
                    }

                });

            });
        }
        displayChart();
    });
    </script>


    @endsection