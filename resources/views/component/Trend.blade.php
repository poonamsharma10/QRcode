@extends('welcome')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 ">
            <div class="panel panel-default">

                <div class="panel-body">
                    <h4 id="date1"> Date1=</h4>
                    <h4 id="date2"> Date2=</h4>
                    <hr />

                    {{ $data ?? '' }}
                    <div id="arrowContainer"></div>
                    <canvas id="canvas" height="280" width="600"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        const displayChart = () => {
            const firstDate = moment().subtract(24, 'hours').format("YYYY-MM-DD HH:mm:ss");
            const secondDate = moment().subtract(48, 'hours').format("YYYY-MM-DD HH:mm:ss");

            $.get(`compare/${firstDate}/${secondDate}`, function(response) {
                const firstLength = response.first.length
                const secondLength = response.second.length
                const arrowDirection = () => {
                    if (firstLength > secondLength) return 'UP'
                    if (firstLength < secondLength) return 'DOWN'
                    if (firstLength === secondLength) return 'RIGHT'
                }

                const day1 = document.getElementById("date1")
                const day2 = document.getElementById("date2")
                day1.innerHTML = `${firstDate} : ${firstLength} Links`;
                day2.innerHTML = `${secondDate} : ${secondLength} Links`;

                const ctx = document.getElementById("canvas").getContext('2d');
                const img = document.createElement("img");
                img.src = "images/back.png";
                img.className = arrowDirection() +' arrow';

                // ctx.drawImage(img, 10, 10);
                const src = document.getElementById("arrowContainer");
              src.appendChild(img);


            });
        }
        displayChart();

    });
    </script>


    @endsection