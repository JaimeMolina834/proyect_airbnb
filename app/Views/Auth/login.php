<?= $this->extend('auth/main') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<section>
    <div class="container mt-5 pt-5">

        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <?php if (session('msg')) : ?>
                            <article class="message is-<?= session('msg.type') ?>">
                                <div class="message-body">
                                    <?= session('msg.body') ?>
                                </div>
                            </article>
                        <?php endif; ?>
                        <h2 class="title text-center">Airbnb</h2>
                        <h2 class="subtitle text-center">Inicia sesionen tu cuenta</h2>
                        <div class="text-center">
                            <img src="https://smartemployee.gbm.net/www/assets/img/user.png"
                                class="img-fluid  rounded-circle my-3" width="110px"
                                alt="profile">
                        </div>

                        <form action="<?= base_url(route_to('signin')) ?>" method="POST">
                            <div class="form-outline mb-4">
                                <p class="control has-icons-left has-icons-right">
                                    <input class="input" name="email" value='<?= old('email') ?>' type="" placeholder="Correo Electronico">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                </p>
                                <p class="is-danger help"><?= session('errors.email') ?></p>
                            </div>

                            <div class="form-outline mb-4">
                                <p class="control has-icons-left">
                                    <input class="input" name="password" type="password" placeholder="Contraseña">
                                    <span class="icon is-small is-left">
                                        <i class="fas fa-lock"></i>
                                    </span>
                                </p>
                                <p class="is-danger help"><?= session('errors.password') ?></p>
                            </div>
                            <div class="text-center mt-6">
                                <p class="control">
                                    <input type="submit" class="btn btn-primary" value="Ingresar">
                                </p>
                                <a href="#" class="nav-link">¿Has olvidado tu contraseña?</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<br><br>
<?= $this->endSection() ?>