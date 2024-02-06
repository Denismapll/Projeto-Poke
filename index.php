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
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokeday</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background: #232323;">

    <style>
        .bgwhite {
            background-color: white;
            border-radius: 25px;
            min-height: 115px;
            /* padding: 10px; */
            text-align: center;
            min-width: 350px;
            box-shadow: 0px 0px 12px 1px #9f9f9f;
            margin: 10px auto;
        }

        .bgwhite p {
            font-size: 18px;
        }

        .bgwhite p:first-letter {
            text-transform: capitalize;
        }

        h4:first-letter {
            text-transform: capitalize;
        }

        .img,
        .img-storage {
            width: 90%;
        }

        .enviar {
            border-radius: 30px;
            text-align: center;
            height: 55px;
            font-size: 25px;
        }

        .nome,
        .nome-storage {
            font-size: 25px !important;
            font-weight: 600;
        }

        .bg-style {
            background: #ff5d5d;
            border-radius: 100%;
            width: 72px;
            height: 72px;
            margin: 0 3px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            position: relative;
            box-shadow: 1px 1px 4px 0px black;
        }

        h5 {
            font-size: 16px;
            margin: 0;
        }

        p {
            margin: 0;
        }

        .show {
            display: block;
            text-align: center;
        }

        .show-pic {
            display: block;
            /* margin: 0 20px 15px; */
        }

        .no-show {
            display: none;
        }

        .seta {
            color: black;
            position: absolute;
            width: 25px;
            height: 25px;
            background: white;
            border-radius: 100%;
            bottom: 3px;
            right: -3px;
            box-shadow: 1px 2px 4px 0px black;
        }

        .header-img {
            background-color: #232323;
            padding: 30px 0 50px;
        }

        .hid-scroll {
            height: 55vh;
            overflow-y: auto
        }

        .box-content {
            flex-direction: column-reverse;
        }

        * {
            scroll-behavior: smooth;
        }

        /* Hide scrollbar for Chrome, Safari and Opera */
        .hid-scroll::-webkit-scrollbar {
            display: none;
            overflow-y: auto;
        }

        /* Hide scrollbar for IE, Edge and Firefox */
        .hid-scroll {
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }
    </style>

    <section class="header-img">
        <div class="container">
            <div class="row justify-content-center align-items-center flex-column">
                <!-- <h1 style="text-align: center; color: white;">PokeDay</h1> -->
                <img src="./img/pokeday.png" alt="" style="width: 150px; margin: 15px auto;">
                <input type="text" class="enviar w-25" placeholder="Escreva aqui...">
                <div class="container flex"
                    style="height: fit-content; display: flex; justify-content: center; align-items: center; position: relative;">
                    <div class="d-flex flex-column"
                        style="background: white; width: 300px; border-radius: 20px; position: absolute; bottom: -86px;">
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
                <button onclick="reset()" style="width: 75px; border-radius: 30px;">Reset</button>
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


    <script>
        const enviar = document.querySelector(".enviar")
        const imagem = document.querySelector(".img")
        const principal = document.querySelector(".principal")
        const fotoNomesProximos = document.querySelectorAll("#fotoAprox")
        const nomesProximos = document.querySelectorAll("#nomeAprox")
        const mostrar = document.querySelectorAll('p')
        const bg = document.querySelector("body > section:nth-child(3) > div > div > div");
        const mainContent = document.querySelector("body > section:nth-child(3) > div > div.row.col-md-8.col-xs-6");
        const procurado = document.querySelectorAll('.search');
        var arImg = []
        var arInfo = []
        var nomesPokemons = []
        result = nomesPokemons.filter((nomesPokemons) => nomesPokemons.includes("pidg"))
        pokemonDia = ['salazzle', 'poison', 'fire', 12, 22.2, 'VII', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/home/758.png']

        window.onload = () => {
            if (!localStorage.tentativa) {
                localStorage.tentativa = 0
            }
            tentativas = localStorage.tentativa
            showStorage();
            // console.log(tentativas)
            conf = document.querySelectorAll('.col-md-2.bg-style')
            conferir(pokemonDia)
        }

        function reset() {
            localStorage.clear()

            limp = document.querySelectorAll('.bgwhite')

            limp.forEach((x) => {
                x.remove()
            })
        }

        var romanos = new Object();
        romanos.I = 1
        romanos.II = 2
        romanos.III = 3
        romanos.IV = 4
        romanos.V = 5
        romanos.VI = 6
        romanos.VII = 7
        romanos.VIII = 8
        romanos.IX = 9

        enviar.addEventListener('keypress', async function pressEnter(x) {
            if (x.key === 'Enter') {
                await buscarTipo(enviar.value);

                arInfo = [];
                enviar.value = ""
                if (enviar.value.length == 0) {
                    nomesProximos.forEach((x, y) => {
                        x.innerHTML = ""
                        x.classList.add('no-show')
                        x.classList.remove('show')
                    })
                }

                console.log(arInfo)
            }
        })

        enviar.addEventListener('input', () => {
            if (enviar.value != "") {

                result = nomesPokemons.filter((nomesPokemons) => nomesPokemons.includes(enviar.value))
                nomesProximos.forEach((x, y) => {
                    if (result[y]) {
                        x.innerHTML = result[y]
                        x.classList.remove('no-show')
                        x.classList.add('show')
                    } else {
                        x.innerHTML = "";
                    }
                })
                // fotoNomesProximos.forEach((x, y) => {
                //     x.innerHTML = result[y]
                // })
                // console.log(result)
                // showNamesProximity(enviar.value);
            }
            if (enviar.value.length == 0 || !result[0]) {
                nomesProximos.forEach((x, y) => {
                    x.innerHTML = ""
                    x.classList.add('no-show')
                    x.classList.remove('show')
                })
            }
        })


        showNamesProximity(enviar.value)

        function buscarTipo(pesq) {
            dat = pesq.toLowerCase();
            fetch('https://pokeapi.co/api/v2/pokemon/' + dat).then((response) => response.json()).then((data) => {
                // console.log(data);
                infos = data;

                arInfo.push(infos.name)
                arInfo.push(infos.types[0].type.name)
                if (infos.types.length == 2) {
                    arInfo.push(infos.types[1].type.name)
                } else {
                    arInfo.push(infos.types[0].type.name)
                }
                arInfo.push(infos.height)
                arInfo.push(infos.weight / 10)


                // console.log(infos.name);
                // console.log(infos.height);
                // console.log(infos.weight / 10);
                // infos.types.forEach((x) => { console.log(x.type.name) })

                // imagem.src = infos.sprites.other.home.front_default;
                // imagem.src = infos.sprites.front_default;


            }).then((data) => {
                fetch('https://pokeapi.co/api/v2/pokemon-species/' + dat).then((response) => response.json()).then((data) => {
                    // console.log(data);
                    infos2 = data;

                    // console.log(infos2.generation.name);
                    arInfo.push(infos2.generation.name.slice(11).toUpperCase());
                    // infos2.types.forEach((x)=>{console.log(x.type.name)})
                    // imagem.src = infos2.sprites.other.home.front_default;
                    // imagem.src = infos2.sprites.front_default;
                    arInfo.push(infos.sprites.other.home.front_default);

                    setTimeout(() => {
                        mostrar.forEach((x, y) => {
                            x.innerHTML = arInfo[y];
                        })


                    }, 50)

                }).then((data) => {
                    let box = novoBg(arInfo)
                    mainContent.appendChild(box)
                    y = parseInt(localStorage.tentativa)
                    y += 1
                    localStorage.tentativa = y
                    tentativas = localStorage.tentativa
                    toStorage(1);
                    // console.log("fim")
                    conferir(pokemonDia)

                    console.log("fim")
                }).then((data) => {
                    document.querySelector('.hid-scroll').scroll(0, 0)
                })
            })

        }

        function pokeday(pesq) {
            dat = pesq.toLowerCase();
            fetch('https://pokeapi.co/api/v2/pokemon/' + dat).then((response) => response.json()).then((data) => {
                // console.log(data);
                infos = data;

                pokemonDia.push(infos.name)
                pokemonDia.push(infos.types[0].type.name)
                if (infos.types.length == 2) {
                    pokemonDia.push(infos.types[1].type.name)
                } else {
                    pokemonDia.push(infos.types[0].type.name)
                }
                pokemonDia.push(infos.height)
                pokemonDia.push(infos.weight / 10)


                // console.log(infos.name);
                // console.log(infos.height);
                // console.log(infos.weight / 10);
                // infos.types.forEach((x) => { console.log(x.type.name) })

                // imagem.src = infos.sprites.other.home.front_default;
                // imagem.src = infos.sprites.front_default;


            }).then((data) => {
                fetch('https://pokeapi.co/api/v2/pokemon-species/' + dat).then((response) => response.json()).then((data) => {
                    // console.log(data);
                    infos2 = data;

                    // console.log(infos2.generation.name);
                    pokemonDia.push(infos2.generation.name.slice(11).toUpperCase());
                    // infos2.types.forEach((x)=>{console.log(x.type.name)})
                    // imagem.src = infos2.sprites.other.home.front_default;
                    // imagem.src = infos2.sprites.front_default;
                    pokemonDia.push(infos.sprites.other.home.front_default);

                    setTimeout(() => {
                        mostrar.forEach((x, y) => {
                            x.innerHTML = pokemonDia[y];
                        })


                    }, 50)

                }).then((data) => {
                    let box = novoBg(pokemonDia)
                    mainContent.appendChild(box)
                    y = parseInt(localStorage.tentativa)
                    y += 1
                    localStorage.tentativa = y
                    tentativas = localStorage.tentativa
                    toStorage(1);
                    // console.log("fim")
                    conferir(pokemonDia)

                    console.log("fim")
                }).then((data) => {
                    document.querySelector('.hid-scroll').scroll(0, 0)
                })
            })

        }

        // pokeday('<?php echo $pokemonDia;?>')

        function novoBg(inform) {


            divbgwhite = document.createElement("div")
            divbgwhite.classList.add('bgwhite')
            divbgwhite.classList.add('row')

            divintern1 = document.createElement("div")
            divintern1.classList.add('col-md-5')
            divintern1.classList.add('col-sm-5')
            divintern1.classList.add('row')
            divintern1.classList.add('align-items-center')

            divintern1c1 = document.createElement("div")
            divintern1c1.classList.add('col-md-5')
            divintern1c1.classList.add('col-sm-12')

            divintern1c2 = document.createElement("div")
            divintern1c2.classList.add('col-md-7')
            divintern1c2.classList.add('col-sm-12')

            divintern2 = document.createElement("div")
            divintern2.classList.add('col-md-7')
            divintern2.classList.add('row')
            divintern2.classList.add('align-items-center')
            divintern2.classList.add('justify-content-end')
            divintern2.classList.add('flex')


            box2RightSide = document.createElement("div")
            box2RightSide.classList.add('col-md-2')
            box2RightSide.classList.add('bg-style')
            h5Inside = document.createElement("h5")
            h5Inside.innerHTML = "Tipo 1"
            box2RightSide.appendChild(h5Inside)
            h5Inside = document.createElement("p")
            h5Inside.innerHTML = inform[1]
            h5Inside.classList.add("tipo1-storage")
            box2RightSide.appendChild(h5Inside)
            divintern2.appendChild(box2RightSide)

            box2RightSide = document.createElement("div")
            box2RightSide.classList.add('col-md-2')
            box2RightSide.classList.add('bg-style')
            h5Inside = document.createElement("h5")
            h5Inside.innerHTML = "Tipo 2"
            box2RightSide.appendChild(h5Inside)
            h5Inside = document.createElement("p")
            h5Inside.innerHTML = inform[2]
            h5Inside.classList.add("tipo2")
            box2RightSide.appendChild(h5Inside)
            divintern2.appendChild(box2RightSide)

            box2RightSide = document.createElement("div")
            box2RightSide.classList.add('col-md-2')
            box2RightSide.classList.add('bg-style')
            h5Inside = document.createElement("h5")
            h5Inside.innerHTML = "Altura"
            box2RightSide.appendChild(h5Inside)
            h5Inside = document.createElement("p")
            if (parseFloat(inform[3]) < pokemonDia[3]) {
                altura = inform[3] + ' <b class="seta">&#129045;</b>'
                h5Inside.innerHTML = altura
            }
            if (parseFloat(inform[3]) > pokemonDia[3]) {
                altura = inform[3] + ' <b class="seta">&#129047;</b>'
                h5Inside.innerHTML = altura
            }
            if (parseFloat(inform[3]) == pokemonDia[3]) {
                h5Inside.innerHTML = inform[3]
            }
            h5Inside.classList.add("altura")
            box2RightSide.appendChild(h5Inside)
            divintern2.appendChild(box2RightSide)

            box2RightSide = document.createElement("div")
            box2RightSide.classList.add('col-md-2')
            box2RightSide.classList.add('bg-style')
            h5Inside = document.createElement("h5")
            h5Inside.innerHTML = "Peso"
            box2RightSide.appendChild(h5Inside)
            h5Inside = document.createElement("p")
            if (parseFloat(inform[4]) < pokemonDia[4]) {
                peso = inform[4] + ' <b class="seta">&#129045;</b>'
                h5Inside.innerHTML = peso
            }
            if (parseFloat(inform[4]) > pokemonDia[4]) {
                peso = inform[4] + ' <b class="seta">&#129047;</b>'
                h5Inside.innerHTML = peso
            }
            if (parseFloat(inform[4]) == pokemonDia[4]) {
                h5Inside.innerHTML = inform[4]
            }
            h5Inside.classList.add("peso")
            box2RightSide.appendChild(h5Inside)
            divintern2.appendChild(box2RightSide)

            box2RightSide = document.createElement("div")
            box2RightSide.classList.add('col-md-2')
            box2RightSide.classList.add('bg-style')
            h5Inside = document.createElement("h5")
            h5Inside.innerHTML = "Geração"
            box2RightSide.appendChild(h5Inside)
            h5Inside = document.createElement("p")
            if (romanos[inform[5]] < romanos[pokemonDia[5]]) {
                geracao = inform[5] + ' <b class="seta">&#129045;</b>'
                h5Inside.innerHTML = geracao
            }
            if (romanos[inform[5]] > romanos[pokemonDia[5]]) {
                geracao = inform[5] + ' <b class="seta">&#129047;</b>'
                h5Inside.innerHTML = geracao
            }
            if (romanos[inform[5]] == romanos[pokemonDia[5]]) {
                h5Inside.innerHTML = inform[5]
            }
            h5Inside.classList.add("geracao")
            box2RightSide.appendChild(h5Inside)
            divintern2.appendChild(box2RightSide)

            nomePoke = document.createElement("p")
            nomePoke.classList.add("nome-storage")
            nomePoke.innerHTML = inform[0]

            imgPoke = document.createElement("img")
            imgPoke.classList.add("img-storage")
            imgPoke.src = inform[6]

            divintern1c1.appendChild(imgPoke)
            divintern1c2.appendChild(nomePoke)
            divintern1.appendChild(divintern1c1)
            divintern1.appendChild(divintern1c2)
            divbgwhite.appendChild(divintern1)
            divbgwhite.appendChild(divintern2)

            // document.querySelector("body > section:nth-child(3) > div > div").appendChild(divbgwhite)
            return divbgwhite;

        }


        function toStorage(info) {
            tent = 'try-' + tentativas
            console.log(tent)
            localStorage.setItem(tent, JSON.stringify(arInfo))
        }

        function showStorage() {
            a = localStorage;
            for (i = 0; i < a.length; i++) {
                if (i == 0) {
                    // console.log('faço nada')
                } else {
                    proc = 'try-' + i
                    information = JSON.parse(localStorage.getItem(proc))
                    let box = novoBg(information)
                    mainContent.appendChild(box)
                }
            }
        }

        function showNamesProximity(pesq) {
            dat = pesq.toLowerCase();
            fetch('https://pokeapi.co/api/v2/pokemon/?limit=-1&offset=0').then((response) => response.json()).then((data) => {
                // console.log(data.results);
                infoNames = data;

                infoNames.results.forEach((x) => {
                    nomesPokemons.push(x.name)

                })
            })

        }

        function conferir(dodia) {
            conf = document.querySelectorAll('.col-md-2.bg-style')
            // Conferir tipo 1
            for (i = 0; i < conf.length; i += 5) {
                p = i + 1;
                alt = i + 2;
                pes = i + 3;
                gen = i + 4;
                tipo1 = conf[i].children[1].innerHTML;
                tipo2 = conf[p].children[1].innerHTML;
                altura = parseFloat(conf[alt].children[1].innerHTML);
                peso = parseFloat(conf[pes].children[1].innerHTML);
                geracao = conf[gen].children[1].innerHTML;

                // ----------------------------------------------- CONFERIR TIPO 1 DO POKEMON DO DIA -----------------------------------------------
                if (tipo1 == pokemonDia[1]) {
                    // console.log('tipo 1: ' + tipo1 + ' ' + i)
                    conf[i].style.background = "rgb(128 239 138)"
                }
                if (tipo2 == pokemonDia[1]) {
                    // console.log('tipo 2: ' + tipo2 + ' ' + i)
                    conf[p].style.background = "rgb(239 231 128)"
                }

                // ----------------------------------------------- CONFERIR TIPO 2 DO POKEMON DO DIA -----------------------------------------------
                if (tipo1 == pokemonDia[2]) {
                    // console.log('tipo 1: ' + tipo1 + ' ' + i)
                    conf[i].style.background = "rgb(239 231 128)"
                }
                if (tipo2 == pokemonDia[2]) {
                    // console.log('tipo 2: ' + tipo2 + ' ' + i)
                    conf[p].style.background = "rgb(128 239 138)"
                }

                // ----------------------------------------------- CONFERIR ALTURA DO POKEMON DO DIA -----------------------------------------------
                if (altura == pokemonDia[3]) {
                    // console.log('tipo 1: ' + tipo1 + ' ' + i)
                    conf[alt].style.background = "rgb(128 239 138)"
                }

                // ----------------------------------------------- CONFERIR PESO DO POKEMON DO DIA -----------------------------------------------
                if (peso == pokemonDia[4]) {
                    // console.log('tipo 1: ' + tipo1 + ' ' + i)
                    conf[pes].style.background = "rgb(128 239 138)"
                }

                // ----------------------------------------------- CONFERIR GERACAO DO POKEMON DO DIA -----------------------------------------------
                if (geracao == pokemonDia[5]) {
                    // console.log('tipo 1: ' + tipo1 + ' ' + i)
                    conf[gen].style.background = "rgb(128 239 138)"
                }

            }
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</body>

</html>