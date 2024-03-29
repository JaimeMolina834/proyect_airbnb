<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">


    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title><?=$this->renderSection('title')?>&nbsp;-&nbsp;Proyect Airbnb 2022</title>
    <?=$this->renderSection('css')?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title><?=$this->renderSection('title')?>&nbsp;-&nbsp;Proyect Airbnb 2022</title>
    <?=$this->renderSection('css')?>
</head>
<!-- estilos para el boton de agregar fotos -->
<style>
.btn-warning {
    position: relative;
    padding: 5px 16px;
    font-size: 15px;
    line-height: 1.5;
    border-radius: 3px;
    color: #fff;
    background-color: #7887ea;
    border: 0;
    transition: 0.2s;
    overflow: hidden;
}

.btn-warning input[type="file"] {
    cursor: pointer;
    position: absolute;
    left: 0%;
    top: 0%;
    transform: scale(3);
    opacity: 0;
}

.btn-warning:hover {
    background-color: #d9a400;
}
hr{
    border: none;
    height: 5px;
    background: black;
}
</style>

<body>
    <?=$this->include('anfitrion/layout/header')?>
    <?=$this->renderSection('content')?>
    <?=$this->include('anfitrion/layout/footer')?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script>
    const $foto1 = document.querySelector("#foto1"),
        $imagenPre1 = document.querySelector("#imagenPre1");

    // Escuchar cuando cambie
    $foto1.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $foto1.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPre1.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPre1.src = objectURL;
    })

    const $foto2 = document.querySelector("#foto2"),
        $imagenPre2 = document.querySelector("#imagenPre2");

    // Escuchar cuando cambie
    $foto2.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $foto2.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPre2.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPre2.src = objectURL;
    })

    const $foto3 = document.querySelector("#foto3"),
        $imagenPre3 = document.querySelector("#imagenPre3");

    // Escuchar cuando cambie
    $foto3.addEventListener("change", () => {
        // Los archivos seleccionados, pueden ser muchos o uno
        const archivos = $foto3.files;
        // Si no hay archivos salimos de la función y quitamos la imagen
        if (!archivos || !archivos.length) {
            $imagenPre3.src = "";
            return;
        }
        // Ahora tomamos el primer archivo, el cual vamos a previsualizar
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        $imagenPre3.src = objectURL;
    })



    let pais = document.querySelector('#pais')
    let departamento = document.querySelector('#departamento')
    let municipio = document.querySelector('#municipio')

    document.addEventListener("DOMContentLoaded", () => {
        fetch('http://api_airbnb.test/paises').then(data => {
            return data.json()
        }).then(cargarPaises)
    })

    const cargarPaises = data => {
        for (let index = 0; index < data.paises.length; index++) {
            pais.innerHTML +=
                `<option value="${data.paises[index].idPais}">${data.paises[index].pais}</option>`
        }
    }

    pais.addEventListener("change", () => {
        departamento.innerHTML = ``
        fetch(`http://api_airbnb.test/departamentos/${pais.value}`, {
            'mode': 'cors'
        }).then(data => {
            return data.json()
        }).then(cargarDepartamentos)
    })

    const cargarDepartamentos = data => {
        departamento.innerHTML += `<option value="">...</option>`
        for (let index = 0; index < data.departamentos.length; index++) {
            departamento.innerHTML +=
                `<option value="${data.departamentos[index].idDepartamento}">${data.departamentos[index].departamento}</option>`
        }
    }

    departamento.addEventListener("change", () => {
        municipio.innerHTML = ``
        fetch(`http://api_airbnb.test/municipios/${departamento.value}`, {
            'mode': 'cors'
        }).then(data => {
            return data.json()
        }).then(cargarMunicipios)
    })

    const cargarMunicipios = data => {
        municipio.innerHTML += `<option value="">...</option>`
        for (let index = 0; index < data.municipios.length; index++) {
            municipio.innerHTML +=
                `<option value="${data.municipios[index].idMunicipio}">${data.municipios[index].municipio}</option>`
        }
    }
    </script>
    <?=$this->renderSection('js')?>
</body>

</html>