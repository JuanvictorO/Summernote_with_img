<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="https://github.com/JuanvictorO">
    <meta name="description" content="Testing the summernote with a table">
    <!-- Jquery CDNjs -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <!-- BOOTSTRAP 4.0 CDNjs -->
    <script src="<?= base_url('assets/vendor/') ?>bootstrap-4.4.1/popper.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/') ?>bootstrap-4.4.1/bootstrap.min.css">
    <script src="<?= base_url('assets/vendor/') ?>bootstrap-4.4.1/bootstrap.min.js"></script>
    <!--script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script-->
    <!-- Summernote CDNjs -->
    <!--link rel="stylesheet" href="<?= base_url('assets/vendor/') ?>summernote/summernote.min.css">
    <script src="<?= base_url('assets/vendor/') ?>summernote/summernote.min.css"></script-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
    <!-- Toastr CDNjs -->
    <link href="<?= base_url('assets/vendor/') ?>toastr/toastr.min.css" rel="stylesheet">
    <script src="<?= base_url('assets/vendor/') ?>toastr/toastr.min.js"></script>
</head>

<body>
    <div class="form-group mt-5">
        <label for="summernote">Insira o texto aqui:</label>
        <div id="summernote"></div>
    </div>
    </div>
</body>
<script>
    //Inicializa o summernote e define suas opções
    $('#summernote').summernote({
        height: 400,
        callbacks: {
            onImageUpload: function(files) {
                for (var i = 0; i < files.length; i++) {
                    $.upload(files[i]);
                }
            },
            onMediaDelete: function(target) {
                deleteFile(target[0].src);

            }
        }
    });
    // Função que faz o upload da foto para a pasta uploads
    $.upload = function(file) {
        let out = new FormData();
        out.append('file', file, file.name);

        $.ajax({
            data: out,
            method: "POST",
            url: "<?= base_url('summernote/uploadFile') ?>",
            cache: false,
            processData: false,
            contentType: false,
            success: function(res) {
                console.log(res.error);
                // $('#summernote').summernote('insertImage', img);
                //console.log(res);
            },
            error: function(res) {
                alert('Algo deu errado.');
            }
        });
    }
    // Deleta a imagem passada pela variável src
    function deleteFile(src) {
        $.ajax({
            data: {
                src: src
            },
            method: "POST",
            url: "<?= base_url('summernote/deleteFile') ?>",
            cache: false,
            success: function(resp) {
                toastr["success"](resp);
            },
            error: function(msg) {
                toastr["error"](resp);
            }
        });
    }
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>

</html>