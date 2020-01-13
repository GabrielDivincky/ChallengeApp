

# CREAR TABLA #

CREATE TABLE medicos (
id      int(30) auto_increment not null,
nombre  varchar(100) not null,
apellido varchar(100) not null,
obra_social varchar(100) not null,
especialidad varchar(100) not null,
direccion varchar(100) not null,
barrio varchar(100) not null,
-- latitud varchar(50) not null,
-- longitud varchar(50) not null,
CONSTRAINT pk_medicos PRIMARY KEY(id)

); 


# INSERTAR DATOS A LA TABLA #

INSERT INTO medicos VALUES(null, "Magali", "Cortese", "COIE", "Odontología", "3 de Febrero 1487", "Rosario");
INSERT INTO medicos VALUES(null, "Claudio", "Vergara", "callao 634", "Consultorio Privado");
INSERT INTO medicos VALUES(null, "Ivan", "Szittyay", "3 de Febrero 1487", "COIE");
INSERT INTO medicos VALUES(null, "Martin", "Pomilio", "moreno 1332", "Consultorio Privado");
INSERT INTO medicos VALUES(null, "Maira", "Ibañez", "San Martín 1339", "COIE");
INSERT INTO medicos VALUES(null, "Coral", "Ceresa", "Paraguay 1227", "COIE");
INSERT INTO medicos VALUES(null, "Leandro", "Milito", "3 de Febrero 1487", "COIE");
