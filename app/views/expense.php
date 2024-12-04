<?php 
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    include("../controller/ExpenseController.php");

    $controller = new ExpenseController();
    $expenses = $controller->get();
    $departaments = $controller->getDepartaments();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
;

        if (isset($_POST['save'])) {

            $year = $_POST['year'];
            $month = $_POST['month'];
            $income = $_POST['income'];
            $expense = $_POST['expense'];
            $department_id = $_POST['department_id'];
            $mensaje = $controller->save($year, $month, $income, $expense, $department_id);

        } elseif (isset($_POST['update'])) {
            
            $id = $_POST['id'];
            $year = $_POST['year'];
            $month = $_POST['month'];
            $income = $_POST['income'];
            $expense = $_POST['expense'];
            $department_id = $_POST['department_id'];
            $mensaje = $controller->update($id, $year, $month, $income, $expense, $department_id);

        } elseif (isset($_POST['delete'])) {
            $mensaje = $controller->delete($id);
        }

        $expenses = $controller->get();
        $departaments = $controller->getDepartaments();
    }

    $months = array(
        1=> 'Enero',
        2=> 'Febrero',
        3=> 'Marzo',
        4=> 'Abril',
        5=> 'Mayo',
        6=> 'Junio',
        7=> 'Julio',
        8=> 'Agosto',
        9=> 'Septiembre',
        10=> 'Octubre',
        11=> 'Noviembre',
        12=> 'Diciembre',

    );
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
            <h3 class="tittle-table">Gastos</h3>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#registerModal" data-bs-whatever="@mdo">Nuevo registro</button>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Año</th>
                            <th scope="col">Mes</th>
                            <th scope="col">Ingreso</th>
                            <th scope="col">Gasto</th>
                            <th scope="col">Departamento</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($expenses) && is_array($expenses) && count($expenses) > 0): ?>
                            <?php foreach ($expenses as $expense): ?>
                                <tr>
                                    <td><?= $expense['id']; ?></td>
                                    <td><?= $expense['year']; ?></td>
                                    <td><?= $expense['month']; ?></td>
                                    <td><?= "$" . number_format($expense['income'], 0, '.', ',');  ?></td>
                                    <td><?= "$" . number_format($expense['expense'], 0, '.', ',');  ?></td>
                                    <td><?= $expense['departament']; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" 
                                          data-id="<?= $expense['id']; ?>"
                                          data-year="<?= $expense['year']; ?>"
                                          data-month="<?= $expense['month']; ?>"
                                          data-income="<?= $expense['income']; ?>"
                                          data-expense="<?= $expense['expense']; ?>"
                                          data-department_id="<?= $expense['department_id']; ?>">
                                          Editar
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="<?= $expense['id']; ?>">
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
                    <form action="expense.php" method="POST">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="year" class="col-form-label">Año:</label>
                                <select id="year" name="year" class="form-select">
                                    <option selected>Seleccione el año</option>
                                    <?php
                                        for ($year = 2010; $year <= date('Y'); $year++) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="month" class="col-form-label">Mes:</label>
                                <select id="month" name="month" class="form-select">
                                    <option selected>Seleccione el mes</option>
                                    <?php foreach ($months as $key => $month): ?>
                                        <option value='<?=$key?>'><?= $month?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="income" class="col-form-label">Ingreso:</label>
                                <input type="number" class="form-control" id="income" name="income" required min="0" value="0">
                                
                            </div>
                            <div class="mb-3">
                                <label for="expense" class="col-form-label">Gastos:</label>
                                <input type="number" class="form-control" id="expense" name="expense" required>
                            </div>

                            <div class="mb-3">
                                <label for="department_id" class="col-form-label">Departamento:</label>
                                <select id="department_id" name="department_id" class="form-select">
                                    <option selected>Seleccione el departamento</option>
                                    <?php foreach ($departaments as $departament): ?>
                                        <option value='<?=$departament["id"]?>'><?= $departament['name']?></option>;
                                    <?php endforeach; ?>
                                </select>
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
                        <h5 class="modal-title" id="updateModalLabel">Modificar Gasto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="expense.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" id="idU" name="id">

                            <div class="mb-3">
                                <label for="yearU" class="col-form-label">Año:</label>
                                <select id="yearU" name="year" class="form-select">
                                    <option selected>Seleccione el año</option>
                                    <?php
                                        for ($year = 2010; $year <= date('Y'); $year++) {
                                            echo "<option value='$year'>$year</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="month" class="col-form-label">Mes:</label>
                                <select id="monthU" name="month" class="form-select">
                                    <option selected>Seleccione el mes</option>
                                    <?php foreach ($months as $key => $month): ?>
                                        <option value='<?=$key?>'><?= $month?></option>;
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="incomeU" class="col-form-label">Ingreso:</label>
                                <input type="number" class="form-control" id="incomeU" name="income" required min="0" value="0">
                                
                            </div>
                            <div class="mb-3">
                                <label for="expenseU" class="col-form-label">Gastos:</label>
                                <input type="number" class="form-control" id="expenseU" name="expense" required>
                            </div>

                            <div class="mb-3">
                                <label for="department_idU" class="col-form-label">Departamento:</label>
                                <select id="department_idU" name="department_id" class="form-select">
                                    <option selected>Seleccione el departamento</option>
                                    <?php foreach ($departaments as $departament): ?>
                                        <option value='<?=$departament["id"]?>'><?= $departament['name']?></option>;
                                    <?php endforeach; ?>
                                </select>
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
                        <h5 class="modal-title" id="deleteModalLabel">Eliminar Gasto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="expense.php" method="POST">
                        <div class="modal-body">
                            <p>¿Estás seguro de eliminar este gasto?</p>
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
        const year = this.getAttribute('data-year');
        const month = this.getAttribute('data-month');
        const income = this.getAttribute('data-income');
        const expense = this.getAttribute('data-expense');
        const department_id = this.getAttribute('data-department_id');
        
        document.getElementById('idU').value = id;
        document.getElementById('yearU').value = year;
        document.getElementById('monthU').value = month;
        document.getElementById('incomeU').value = income;
        document.getElementById('expenseU').value = expense;
        document.getElementById('department_idU').value = department_id;
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
