-- Script à utiliser pour initialiser la base de donnée du site "ter" réservation de salle

-- Suppression de la potentielle base de donnée
drop database if exists pjtter;
-- Création de la base
CREATE DATABASE pjtter;
USE pjtter;

-- Suppression des potentielles tables existantes
drop table if exists resaannulee;
drop table if exists reservation;
drop table if exists noteinvite;
drop table if exists notehote;
drop table if exists image;
drop table if exists diner;
drop table if exists utilisateur;
drop table if exists critere;
drop table if exists acces;

-- Création des tables
create table acces
(
	ida int not null primary key auto_increment,
	nom varchar(20) not null
);

create table critere
(
	idc int not null primary key auto_increment,
	nom varchar(20) not null
);

create table utilisateur
(
	idu int not null primary key auto_increment,
	email varchar(50) not null,
	mdp varchar(100) not null,
	nom varchar(50) not null,
	prenom varchar(50) not null,
	addresse varchar(50) not null,
	codePost varchar(5) not null,
	ville varchar(50) not null,
	telephone varchar(10) not null,
	solde float not null,
	constraint check_solde check (0<=solde),
	ida int not null,
	foreign key (ida) references acces
);

create table diner
(
	idd int not null primary key auto_increment,
	idu int not null,
	foreign key (idu) references utilisateur,
	nom varchar(120) not null,
	date date not null,
	lieu varchar(200) not null,
	description varchar(1500) not null,
	prix int not null,
	constraint check_prix check (0<=prix),
	capacite int not null,
	constraint check_capacite check (0<=capacite),
	idc int not null,
	foreign key (idc) references critere
);

create table image
(
	idi int not null primary key auto_increment,
	idd int not null,
	foreign key (idd) references diner,
	adresse varchar(1000) not null
);

create table notehote
(
	idn_Hot int not null primary key auto_increment,
	idd int not null,
	foreign key (idd) references diner,
	idu_Hot int not null,
	foreign key (idu_Hot) references utilisateur,
	idu_Inv int not null,
	foreign key (idu_Inv) references utilisateur,
	note float not null,
	constraint check_noteH check (0<=note and note<=5)
);

create table noteinvite
(
	idn_Inv int not null primary key auto_increment,
	idu_Inv int not null,
	foreign key (idu_Inv) references utilisateur,
	idu_Hot int not null,
	foreign key (idu_Hot) references utilisateur,
	note float not null,
	constraint check_noteI check (0<=note and note<=5),
	idd int not null,
	foreign key (idd) references diner
);

create table reservation
(
	idr int not null primary key auto_increment,
	idu int not null,
	foreign key (idu) references utilisateur,
	idd int not null,
	foreign key (idd) references diner,
	jour date not null
);

create table resaannulee
(
	idra int not null primary key auto_increment,
	idr int not null,
	foreign key (idr) references reservation,
	idu int not null,
	foreign key (idu) references utilisateur,
	idd int not null,
	foreign key (idd) references diner,
	jour date not null,
	dateAnnulation date not null,
	montantRembourse float not null,
	constraint check_montantRembourse check (0<=montantRembourse)
);

-- Insertion des niveaux d'accés	
insert into acces(nom) values ('Abonne');
insert into acces(nom) values ('Administrateur');

-- Insertion d'un compte administrateur
insert into utilisateur(ida,nom,prenom,addresse,codePost,ville,telephone,email,mdp,solde)
                values(2, 'Admin', 'Admin', 'Admin', 00000, 'Admin', '0000000000', 'admin@admin.fr','1c6d66a83a2a06ba491464cb9dced2c2832f3675', 0);
			