<?=$this->extend('home/main')?>

<?=$this->section('title')?>
Inicio
<?=$this->endSection()?>

<?=$this->section('css')?>

<!-- <link rel="stylesheet" href="css/carusel.css"> -->
<?=$this->endSection()?>

<?=$this->section('content')?>
<br><br>
<!-- Carousel -->
    <div class="container">
        <div id="carousel1" class="carousel" data-ride="carousel">
            <div class="carousel-inner">
            <div class="carousel-item active">
               <img src="img/h1.jpg" alt="" width="1920" height="1080">
            </div>

            <div class="carousel-item">
               <img src="img/hh2.jpg" alt="" width="1920" height="1080">
            </div>
            
            <div class="carousel-item">
               <img src="img/c1.jpg" alt="" width="1920" height="1080">
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
            
        </div>
      
    </div>
<br><br>

<?=$this->endSection()?>