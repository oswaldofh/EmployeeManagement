<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    include("../controller/DepartamentController.php");

    $controller = new DepartamentController();
    $departaments = $controller->get();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['save'])) {
            $mensaje = $controller->save($_POST['departament']);
        } elseif (isset($_POST['update'])) {
            $mensaje = $controller->update($_POST['id'], $_POST['departament']);
        } elseif (isset($_POST['delete'])) {
            $mensaje = $controller->delete($_POST['id']);
        }
        $departaments = $controller->get();
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
       <title>Departament</title>
    </head>
    <body>
        <div class="container">
            <h3 class="tittle-table">Departamentos</h3>
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
                        <?php if (isset($departaments) && is_array($departaments) && count($departaments) > 0): ?>
                            <?php foreach ($departaments as $departament): ?>
                                <tr>
                                    <td><?= $departament['id']; ?></td>
                                    <td><?= $departament['name']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" data-id="<?= $departament['id']; ?>" data-name="<?= $departament['name']; ?>">Editar</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $departament['id']; ?>">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No hay departamentos registrados.</td>
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
                    <form action="departament.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="departament" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="departament" name="departament" required>
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
                        <h5 class="modal-title" id="updateModalLabel">Modificar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="departament.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="updateId" name="id">
                            <div class="mb-3">
                                <label for="updateDepartament" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="updateDepartament" name="departament" required>
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
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Departamento</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="departament.php" method="POST">
                        <div class="modal-body">
                            <p>¿Estás seguro de eliminar este departamento?</p>
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
        let modalNameInput = updateModal.querySelector('#updateDepartament')

        modalTitle.textContent = 'Modificar Departamento';
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
