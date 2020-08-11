CREATE DATABASE IF NOT EXISTS animals;
USE animals;

CREATE TABLE IF NOT EXISTS users(
id int(255) auto_increment not null,
role varchar(100),
name varchar(250),
surname varchar(255),
email varchar(255),
password varchar(255),
created_at datetime,
CONSTRAINT PK_USERS PRIMARY KEY(id) 	
)Engine=InnoDb;


INSERT INTO users VALUES(null,'user','Pedro','Valle','pedro@pedro.com','pass',CURDATE());
INSERT INTO users VALUES(null,'user','Miriam','Glez','miriam@miriam.com','pass',CURDATE());
INSERT INTO users VALUES(null,'user','Santos','Gomez','santos@santos.com','pass',CURDATE());



CREATE TABLE IF NOT EXISTS tasks(
id int(255) auto_increment not null,
user_id int(255) not null,
title varchar(255),
content varchar(255),
priority varchar(100),
date datetime,
deadline datetime,
created_at datetime,
CONSTRAINT PK_TASKS PRIMARY KEY(id),
CONSTRAINT FK_TASKS_USERS FOREIGN KEY(user_id) REFERENCES users(id)
)Engine=InnoDb;






CREATE TABLE IF NOT EXISTS owners(
id int(255) auto_increment not null,
name varchar(250),
surname varchar(250),
telephone varchar(250),
address varchar(250),
email varchar(255),
created_at datetime,
CONSTRAINT PK_OWNERS PRIMARY KEY(id)		
)Engine=InnoDb;


INSERT INTO owners VALUES(null,'Alexander','Meitinger','017648767754','Knorrstr 123','alex@alex.com',CURDATE());
INSERT INTO owners VALUES(null,'Karl','Jones','017648767754','Kobek 123','Jones@Jones.com',CURDATE());
INSERT INTO owners VALUES(null,'Margarette','Meitinger','017648767754','Knorrstr 12','Margarette@meit.com',CURDATE());


CREATE TABLE IF NOT EXISTS animals(
id int(255) auto_increment  not null,
owner_id int(255) not null,
name varchar(250),
type varchar(250),
birth datetime,
created_at datetime,
CONSTRAINT PK_ANIMALS PRIMARY KEY(id),
CONSTRAINT FK_ANIMALS_OWNERS FOREIGN KEY(owner_id) REFERENCES owners(id)	
)Engine=InnoDb;

INSERT INTO animals VALUES(null,1,'Toby','perro Pastor Aleman','2018-03-12',CURDATE());
INSERT INTO animals VALUES(null,2,'Rita','Gato comun gris','2015-03-12',CURDATE());
INSERT INTO animals VALUES(null,3,'Sira','perro Pastor Belga','2014-12-01',CURDATE());


CREATE TABLE IF NOT EXISTS treatements(
id int(255) auto_increment not null,
user_id int(255) not null,
animal_id int(255) not null,
title varchar(255),
begin datetime,
end datetime,
comments text,
created_at datetime,
CONSTRAINT PK_TREATEMENTS PRIMARY KEY(id),
CONSTRAINT FK_TREATEMENTS_USERS FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT FK_TREATEMENTS_ANIMALS FOREIGN KEY(animal_id) REFERENCES animals(id)
)Engine=InnoDb;


INSERT INTO treatements VALUES(null,1,1,'cortar garras delanteras','2020-05-15','2020-05-16','nada',CURDATE());