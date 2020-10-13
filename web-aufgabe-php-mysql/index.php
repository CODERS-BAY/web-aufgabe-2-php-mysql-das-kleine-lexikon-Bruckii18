<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL Übung</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/custom.css">
</head>

<body class="mt-5">
    <?php include('inc/loggedNav.inc.php');?>
    <h1 class="container shadow-lg p-3 mb-5 bg-white rounded mt-4">Der Wolf</h1>
    <section class="container">
        <div class="card-columns">
            <?php
            include('inc/login.inc.php');
            $result = $con->query("SELECT id, title, teaser, imgpath FROM content");

            while ($entry = $result->fetch_assoc()) {
            ?>

                <!-- Card Anfang -->
                <div class="card shadow-lg p-3 mb-5 bg-white rounded" id="id<?php echo $entry['id'] ?>">
                    <?php if ($entry['imgpath']) { ?>
                        <img src="upload-img/<?php echo $entry['imgpath'] ?>" class="card-img blur" alt="...">
                    <?php } ?>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="card-title btn btn-dark ajaxModal" data-toggle="modal" data-id="<?php echo $entry['id'] ?>">
                            <?php echo $entry['title']; ?>
                        </button>
                        <p class="card-text teaser">
                            <?php
                            echo $entry['teaser'];
                            ?>
                        </p>
                    </div>
                </div>
                <!-- Card Ende -->

            <?php
            }
            $con->close();
            ?>
        </div>
    </section>
    <section>
        <!-- Modal Info -->
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Info Ende -->
    </section>
    <section>
        <!-- Modal Login-->
        <div class="modal" tabindex="-1" role="dialog" id="login">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Login</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="auth/login.php?login=1" method="post">
                            <div class="form-group">
                                <label for="email" class="col-md-6">Username:</label>
                                <input type="text" name="username" class="col-md-5" value="" required="required" placeholder="Username" maxlength="255" id="username" require>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-md-6">Passwort:</label>
                                <input type="password" class="col-md-5" name="password" required="required" placeholder="Passwort" maxlength="50">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Login</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Info Ende -->
    </section>
    <section>
        <!-- Modal registry -->
        <div class="modal" tabindex="-1" role="dialog" id="registry">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Register</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="auth/registry.php?register=1" method="post">
                            <div class="form-group d-flex justify-content-between">
                                <label for="username">Username</label>
                                <input type="text" size="40" maxlength="250" name="username" id="username" require>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label for="forename">Vorname</label>
                                <input type="text" size="40" maxlength="250" name="forename" id="forename" require>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label for="familyname">Nachname</label>
                                <input type="text" size="40" maxlength="250" name="familyname" id="familyname" require>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label for="email">E-Mail-Adresse</label>
                                <input type="email" size="40" maxlength="250" name="email" id="email" require>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label for="password">Dein Passwort:</label>
                                <input type="password" size="40" maxlength="250" name="password" id="password" require>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <label for="password2">Passwort wiederholen:</label>
                                <input type="password" size="40" maxlength="250" name="password2" id="password2" require>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">Register</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script>
        // Modal dynamisch mit Inhalt befüllen
        $(document).ready(function() {

            $('.ajaxModal').click(function() {

                var lexikonID = $(this).data('id');

                //AJAX request
                $.ajax({
                    url: './inc/loadModal.inc.php',
                    type: 'post',
                    data: {
                        lexikonID: lexikonID
                    },
                    success: function(response) {
                        //Add response in Modal body
                        $('.modal-content').html(response);
                        console.log(response);
                        //Display Modal
                        $('#showModal').modal('show');
                    }
                });
            });
        });
    </script>
</body>

</html>