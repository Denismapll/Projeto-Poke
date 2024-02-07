<!DOCTYPE html>
<html lang="en">

<?php
include 'connect.php';
$pokemonDia = "";
$query = "SELECT * FROM `admin`";

$result = mysqli_query($mysqli, $query);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row);
        // echo '<br>';
        // echo intval(date('dmY'));
        // echo '<br>';

        if ($row['data'] == intval(date('dmY'))) {
            // echo 'pokemon do dia é : ' . $row['pokemon'];
            $pokemonDia = $row['pokemon'];
            $data = $row['data'];
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/main.css">
</head>
<header>

</header>

<body style="background: #232323;">


    <section class="header-img">
        <div class="container">
            <div class="row justify-content-center align-items-center flex-column">
                <!-- <h1 style="text-align: center; color: white;">PokeDay</h1> -->
                <img src="./assets/img/pokeday.png" alt="" style="width: 150px; margin: 15px auto;">
                <input type="text" class="enviar" placeholder="Escreva aqui...">
                <div class="container flex" style="height: fit-content; display: flex; justify-content: center; align-items: center; position: relative;">
                    <div class="d-flex flex-column box-dicas" style="background: white; width: 300px; border-radius: 20px; position: absolute; top: 1px; z-index: 9999;">
                        <div class="d-flex justify-content-center align-items-center search">
                            <!-- <img class="col-md-2 show-pic" src="" alt="" id="fotoAprox"> -->
                            <h4 class="col-md-7 no-show" style="font-size: 17px" id="nomeAprox"></h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center search">
                            <!-- <img class="col-md-2 show-pic" src="" alt="" id="fotoAprox"> -->
                            <h4 class="col-md-7 no-show" style="font-size: 17px" id="nomeAprox"></h4>
                        </div>
                        <div class="d-flex justify-content-center align-items-center search">
                            <!-- <img class="col-md-2 show-pic" src="" alt="" id="fotoAprox"> -->
                            <h4 class="col-md-7 no-show" style="font-size: 17px" id="nomeAprox"></h4>
                        </div>
                    </div>
                </div>
                <!-- <button onclick="reset()" style="width: 75px; border-radius: 30px;">Reset</button> -->
                <!-- <img src="" alt="" class="img w-25"> -->
            </div>
        </div>
    </section>

    <section>
        <div class="container d-flex justify-content-start principal flex-column align-items-center hid-scroll">
            <div class="row col-md-8 col-xs-6 box-content">
            </div>
        </div>
    </section>


    <script src="./assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>