use mysql;
drop database if exists boulangerieTestBdd;
create database boulangerieTestBdd;
use boulangerieTestBdd;

create table TypeProduit
(
	codeTypeProduit int auto_increment not null,
	libelleTypeProduit varchar(50),
	primary key(codeTypeProduit)
)engine=innodb;

create table Produit
(
	codeProduit int auto_increment not null,
	libelleProduit varchar(50),
	codeTypeProduit int not null,
	prix numeric(5,2) not null,
	nbParts int not null,
	allergene tinyint,
	decongele tinyint,
	faitMaison tinyint,
	descriptionEtiquette varchar(500),
	primary key(codeProduit)
)engine=innodb;

create table Membres
(
	id int auto_increment not null,
	pseudo  varchar(255) not null,
	password varchar(255) not null,
	mail varchar(255) not null,
	dateInscription date not null ,
	idGroupe int not null,
	primary key(id)
)engine=innodb;

create table Groupes
(
	id int auto_increment not null,
	nom varchar(50) not null,
	primary key(id)
)engine=innodb;

create table Commander
(
	id int auto_increment not null,
	nom varchar(255) not null,
	prenom varchar(255) not null,
	adresse varchar(255) not null,
	cp int(5) not null,
	ville varchar(255) not null,
	mail varchar(255) not null,
	portable int(10) not null,
	quantite int(80) not null,
	codeProduit int not null,
	primary key(id)
)engine=innodb;


alter table Produit
add constraint fk_Produit_codeTypeProduit_TypeProduit
foreign key (codeTypeProduit)
references TypeProduit (codeTypeProduit);

alter table Commander
add constraint fk_Commander_codeProduit_Produit
foreign key (codeProduit)
references Produit (codeProduit);

alter table Membres
add constraint fk_Membres_id_Groupes
foreign key (idGroupe)
references Groupes (id);

insert into TypeProduit (libelleTypeProduit) values ('Pain');
insert into TypeProduit (libelleTypeProduit) values ('Patisseries');
insert into TypeProduit (libelleTypeProduit) values ('Sandwichs');
insert into TypeProduit (libelleTypeProduit) values ('Viennoiseries');
insert into TypeProduit (libelleTypeProduit) values ('Chocolats');

insert into Groupes values(1,'Administrateur');
insert into Groupes values(2,'Membre');