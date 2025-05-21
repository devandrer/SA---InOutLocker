<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .switchCustom {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switchCustom-input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .sliderCustom {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .sliderCustom:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .switchCustom-input:checked+.sliderCustom {
            background-color: #2196F3;
        }

        .switchCustom-input:focus+.sliderCustom {
            box-shadow: 0 0 1px #2196F3;
        }

        .switchCustom-input:checked+.sliderCustom:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Formato arredondado do sliderCustom */
        .sliderCustom.redondo {
            border-radius: 34px;
        }

        .sliderCustom.redondo:before {
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <label class="switchCustom">
        <input class="switchCustom-input" type="checkbox">
        <span class="sliderCustom redondo"></span>
    </label>
</body>

</html>