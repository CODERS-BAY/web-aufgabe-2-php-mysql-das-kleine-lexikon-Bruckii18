<?php define('ROOTPATH', 'http://localhost/web-aufgabe-php-mysql/');
if(!isset($_SESSION['username'])) {
session_start();
} ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?php echo ROOTPATH; ?>index.php">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <ul class="navbar-nav mr-auto">

            <?php if (!isset($_SESSION['username'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#registry">Registrierung</a>
                </li>
                <li class="nav-item">
                    <p id="errorMsg"></p>
                </li>
            <?php } else { ?>
                <li class="nav-item text-white p-2">
                    Hallo <?php echo $_SESSION["username"] ?>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOTPATH; ?>auth/editLexikon.php">Edit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ROOTPATH; ?>auth/logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
        <form class="form-inline my-2 my-lg-0 search-box">
            <input class="form-control mr-sm-2" type="text" autocomplete="off" placeholder="Search" aria-label="Search">
            <div class="result bg-white col-12 fixed-top mt-5 card"></div>

        </form>
    </div>
</nav>