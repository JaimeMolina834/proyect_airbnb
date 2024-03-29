<section class="hero is-dark">
    <div class="hero-foot">
        <!--Menu-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark scrolling-navbar fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=base_url(route_to('anfitrionInicio'))?>"><img src="/img/logo.png"
                        class="img-fluid" width="60px" height="60px" alt=""></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto mb-2 mb-lg-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?=base_url(route_to('anfitrionInicio'))?>">Mis alojamientos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page"
                                href="<?=base_url(route_to('misReservas'))?>">Mis reservas</a>
                        </li>
                    </ul>
                    <div class="btn-group" role="group">
                        <a id="btnGroupDrop1" type="button" class="btn write" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="/img/linicio.png" class="img-fluid" width="50px" height="30px" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php if(service('request')->uri->getPath() == 'anfitrion/perfil') : ?>
                            <li>
                                <a class="dropdown-item" href="<?=base_url(route_to('anfitrionSignout'))?>">Cerrar
                                    Sesión</a>
                            </li>
                            <?php else: ?>
                            <!-- <li>
                                <a class="dropdown-item" href="<?=base_url(route_to('anfitrionBusqueda'))?>">Buscar</a>
                            </li>-->
                            <!--<li>
                                <a class="dropdown-item" href="<?php//base_url(route_to('regresarAUsuario'))?>">Regresar
                                    modo usuario</a>
                            </li>-->
                            <li>
                                <a class="dropdown-item" href="<?=base_url(route_to('perfil'))?>">Perfil</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?=base_url(route_to('anfitrionSignout'))?>">Cerrar
                                    Sesión</a>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
        </nav>
    </div>
</section>