<?=$this->extend('home/main')?>

<?=$this->section('title')?>
Inicio
<?=$this->endSection()?>

<?=$this->section('css')?>


<?=$this->endSection()?>

<?=$this->section('content')?>

<!-- Carousel principal -->
<section>
<div class="container-fluid"style="background-color:black";><br><br>
        <div id="carousel1" class="carousel" data-ride="carousel">
            <div class="rounded carousel-inner" style="width: 90%;margin: 0 auto;">
            <div class="carousel-item active">
               <img src="img/h1.jpg" alt="" width="1920" height="10">
            </div>

            <div class="carousel-item">
               <img src="img/hh2.jpg" alt="" width="1920" height="10">
            </div>
            
            <div class="carousel-item">
               <img src="img/c1.jpg" alt="" width="1920" height="10">
            </div>
            </div>
            
            <!--Controles sigiente y anterior-->
            <a class="carousel-control-prev" href="#carousel1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--Controles de indicadores-->
            <ol class="carousel-indicators">
                <li data-target="#carousel1" data-slide-to="0" class="active"></li>
                <li data-target="#carousel1" data-slide-to="1"></li>
                <li data-target="#carousel1" data-slide-to="2"></li>
            </ol>
            
        </div><br><br>
        </div>
</section>


<!-- Owl carrusel -->

<div class="container-fluid my-5" style="background-color:black;">
    <h1 class="text-center fw-bold display-1 mb-5">Inspiración <span class="text-danger">para tu viaje</span></h1>
    <div class="row">
        <div class="col-12 m-auto">
            <div class="owl-carousel owl-theme">
                <div class="item mb-4">
                    <div class="card border-0 shadow">
                        <img src="img/c1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Cerro verde</h5>
                            <p class="card-text">Some quick example text to build.</p>
                            <a href="#" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow">
                        <img src="img/h1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Cerro verde</h5>
                            <p class="card-text">Some quick example text to build.</p>
                            <a href="#" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow">
                        <img src="img/h1.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Cerro verde</h5>
                            <p class="card-text">Some quick example text to build.</p>
                            <a href="#" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="card border-0 shadow">
                        <img src="img/hh2.jpg" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Cerro verde</h5>
                            <p class="card-text">Some quick example text to build.</p>
                            <a href="#" class="btn btn-primary">Ir</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><br><br>

<?=$this->endSection()?>