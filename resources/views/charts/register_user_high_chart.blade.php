<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bar Chart</title>
</head>

<body>
    <h1 style="text-align: center; font-weight: bold; color: red">
        Số lượng người dùng đăng ký trong 1 tháng
    </h1>

    <div id="container"></div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        const labels = {!! json_encode($labels) !!};
        const data = {!! json_encode($data) !!};
        const title = "Số lượng người dùng đăng ký trong 1 tháng";

        Highcharts.chart('container', {
            title: {
                text: title
            },
            xAxis: {
                categories: labels
            },
            yAxis: {
                title: {
                    text: 'Số lượng người dùng mới'
                }
            },
            series: [{
                name: 'Người dùng mới',
                data: data
            }],
        });
    </script>
</body>

</html>
