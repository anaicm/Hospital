use hospital;
select* from usuario;
select*from personal;
SELECT familiar.Nombre, familiar.Apellido
        FROM familiar
        JOIN usuario ON usuario.idUsuario = familiar.idFamiliar
        WHERE usuario.Dni = '77777777L';
        
SELECT f.Nombre, f.Apellido
FROM usuario u
JOIN familiar f ON u.idUsuario = f.idUsuario
WHERE u.Dni = '77777777L';


SELECT familiar.Nombre, familiar.Apellido
FROM usuario 
JOIN familiar  ON usuario.idUsuario = familiar.idUsuario
WHERE usuario.Dni = '77777777L';

SELECT f.Nombre AS 'Nombre Familiar', f.Apellido AS 'Apellido Familiar', c.Hora, c.Informe, p.Nombre AS 'Nombre Personal', d.Nombre AS 'Nombre Departamento', ct.Nombre AS 'Nombre Centro'
FROM usuario u
JOIN familiar f ON u.idUsuario = f.idUsuario
JOIN cita c ON u.idUsuario = c.idUsuario
JOIN personal p ON c.idPersonal = p.idPersonal
JOIN departamento_personal dp ON p.idPersonal = dp.idPersonal
JOIN departamento d ON dp.idDepartamento = d.idDepartamento
JOIN centro_departamento cd ON d.idDepartamento = cd.idDepartamento
JOIN centro ct ON cd.idCentro = ct.idCentro
WHERE u.Dni = '77777777L';