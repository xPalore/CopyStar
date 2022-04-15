<?php session_start(); ?>
<header class="header">
    <div class="container">
        <div class="row space-between align-items-center">
            <div class="logo">
                <a class="logo" href="/"><img src="../img/logo.svg" alt="">Copy Star</a>
            </div>
            <nav class="nav">
                <ul class="row">
                    <li><a class="nav-link" href="/">Главная</a></li>
                    <li><a class="nav-link" href="/shop.php">Магазин</a></li>
                    <li><a class="nav-link" href="/about.php">О нас</a></li>
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                        <li><a class="nav-link" href="/profile.php">Личный кабинет</a></li>
                        <li><a class="nav-link" href="/App/Controllers/logoutController.php">Выход</a></li>
                    <?php
                    } else {
                    ?>
                        <li><a class="nav-link" href="/entrance.php">Вход</a></li>
                        <li><a class="nav-link" href="/register.php">Регистрация</a></li>
                    <?php
                    }
                    ?>

                </ul>
            </nav>
        </div>
    </div>
</header>