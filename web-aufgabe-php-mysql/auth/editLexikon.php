<!DOCTYPE html>
<html>
<?php
//include auth.php file on all secure pages
include("auth.php");
define('SECURE', true);
include('../inc/loggedNav.inc.php');
?>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/custom.css">
</head>

<body class="mt-5">
    <section>
        <!-- Button Modal Trigger -->
        <div class="ribbon" id="addButton">
            <div class="ribbon-fold"> <button type="button" class="btn" data-toggle="modal" data-target="#addEntry">
                    <i class="fas fa-plus"></i>Add Entry
                </button></div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addEntry" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Neuer Eintrag</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../inc/saveEntry.inc.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Titel (max. 550 Zeichen)</label>
                                <input type="text" class="form-control" name="title" require>
                            </div>
                            <div class="form-group">
                                <label for="teaser">Teaser (max. 550 Zeichen</label>
                                <textarea class="form-control" rows="3" name="teaser" require></textarea>
                            </div>
                            <div class="form-group">
                                <label for="description">Beschreibung</label>
                                <textarea class="form-control" name="description" rows="3" require></textarea>
                            </div>
                            <div class="form-group">
                                <label for="fileUpload">File Upload</label>
                                <input type="file" class="form-control file" name="fileUpload">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container pt-2 my-3 h-100">
        <?php
        include("../inc/login.inc.php");
        include('dataTable.inc.php');
        ?>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="lexikon-entry" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form method="post" id="insert_form">
                        <input type="hidden" name="entry_id" id="entry_id">
                        <div class="form-group">
                            <label for="title">Titel</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <!-- <textarea class="form-control" rows="3" name="title" require</textarea> -->
                        </div>
                        <div class="form-group">
                            <label for="teaser">Teaser</label>
                            <textarea type="text" id="teaser" class="form-control" name="teaser"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Beschreibung</label>
                            <textarea type="text" id="description" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <img src="" class="img-fluid" id="imgOld">
                        </div>
                        <div class="form-group">
                            <label for="description">Neues Bild</label>
                            <input type="file" class="form-control-file" name="fileUpdate" id="fileUpdate">
                        </div>
                        <button type="button" class="btn btn-success" name="insert" id="insert">Insert</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="responses"></div>
    <!-- Info Ende -->

    <!-- delete_data_Modal -->
    <div id="delete_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <p id="titleDelete"></p>
                    <p id="descriptionDelete"></p>
                    <p id="teaserDelete"></p>
                    <p id="imgDelete"></p>
                    <form method="post" id="delete_form">
                        <input type="hidden" id="deleteIMG" name="deleteIMG">
                        <input type="hidden" name="entry_id" id="entryDelete_id">
                        <button class="btn btn-danger" type="button" name="delete" id="delete">Löschen</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.edit_data', function() {
                var entry_id = $(this).attr("id");
                console.log(entry_id);
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        entry_id: entry_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#title').val(data.title);
                        $('#teaser').val(data.teaser);
                        $('#description').val(data.description);
                        $('#entry_id').val(data.id);
                        $('#imgOld').attr("src", '../upload-img/' + data.imgpath);
                        $('#insert').val("Update");
                        $('#add_data_Modal').modal('show');
                    },
                    error: function(req, err) {
                        console.log('my message ' + err);
                    }
                });
            });
        });

        $(document).on('click', '#insert', function(e) {
            e.preventDefault();
            var form = $('#insert_form')[0];
            var formData = new FormData(form);
            console.log(formData);
            if ($('#title').val() == "") {
                alert("Name is required");
            } else if ($('#teaser').val() == '') {
                alert("teaser is required");
            } else if ($('#description').val() == '') {
                alert("description is required")
            } else {
                $.ajax({
                    url: 'insert.php',
                    type: 'POST',
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false, //Add this
                    contentType: false, //Add this
                    dataType: 'html',
                    success: function(data) {
                        $('#insert_form')[0].reset();
                        $('#add_data_Modal').modal('hide');
                        $('#lexikon_table').html(data);
                    }
                })
            }
        })

        $(document).on('click', '.delete_data', function() {
            var entryDelete_id = $(this).attr("id");
            console.log(entryDelete_id);
            $.ajax({
                url: "fetch.php",
                method: "POST",
                data: {
                    entry_id: entryDelete_id
                },
                dataType: 'json',
                success: function(data) {
                    $('#titleDelete').html(data.title);
                    $('#teaserDelete').html(data.teaser);
                    $('#descriptionDelete').html(data.description);
                    $('#imgDelete').html(data.imgpath);
                    $('#deleteIMG').val(data.imgpath);
                    $('#entryDelete_id').val(data.id);
                    $('#delete').html("Delete");
                    $('#delete_data_Modal').modal('show');
                },
                error: function(req, err) {
                    console.log('my message ' + err);
                }
            });
        });
        $(document).on('click', '#delete_form', function(event) {
            event.preventDefault();

            $.ajax({
                url: "delete.php",
                method: "POST",
                data: $('#delete_form').serialize(),
                beforeSend: function() {
                    $('#delete').val("Deleting");
                },
                success: function(data) {
                    $('#delete_form')[0].reset();
                    $('#delete_data_Modal').modal('hide');
                    $('#lexikon_table').html(data);
                }
            });
        });
    </script>
</body>

</html>