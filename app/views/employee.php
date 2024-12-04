<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    include("../controller/EmployeeController.php");

    $controller = new EmployeeController();
    $employees = $controller->get();
    $departaments = $controller->getDepartaments();
    $genders = $controller->getGenders();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_POST['save'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $age = $_POST['age'];
            $hire_date = $_POST['hire_date'];
            $comments = $_POST['comments'];
            $gender_id = $_POST['gender_id'];
            $department_id = $_POST['department_id'];
            $salary = $_POST['salary'];
            $mensaje = $controller->save($first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary);

        } elseif (isset($_POST['update'])) {
            
            $id = $_POST['id'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $age = $_POST['age'];
            $hire_date = $_POST['hire_date'];
            $comments = $_POST['comments'];
            $gender_id  = $_POST['gender_id'];
            $department_id = $_POST['department_id'];
            $salary = $_POST['salary'];

            $mensaje = $controller->update($id, $first_name, $last_name, $age, $hire_date, $comments, $gender_id, $department_id, $salary);

        } elseif (isset($_POST['delete'])) {
            $mensaje = $controller->delete($id);
        }

        $employees = $controller->get();
        $departaments = $controller->getDepartaments();
        $genders = $controller->getGenders();
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
            <h3 class="tittle-table">Empleados</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-whatever="@mdo">Nuevo registro</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Edad</th>
                            <th scope="col">Fecha ingreso</th>
                            <th scope="col">Comentarios</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Salario</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($employees) && is_array($employees) && count($employees) > 0): ?>
                            <?php foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?= $employee['id']; ?></td>
                                    <td><?= $employee['first_name']; ?></td>
                                    <td><?= $employee['last_name']; ?></td>
                                    <td><?= $employee['age']; ?></td>
                                    <td><?= $employee['hire_date']; ?></td>
                                    <td><?= $employee['comments']; ?></td>
                                    <td><?= $employee['gender']; ?></td>
                                    <td><?= $employee['departament']; ?></td>
                                    <td><?= "$" . number_format($employee['salary'], 0, '.', ',');  ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" 
                                          data-id="<?= $employee['id']; ?>"
                                          data-first_name="<?= $employee['first_name']; ?>"
                                          data-last_name="<?= $employee['last_name']; ?>"
                                          data-age="<?= $employee['age']; ?>"
                                          data-hire_date="<?= $employee['hire_date']; ?>"
                                          data-comments="<?= $employee['comments']; ?>"
                                          data-gender_id="<?= $employee['gender_id']; ?>"
                                          data-salary="<?= $employee['salary']; ?>"
                                          data-department_id="<?= $employee['department_id']; ?>">
                                          Editar
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $employee['id']; ?>">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3">No hay colaboradores registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="registerModalLabel">Nuevo colaborador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="employee.php" method="POST">
                        <div class="modal-body">

                          <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_name" class="col-form-label">Nombres:</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_name" class="col-form-label">Apellidos:</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="income" class="col-form-label">Edad:</label>
                                <input type="number" class="form-control" id="age" name="age" required step="1" min="0" value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="hire_date" class="col-form-label">Fecha ingreso:</label>
                                <input type="date" class="form-control" id="hire_date" name="hire_date" required />
                            </div>
                            <div class="col-md-4">
                                <label for="salary" class="col-form-label">Salario:</label>
                                <input type="number" class="form-control" id="salary" name="salary" required />
                            </div>
                          </div>
                            
                          <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender_id" class="col-form-label">Genero:</label>
                                <select id="gender_id" name="gender_id" class="form-select">
                                    <option selected>Seleccione el genero</option>
                                    <?php foreach ($genders as $gender): ?>
                                        <option value='<?=$gender["id"]?>'><?= $gender["name"]?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                           
                            <div class="col-md-6">
                                <label for="department_id" class="col-form-label">Departamento:</label>
                                <select id="department_id" name="department_id" class="form-select">
                                    <option selected>Seleccione el departamento</option>
                                    <?php foreach ($departaments as $departament): ?>
                                        <option value='<?=$departament["id"]?>'><?= $departament['name']?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                          </div>

                          <div class="mb-3">
                                <label for="comments" class="col-form-label">Comentarios:</label>
                                <textarea class="form-control" id="comments" name="comments"></textarea>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Modificar colaborador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="employee.php" method="POST">
                        <div class="modal-body">
                          <input type="hidden" id="idU" name="id">

                          <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="first_nameU" class="col-form-label">Nombres:</label>
                                <input type="text" class="form-control" id="first_nameU" name="first_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="last_nameU" class="col-form-label">Apellidos:</label>
                                <input type="text" class="form-control" id="last_nameU" name="last_name" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="ageU" class="col-form-label">Edad:</label>
                                <input type="number" class="form-control" id="ageU" name="age" required step="1" min="0" value="0">
                            </div>
                            <div class="col-md-4">
                                <label for="hire_dateU" class="col-form-label">Fecha ingreso:</label>
                                <input type="date" class="form-control" id="hire_dateU" name="hire_date" required />
                            </div>
                            <div class="col-md-4">
                                <label for="salaryU" class="col-form-label">Salario:</label>
                                <input type="number" class="form-control" id="salaryU" name="salary" required />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender_idU" class="col-form-label">Genero:</label>
                                <select id="gender_idU" name="gender_id" class="form-select">
                                    <option selected>Seleccione el genero</option>
                                    <?php foreach ($genders as $key => $gender): ?>
                                        <option value='<?=$gender["id"]?>'><?= $gender["name"]?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                           
                            <div class="col-md-6">
                                <label for="department_idU" class="col-form-label">Departamento:</label>
                                <select id="department_idU" name="department_id" class="form-select">
                                    <option selected>Seleccione el departamento</option>
                                    <?php foreach ($departaments as $departament): ?>
                                        <option value='<?=$departament["id"]?>'><?= $departament['name']?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                            <div class="mb-3">
                                <label for="commentsU" class="col-form-label">Comentarios:</label>
                                <textarea class="form-control" id="commentsU" name="comments"></textarea>
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
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar colaborador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="expense.php" method="POST">
                        <div class="modal-body">
                            <p>¿Estás seguro de eliminar este colaborador?</p>
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

    document.querySelectorAll('.btn-warning').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const first_name = this.getAttribute('data-first_name');
        const last_name = this.getAttribute('data-last_name');
        const age = this.getAttribute('data-age');
        const hire_date = this.getAttribute('data-hire_date');
        const comments = this.getAttribute('data-comments');
        const gender_id = this.getAttribute('data-gender_id');
        const department_id = this.getAttribute('data-department_id');
        const salary = this.getAttribute('data-salary');
        
        document.getElementById('idU').value = id;
        document.getElementById('first_nameU').value = first_name;
        document.getElementById('last_nameU').value = last_name;
        document.getElementById('ageU').value = age;
        document.getElementById('hire_dateU').value = hire_date;
        document.getElementById('commentsU').value = comments;
        document.getElementById('gender_idU').value = gender_id;
        document.getElementById('department_idU').value = department_id;
        document.getElementById('salaryU').value = salary;
    });
});

    let deleteModal = document.getElementById('deleteModal')
    deleteModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget
        let id = button.getAttribute('data-id')
        let modalIdInput = deleteModal.querySelector('#deleteId')
        modalIdInput.value = id;
    })

   
</script>
