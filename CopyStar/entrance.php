<html lang="en">


<?php
session_start();
if (isset($_SESSION['user'])) {
    header('Location: /profile.php');
}
?>

<?php require_once 'includes/head.php'; ?>

<body>
    <div class="page">
        <?php require_once 'includes/header.php'; ?>
        <main class="main">
            <div class="container">
                <div class="main-content">
                    <form>
                        <div class="row center">
                            <div class="form-container">
                                <div class="align-items-center space-between">
                                    <div class="title">Вход</div>
                                </div>
                                <div class="input-text">Логин</div>
                                <input type="text" id="login" class="input">
                                <div class="input-text">Пароль</div>
                                <input type="password" id="password" class="input">
                                <div class="link">
                                    <p>Нет аккаунта? </p>
                                    <a href="/register.php">Зарегистрируйтесь!</a>
                                </div>
                                <div class="error-msg"></div>
                                <div class="row center">
                                    <button class="btn" id="btn-login">Войти</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <?php require_once 'includes/footer.php'; ?>
    </div>


    <script src="js/jquery/jquery-3.6.0.min.js"></script>
    <script src="js/auth.js"></script>

</body>

</html>