-- Listado de todos los datos de los empleados del departamento “Ti” 
SELECT e.id, e.first_name, e.last_name, e.age, g.name genero, d.name departamento, e.salary  
FROM employees e
INNER JOIN departments d ON e.department_id = d.id
INNER JOIN genders g ON e.gender_id = g.id
WHERE d.name = 'ti'

-- Listado de datos del empleado con mayor salario 
SELECT e.id, e.first_name, e.last_name, e.age, g.name genero, d.name departamento, e.salary 
FROM employees e
INNER JOIN departments d ON e.department_id = d.id
INNER JOIN genders g ON e.gender_id = g.id
WHERE e.salary = (SELECT MAX(salary) FROM employees)

-- Cantidad de empleados con salarios menor a 1,500.000 
SELECT COUNT(*) AS cantidad
FROM employees e
WHERE e.salary < 1500000;


-- Listados de los 3 departamentos que más gastos producen
SELECT d.id, d.name, SUM(e.expense) AS gasto
FROM expenses e
INNER JOIN departments d ON e.department_id = d.id
GROUP BY d.id, d.name
ORDER BY gasto DESC
LIMIT 3;