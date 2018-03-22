use mysql;
drop database if exists boulangerie2;
create database boulangerie2;
use boulangerie2;

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
	composition varchar(500),
	photo varchar(50),
	codeTypeProduit int not null,
	primary key(codeProduit)
)engine=innodb;

create table Etape
(
	codeEtape int auto_increment not null,
	libelleEtape varchar(50),
	primary key(codeEtape)
)engine=innodb;

create table Declinaison
(
	codeProduit int not null,
	nbParts int not null,
	prix numeric(5,2) not null,
	etiquette varchar(50)
)engine=innodb;

create table Destination
(
	codeProduit int not null,
	codeEtape int not null
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
	quantite int(10) not null,
	primary key(id)
)engine=innodb;



alter table Declinaison
add constraint pk_Declinaison
primary key (codeProduit, nbParts);

alter table Destination
add constraint pk_Destination
primary key (codeProduit, codeEtape);

alter table Produit
add constraint fk_Produit_codeTypeProduit_TypeProduit
foreign key (codeTypeProduit)
references TypeProduit (codeTypeProduit);

alter table Declinaison
add constraint fk_Declinaison_codeProduit_Produit
foreign key (codeProduit)
references Produit (codeProduit);

alter table Destination
add constraint fk_Destination_codeProduit_Produit
foreign key (codeProduit)
references Produit (codeProduit);

alter table Destination
add constraint fk_Destination_codeEtape_Etape
foreign key (codeEtape)
references Etape (codeEtape);

alter table Membres
add constraint fk_Membres_id_Groupes
foreign key (idGroupe)
references Groupes (id);

insert into TypeProduit (libelleTypeProduit) values ('Pain');
insert into TypeProduit (libelleTypeProduit) values ('Patisseries');
insert into TypeProduit (libelleTypeProduit) values ('Viennoiseries');

insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Baguette', ' ', '', 0001);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Tradition', ' ', '', 0001);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Mille-feuilles', ' ', '', 0002);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Religieuse', ' ', '', 0002);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Salambo', ' ', '', 0002);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Foret Noire', ' ', '', 0002);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Croissant', ' ', '', 0003);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Pain au chocolat', ' ', '', 0003);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Chausson aux pommes', ' ', '', 0003);
insert into Produit (libelleProduit,composition,photo,codeTypeProduit) values ('Pain aux raisins', ' ', '', 0003);

insert into Etape (libelleEtape) values ('Apéritif');
insert into Etape (libelleEtape) values ('Plat');
insert into Etape (libelleEtape) values ('Dessert');
insert into Etape (libelleEtape) values ('Café');

insert into Declinaison values (0001, 1, 0.90, ' ');
insert into Declinaison values (0002, 1, 1.00, ' ');
insert into Declinaison values (0003, 1, 1.15, ' ');
insert into Declinaison values (0004, 1, 1.60, ' ');
insert into Declinaison values (0005, 1, 1.70, ' ');
insert into Declinaison values (0006, 1, 1.50, ' ');
insert into Declinaison values (0007, 1, 1.15, ' ');
insert into Declinaison values (0008, 1, 1.15, ' ');
insert into Declinaison values (0009, 1, 1.50, ' ');
insert into Declinaison values (0010, 1, 1.50, ' ');

insert into Destination values(0001, 0001);
insert into Destination values(0001, 0002);
insert into Destination values(0001, 0003);
insert into Destination values(0001, 0004);
insert into Destination values(0002, 0001);
insert into Destination values(0002, 0002);
insert into Destination values(0002, 0003);
insert into Destination values(0002, 0004);
insert into Destination values(0003, 0003);
insert into Destination values(0003, 0004);
insert into Destination values(0004, 0003);
insert into Destination values(0004, 0004);
insert into Destination values(0005, 0003);
insert into Destination values(0005, 0004);
insert into Destination values(0006, 0003);
insert into Destination values(0006, 0004);
insert into Destination values(0007, 0003);
insert into Destination values(0007, 0004);
insert into Destination values(0008, 0003);
insert into Destination values(0008, 0004);
insert into Destination values(0009, 0003);
insert into Destination values(0009, 0004);
insert into Destination values(0010, 0003);
insert into Destination values(0010, 0004);

insert into Groupes values(1,'Administrateur');
insert into Groupes values(2,'Membre');