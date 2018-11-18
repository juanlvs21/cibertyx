create database cibertyx;

use cibertyx;

create table usuario(
	id int auto_increment not null primary key,
	usuario varchar(40) not null unique,
	contra varchar(40) not null,
	nombre varchar(50) not null,
	apellido varchar(50) not null,
	correo varchar(60) not null unique,
	admin int default 0 not null,
	estado int default 0 not null
);

create table solicitud(
	id int auto_increment not null primary key,
	codigo varchar (20) not null,
	nombre varchar(40) not null,
	correo varchar(60) not null,
	solicitud varchar(20) not null,
	descripcion varchar(5000) not null,
	nombreproyecto varchar(40) not null,
	url varchar(50),
	img varchar(50),
	fecha datetime not null,
	fechaterminado datetime,
	encargado varchar(40) default 'No Asignado',
	revisada int default 0,
	ejecucion int default 0,
	terminada int default 0,
	rechazada int default 0
);

create table loguser(
	id int auto_increment not null primary key,
	iduser int not null,
	fecha datetime not null,
	descripcion varchar(40) not null,
	foreign key (iduser) references usuario(id)
	on delete no action on update cascade
);

create table logsolic(
	id int auto_increment not null primary key,
	idsolic int not null,
	fecha datetime not null,
	foreign key (idsolic) references solicitud(id)
	on delete no action on update cascade
)

create table logrevisar(
	id int auto_increment not null primary key,
	idsolic int not null,
	iduser int not null,
	accion varchar(50) not null,
	fecha datetime not null,
	foreign key (idsolic) references solicitud(id)
	on delete no action on update cascade,
	foreign key (iduser) references usuario(id)
	on delete no action on update cascade
)