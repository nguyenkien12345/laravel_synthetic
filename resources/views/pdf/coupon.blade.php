<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'poppins', sans-serif;
    }

    .container {
        width: 100%;
        height: 100vh;
        background: #f0fff3;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    .coupon-card {
        background: rgb(219, 219, 154);
        opacity: 0.8;
        color: #fff;
        text-align: center;
        padding: 40px 80px;
        border-radius: 15px;
        box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
        position: relative;
    }

    .logo {
        width: 80px;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .coupon-card h3 {
        font-size: 28px;
        font-weight: 700;
        line-height: 40px;
    }

    .coupon-card p {
        font-size: 15px;
    }

    .coupon-row {
        display: flex;
        align-items: center;
        margin: 25px auto;
        width: fit-content;
    }

    #cpnCode {
        border: 1px dashed #fff;
        padding: 10px 20px;
        border-right: 0;
        font-weight: 700;
    }

    #cpnBtn {
        border: 1px solid #fff;
        background: #fff;
        padding: 10px 20px;
        color: #7158fe;
        cursor: pointer;
    }

    .circle1,
    .circle2 {
        background: #f0fff3;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .circle1 {
        left: -25px;
    }

    .circle2 {
        right: -25px;
    }

    .page-break {
        page-break-after: always;
    }
</style>

<body>
    <div class="container">
        <div class="coupon-card">
            {{-- <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="logo"> --}}
            <img src="{{ $image }}" class="logo">
            <h3>{{ $content }}</h3>

            <div class="coupon-row">
                <span id="cpnCode">{{ $code }}</span>
                <span id="cpnBtn">Copy Code</span>
            </div>

            <p>Valid Till: {{ $date }}</p>

            <div class="circle1"></div>
            <div class="circle2"></div>
        </div>
    </div>
</body>

</html>
