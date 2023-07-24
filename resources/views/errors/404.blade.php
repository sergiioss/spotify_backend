
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify Music</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,600,700');
        @import url('https://fonts.googleapis.com/css?family=Catamaran:400,800'); 
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background:black;
        }  
        h1{
            color:white;
        }
        .error-container {
            text-align: center;
            font-size: 180px;
            font-family: 'Catamaran', sans-serif;
            font-weight: 800;
            margin: 20px 15px;
        }
        .error-container > span {
            display: inline-block;
            line-height: 0.7;
            position: relative;
            color: #FFB485;
        }
        .error-container > span > span {
            display: inline-block;
            position: relative;
        }
        .error-container > span:nth-of-type(1) {
            perspective: 1000px;
            perspective-origin: 500% 50%;
            color: #F0E395;
        }
        .error-container > span:nth-of-type(1) > span {
            transform-origin: 50% 100% 0px;
            transform: rotateX(0);
            animation: easyoutelastic 8s infinite;
        }
        .error-container > span:nth-of-type(3) {
            perspective: none;
            perspective-origin: 50% 50%;
            color: #D15C95;
        }
        .error-container > span:nth-of-type(3) > span {
            transform-origin: 100% 100% 0px;
            transform: rotate(0deg);
            animation: rotatedrop 8s infinite;
        }
        @keyframes easyoutelastic {
            0% {
                transform: rotateX(0);
            }
            9% {
                transform: rotateX(210deg);
            }
            13% {
                transform: rotateX(150deg);
            }
            16% {
                transform: rotateX(200deg);
            }
            18% {
                transform: rotateX(170deg);
            }
            20% {
                transform: rotateX(180deg);
            }
            60% {
                transform: rotateX(180deg);
            }
            80% {
                transform: rotateX(0);
            }
            100% {
                transform: rotateX(0);
            }
        }

        @keyframes rotatedrop {
            0% {
                transform: rotate(0);
            }
            10% {
                transform: rotate(30deg);
            }
            15% {
                transform: rotate(90deg);
            }
            70% {
                transform: rotate(90deg);
            }
            80% {
                transform: rotate(0);
            }
            100% {
                transform: rotateX(0);
            }
        }
    </style>
</head>
<body>
    <h1>404 Error Page</h1>
    <section class="error-container">
        <span><span>4</span></span>
        <span>0</span>
        <span><span>4</span></span>
    </section>
    <section class="error-container">
        <span><span>4</span></span>
        <span>0</span>
        <span><span>4</span></span>
    </section>
</body>
</html>