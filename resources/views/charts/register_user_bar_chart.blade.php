<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bar Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
</head>

<body>
    <h1 style="text-align: center; font-weight: bold; color: red">
        Số lượng người dùng đăng ký trong 1 tháng
    </h1>

    <canvas id="chart"></canvas>

    <script>
        const ctx = document.getElementById('chart').getContext('2d');
        const userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: {!! json_encode($datasets) !!},
            },
        });
    </script>
</body>

</html>
