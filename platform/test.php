<html>


<head>
    <style>
        svg {
            border: 3px solid #eee;
            display: block;
            margin: 1em auto;
        }
        p {
            color: #aaa;
            text-align: center;
            margin: 2em 0;
        }
        #circle{
            width:50px;
            height: 50px;
        }
    </style>
</head>
<body>

<svg width="500" height="350" viewBox="0 0 500 350">
    <path id="motionPath" fill="none" stroke="#000000" stroke-miterlimit="" d="M202.4,58.3c-13.8,0.1-33.3,0.4-44.8,9.2
    c-14,10.7-26.2,29.2-31.9,45.6c-7.8,22.2-13.5,48-3.5,70.2c12.8,28.2,47.1,43.6,68.8,63.6c19.6,18.1,43.4,26.1,69.5,29.4
    c21.7,2.7,43.6,3.3,65.4,4.7c19.4,1.3,33.9-7.7,51.2-15.3c24.4-10.7,38.2-44,40.9-68.9c1.8-16.7,3.4-34.9-10.3-46.5
    c-9.5-8-22.6-8.1-33.2-14.1c-13.7-7.7-27.4-17.2-39.7-26.8c-5.4-4.2-10.4-8.8-15.8-12.9c-4.5-3.5-8.1-8.3-13.2-11
    c-6.2-3.3-14.3-5.4-20.9-8.2c-5-2.1-9.5-5.2-14.3-7.6c-6.5-3.3-12.1-7.4-19.3-8.9c-6-1.2-12.4-1.3-18.6-1.5
    C222.5,59,212.5,57.8,202.4,58.3"/>
        <image id="circle" xlink:href="images/background.png" x="0" y="0" height="50px" width="50px"/>
    <animateMotion
        xlink:href="#circle"
        dur="5s"
        begin="0s"
        fill="freeze"
        repeatCount="indefinite">
        <mpath xlink:href="#motionPath" />
    </animateMotion>
</svg>

</body>
</html>