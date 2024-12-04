<style>
    h1{
        font-size: 50px !important;
        margin-top: 50px !important;
    }

    body {
        background-color: #000 !important;
        color: #fff !important;
        text-align: center !important;
        font-size: 20px !important;
    }
</style>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>index</title>
  </head>
  <body>
    <h1>Bienvenido(a) a Employee Management.</h1>
    <p>El lugar donde puede gestionar los colaboradores a un solo click.</p>

    <button type="button" class="btn btn-success" id="start">Iniciar</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   
  </body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const button = document.getElementById('start');
        button.addEventListener('click', function() {
            window.location.href = "app/views/employee.php";
        });
    })
</script>