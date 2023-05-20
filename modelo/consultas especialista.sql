use hospital;

alter table personal add Dni varchar(9) not null;

select * from personal
select * from usuario
/*Obtengo el idPersonal de la tabla personal para buscar en la tabla citas*/
select personal.idPersonal from personal
where personal.Dni like '77356221H%';
/*Obtengo el usuario con la cita */
select usuario.Nombre, usuario.Apellido, usuario.Dni, cita.Hora from usuario
inner join cita on cita.idUsuario=usuario.idUsuario 
where cita.idPersonal=6 and DATE (cita.Hora) = '2023-05-17'