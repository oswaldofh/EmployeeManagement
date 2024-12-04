<?php 
  error_reporting(E_ALL ^ E_NOTICE);
  session_start();
  include("../controller/ReportController.php");

  $controller = new ReportController();
  $employeesTi = $controller->getEmployeeTi();
  $maxSalary = $controller->getEmployeeMaxSalary();
  $expenses = $controller->getDepartamentMaxExpense();
  $salaryMinior = $controller->getCantEmployeeSalaryMinor();
  
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
  .accordion-button{
    font-weight: bold;
  }
  .card-title {
    font-weight: bold;
    text-align: center;
    margin-bottom: .5rem;
  }
</style>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Report</title>
    </head>
    <body>
        <div class="container">
          <h3 class="tittle-table">Reportes</h3>

          <div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title"><?= $salaryMinior['cantidad'] ?></h5>
              <h6 class="card-subtitle mb-2 text-muted">Empleados con salarios menor a $1,500.000</h6>
            </div>
          </div>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Empleados departamento de Ti
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Salario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($employeesTi) && is_array($employeesTi) && count($employeesTi) > 0): ?>
                                <?php foreach ($employeesTi as $employee): ?>
                                    <tr>
                                      <td><?= $employee['id']; ?></td>
                                      <td><?= $employee['first_name']; ?></td>
                                      <td><?= $employee['last_name']; ?></td>
                                      <td><?= $employee['age']; ?></td>
                                      <td><?= $employee['genero']; ?></td>
                                      <td><?= $employee['departamento']; ?></td>
                                      <td><?= "$" . number_format($employee['salary'], 0, '.', ',');  ?></td>
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
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Empleado con mayor salario
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nombres</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Edad</th>
                                <th scope="col">Genero</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Salario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($maxSalary)): ?>
                                    <tr>
                                      <td><?= $maxSalary['id']; ?></td>
                                      <td><?= $maxSalary['first_name']; ?></td>
                                      <td><?= $maxSalary['last_name']; ?></td>
                                      <td><?= $maxSalary['age']; ?></td>
                                      <td><?= $maxSalary['genero']; ?></td>
                                      <td><?= $maxSalary['departamento']; ?></td>
                                      <td><?= "$" . number_format($maxSalary['salary'], 0, '.', ',');  ?></td>
                                    </tr>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">No hay generos registrados.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Tres departamentos que más gastos producen
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Departamento</th>
                                <th scope="col">Gasto</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($expenses) && is_array($expenses) && count($expenses) > 0): ?>
                                <?php foreach ($expenses as $expense): ?>
                                    <tr>
                                      <td><?= $expense['id']; ?></td>
                                      <td><?= $expense['name']; ?></td>
                                      <td><?= "$" . number_format($expense['gasto'], 0, '.', ',');  ?></td>
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
              </div>
          </div>
        </div>

    </body>
</html>

