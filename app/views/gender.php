<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    include("../controller/GenderController.php");

    $controller = new GenderController();
    $genders = $controller->get();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['save'])) {
            $mensaje = $controller->save($_POST['gender']);
        } elseif (isset($_POST['update'])) {
            $mensaje = $controller->update($_POST['id'], $_POST['gender']);
        } elseif (isset($_POST['delete'])) {
            $mensaje = $controller->delete($_POST['id']);
        }
        $genders = $controller->get();
    }
    include('navbar.php');
?>
<style>
    .tittle-table{
        text-align: center;
        margin: 20px;
    }
    .modal-title{
        text-align: center;
    }
</style>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gender</title>
    </head>
    <body>
        <div class="container">
            <h3 class="tittle-table">Generos</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-whatever="@mdo">Nuevo registro</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($genders) && is_array($genders) && count($genders) > 0): ?>
                            <?php foreach ($genders as $gender): ?>
                                <tr>
                                    <td><?= $gender['id']; ?></td>
                                    <td><?= $gender['name']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="<?= $gender['id']; ?>" data-name="<?= $gender['name']; ?>">Editar</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $gender['id']; ?>">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No hay generos registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Nuevo Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="gender.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="gender" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="gender" name="gender" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success" name="save">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Modificar Genero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="gender.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="updateId" name="id">
                            <div class="mb-3">
                                <label for="updateGender" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="updateGender" name="gender" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" name="update">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Genero</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="gender.php" method="POST">
                        <div class="modal-body">
                            <p>¿Estás seguro de eliminar este genero?</p>
                            <input type="hidden" id="deleteId" name="id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger" name="delete">Eliminar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </body>
</html>

<script>
    let updateModal = document.getElementById('updateModal')
    updateModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let id = button.getAttribute('data-id')
        let name = button.getAttribute('data-name')
        let modalTitle = updateModal.querySelector('.modal-title')
        let modalIdInput = updateModal.querySelector('#updateId')
        let modalNameInput = updateModal.querySelector('#updateGender')

        modalTitle.textContent = 'Modificar Genero';
        modalIdInput.value = id;
        modalNameInput.value = name;
    })

    let deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let id = button.getAttribute('data-id')
        let modalIdInput = deleteModal.querySelector('#deleteId')
        modalIdInput.value = id;
    })
</script>
