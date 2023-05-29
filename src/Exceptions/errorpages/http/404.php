<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo config('app.name') ?></title>
    <style>
        body {
            background: #000124;
            text-align: center;
        }

        h1 {
            font-size: 65px;
            color: #fff;
            display: flex;
            text-align: center;
            justify-content: center;
        }

        p {
            font-size: 20px;
            font-weight: 600;
            color: lightgrey;
        }

        #root {
            margin-top: 10%;
        }
    </style>
</head>

<body>
<div id="root">
    <h1>
        404
    </h1>

    <p>
        <?=
        $error
        ?>
    </p>
</div>

</body>

</html>