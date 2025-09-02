DROP DATABASE IF EXISTS bddhackathon;

CREATE DATABASE IF NOT EXISTS bddhackathon;
USE bddhackathon;
# -----------------------------------------------------------------------------
#       TABLE : USER
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS USER
 (
   ID INTEGER NOT NULL  ,
   NOM VARCHAR(40) NULL  ,
   PRENOM VARCHAR(30) NULL  ,
   MAIL VARCHAR(60) NULL  ,
   TEL INTEGER NULL  ,
   DATE_NAISSANCE DATE NULL  ,
   LIEN_PORTE_FOLIO VARCHAR(128) NULL  ,
   LOGIN VARCHAR(35) NULL  ,
   MDP VARCHAR(40) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : CONFERENCE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS CONFERENCE
 (
   ID INTEGER NOT NULL  ,
   THEME VARCHAR(40) NULL  ,
   INTERVENENT VARCHAR(30) NULL  ,
   LIBELLE VARCHAR(128) NULL  ,
   DATE DATE NULL  ,
   HEURE TIME NULL  ,
   DUREE TIME NULL  ,
   SALLE VARCHAR(40) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : INITIATION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INITIATION
 (
   ID INTEGER NOT NULL  ,
   NB_PARTICIPANT INTEGER NULL  ,
   LIBELLE VARCHAR(128) NULL  ,
   DATE DATE NULL  ,
   HEURE TIME NULL  ,
   DUREE TIME NULL  ,
   SALLE VARCHAR(40) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : EVENEMENT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS EVENEMENT
 (
   ID INTEGER NOT NULL  ,
   ID_CONCERNER INTEGER NOT NULL  ,
   LIBELLE VARCHAR(128) NULL  ,
   DATE DATE NULL  ,
   HEURE TIME NULL  ,
   DUREE TIME NULL  ,
   SALLE VARCHAR(40) NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE EVENEMENT
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_EVENEMENT_HACKATHON
     ON EVENEMENT (ID_CONCERNER ASC);

# -----------------------------------------------------------------------------
#       TABLE : HACKATHON
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS HACKATHON
 (
   ID INTEGER NOT NULL  ,
   DATE_DEBUT DATE NULL  ,
   HEURE_DEBUT TIME NULL  ,
   DATE_FIN DATE NULL  ,
   HEURE_FIN TIME NULL  ,
   SALLE VARCHAR(70) NULL  ,
   RUE VARCHAR(128) NULL  ,
   VILLE VARCHAR(128) NULL  ,
   CP VARCHAR(5) NULL  ,
   THEME VARCHAR(40) NULL  ,
   DESCRIPTION VARCHAR(128) NULL  ,
   IMAGE VARCHAR(254) NULL  ,
   DATELIMITE DATE NULL  ,
   NB_PLACE INTEGER NULL  
   , PRIMARY KEY (ID) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : INSCRIT
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INSCRIT
 (
   ID_INSCRIPTION INTEGER NOT NULL  ,
   NOM_INC VARCHAR(40) NULL  ,
   PRENOM_INC VARCHAR(40) NULL  ,
   MAIL_INC VARCHAR(128) NULL  
   , PRIMARY KEY (ID_INSCRIPTION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       TABLE : INSCRIPTION
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS INSCRIPTION
 (
   ID INTEGER NOT NULL  ,
   ID_1 INTEGER NOT NULL  ,
   NUMINSCRIPTION CHAR(32) NOT NULL  ,
   DATE_INSCRIPTION DATE NULL  
   , PRIMARY KEY (ID,ID_1,NUMINSCRIPTION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE INSCRIPTION
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_INSCRIPTION_USER
     ON INSCRIPTION (ID ASC);

CREATE  INDEX I_FK_INSCRIPTION_HACKATHON
     ON INSCRIPTION (ID_1 ASC);

# -----------------------------------------------------------------------------
#       TABLE : ETRE
# -----------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS ETRE
 (
   ID INTEGER NOT NULL  ,
   ID_INSCRIPTION INTEGER NOT NULL  
   , PRIMARY KEY (ID,ID_INSCRIPTION) 
 ) 
 comment = "";

# -----------------------------------------------------------------------------
#       INDEX DE LA TABLE ETRE
# -----------------------------------------------------------------------------


CREATE  INDEX I_FK_ETRE_INITIATION
     ON ETRE (ID ASC);

CREATE  INDEX I_FK_ETRE_INSCRIT
     ON ETRE (ID_INSCRIPTION ASC);


# -----------------------------------------------------------------------------
#       CREATION DES REFERENCES DE TABLE
# -----------------------------------------------------------------------------


ALTER TABLE CONFERENCE 
  ADD FOREIGN KEY FK_CONFERENCE_EVENEMENT (ID)
      REFERENCES EVENEMENT (ID) ;


ALTER TABLE INITIATION 
  ADD FOREIGN KEY FK_INITIATION_EVENEMENT (ID)
      REFERENCES EVENEMENT (ID) ;


ALTER TABLE EVENEMENT 
  ADD FOREIGN KEY FK_EVENEMENT_HACKATHON (ID_CONCERNER)
      REFERENCES HACKATHON (ID) ;


ALTER TABLE INSCRIPTION 
  ADD FOREIGN KEY FK_INSCRIPTION_USER (ID)
      REFERENCES USER (ID) ;


ALTER TABLE INSCRIPTION 
  ADD FOREIGN KEY FK_INSCRIPTION_HACKATHON (ID_1)
      REFERENCES HACKATHON (ID) ;


ALTER TABLE ETRE 
  ADD FOREIGN KEY FK_ETRE_INITIATION (ID)
      REFERENCES INITIATION (ID) ;


ALTER TABLE ETRE 
  ADD FOREIGN KEY FK_ETRE_INSCRIT (ID_INSCRIPTION)
      REFERENCES INSCRIT (ID_INSCRIPTION) ;

INSERT INTO `HACKATHON` (`ID`, `DATE_DEBUT`, `HEURE_DEBUT`, `DATE_FIN`, `HEURE_FIN`, `SALLE`, `RUE`, `VILLE`, `CP`, `THEME`, `DESCRIPTION`, `IMAGE`,`DATE_LIMITE`, `NB_PLACES`) VALUES
(1, '2021-10-15', '18:00:00', '2021-10-17', '18:00:00', 'Talent Garden', '100 Avenue Willy Brandt', 'Lille', '59777', 'La nuit du code citoyen', 'La Nuit du Code Citoyen est un hackathon open source qui a pour but d\’accélérer des projets numériques d\’intérêt général sur le thème Transitions.','https://cdn.pixabay.com/photo/2020/05/30/17/18/wind-power-plant-5239642__480.jpg', '2021-09-20', 50),
(2, '2021-12-08', '09:30:00', '2021-12-22', '18:00:00', 'Loco Numérique', '123 Bd Louis Blanc', 'La Roche Sur Yon', '85000', 'Changement climatique et la protection de la biodiversité','Un hackathon pour mieux connaître et protéger la biodiversité', 'https://cdn.pixabay.com/photo/2020/03/19/21/25/laptop-4948837__480.jpg','2021-11-08', 20),
(3, '2022-01-27', '18:30:00', '2022-01-30', '20:30:00', 'Lelaptop: atelier modulable', '7 rue Geoffroy Langevin', 'Paris', '75004', 'DefInSpace', '24H pour imaginer la défense spatiale de demain', 'https://media.istockphoto.com/photos/laser-cannon-incapacitates-enemy-satellite-in-space-picture-id1265211446?b=1&k=20&m=1265211446&s=170667a&w=0&h=3oeJG_wzOus3Vn_08d61PpcEkTYFiiquxpghRTvcdWU=', '2021-12-28',40),
(4, '2022-03-19', '07:00:00', '2022-03-20', '23:30:00', 'Tour Franklin', '100-101 Terrasse Boieldieu', 'Puteaux', '92800', 'TadHack','Vous avez la fibre tech et l\'esprit innovateur? TADhack vous donnera les clefs pour une expérience unique, travaillez avec des experts de la voice tech et de l\'IA', 'https://lc.cx/F6JK1Y', '2022-02-26', 10),
(5, '2023-06-28', '13:05:03', '2023-06-30', '14:30:45', 'Euratechnologies', '165 Avenue de Bretagne ', 'Lille', '59000', 'Hackathon Summer Space Festival','Le summer Space' ,'https://cdn.pixabay.com/photo/2016/10/20/18/35/earth-1756274__340.jpg', '2023-05-12', 150),
(6, '2023-11-05', '08:00:00', '2023-11-06', '08:00:00', 'Le palace', '4 rue Voltaire', 'Nantes', '44000', 'InnovHathon','Nouvelle innovation', 'https://lc.cx/Gfce4J', '2023-10-05', 25),
(7, '2023-04-09', '17:50:30', '2023-04-11', '19:00:00', 'La Cantine', '11 Rue La Noue', 'Nantes', '44200', 'Hacking Health',' Un marathon d\'innovation en santé','https://cdn.pixabay.com/photo/2016/11/09/15/27/dna-1811955__340.jpg', '2022-03-09', 250);

insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (1, 'Ahern', 'Ramona', 'rahern0@bbc.co.uk', '6624681164', '6/21/2022', 'http://domainmarket.com/in/porttitor/pede.json?justo=platea&lacinia=dictumst&eget=maecenas&tincidunt=ut&eget=massa&tempus=quis&vel=augue&pede=luctus&morbi=tincidunt&porttitor=nulla&lorem=mollis&id=molestie&ligula=lorem&suspendisse=quisque&ornare=ut&consequat=erat&lectus=curabitur', 'rahern0', '3pZUnH');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (2, 'Sedman', 'Arv', 'asedman1@indiatimes.com', '3971331359', '9/8/2022', 'http://elpais.com/amet/lobortis/sapien.json?a=nonummy&libero=maecenas&nam=tincidunt&dui=lacus&proin=at&leo=velit&odio=vivamus&porttitor=vel&id=nulla&consequat=eget&in=eros&consequat=elementum&ut=pellentesque&nulla=quisque&sed=porta&accumsan=volutpat&felis=erat&ut=quisque&at=erat&dolor=eros&quis=viverra&odio=eget&consequat=congue&varius=eget&integer=semper&ac=rutrum&leo=nulla&pellentesque=nunc&ultrices=purus&mattis=phasellus&odio=in&donec=felis&vitae=donec&nisi=semper&nam=sapien&ultrices=a&libero=libero&non=nam&mattis=dui&pulvinar=proin&nulla=leo&pede=odio&ullamcorper=porttitor&augue=id&a=consequat&suscipit=in&nulla=consequat&elit=ut&ac=nulla&nulla=sed', 'asedman1', '4hl20CG');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (3, 'Rowesby', 'Shanda', 'srowesby2@reverbnation.com', '5831413435', '7/6/2022', 'https://bizjournals.com/nisi/vulputate/nonummy.aspx?nisi=pellentesque&volutpat=volutpat&eleifend=dui&donec=maecenas&ut=tristique&dolor=est&morbi=et&vel=tempus&lectus=semper&in=est&quam=quam&fringilla=pharetra&rhoncus=magna&mauris=ac&enim=consequat&leo=metus&rhoncus=sapien&sed=ut', 'srowesby2', '9InqBXLBf');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (4, 'Boyd', 'Daron', 'dboyd3@sitemeter.com', '4362822990', '5/18/2022', 'https://sohu.com/morbi.js?nullam=nibh&sit=in&amet=quis&turpis=justo&elementum=maecenas&ligula=rhoncus&vehicula=aliquam&consequat=lacus&morbi=morbi&a=quis&ipsum=tortor&integer=id&a=nulla&nibh=ultrices&in=aliquet&quis=maecenas&justo=leo&maecenas=odio&rhoncus=condimentum&aliquam=id&lacus=luctus&morbi=nec&quis=molestie&tortor=sed&id=justo&nulla=pellentesque&ultrices=viverra&aliquet=pede&maecenas=ac&leo=diam&odio=cras&condimentum=pellentesque&id=volutpat&luctus=dui&nec=maecenas&molestie=tristique&sed=est&justo=et&pellentesque=tempus&viverra=semper&pede=est&ac=quam&diam=pharetra&cras=magna&pellentesque=ac&volutpat=consequat&dui=metus&maecenas=sapien&tristique=ut&est=nunc&et=vestibulum&tempus=ante&semper=ipsum&est=primis&quam=in&pharetra=faucibus&magna=orci&ac=luctus&consequat=et&metus=ultrices&sapien=posuere&ut=cubilia&nunc=curae&vestibulum=mauris&ante=viverra&ipsum=diam&primis=vitae&in=quam&faucibus=suspendisse&orci=potenti&luctus=nullam&et=porttitor&ultrices=lacus&posuere=at&cubilia=turpis&curae=donec&mauris=posuere&viverra=metus&diam=vitae&vitae=ipsum&quam=aliquam&suspendisse=non&potenti=mauris&nullam=morbi&porttitor=non&lacus=lectus&at=aliquam&turpis=sit', 'dboyd3', 'BwN8UsuuwFg');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (5, 'Tarpey', 'Joyce', 'jtarpey4@163.com', '6854926357', '11/2/2022', 'https://nydailynews.com/venenatis/turpis/enim/blandit.json?ac=quis&diam=tortor&cras=id&pellentesque=nulla&volutpat=ultrices&dui=aliquet&maecenas=maecenas&tristique=leo&est=odio&et=condimentum&tempus=id&semper=luctus&est=nec&quam=molestie&pharetra=sed&magna=justo&ac=pellentesque&consequat=viverra&metus=pede&sapien=ac&ut=diam&nunc=cras&vestibulum=pellentesque&ante=volutpat&ipsum=dui&primis=maecenas&in=tristique&faucibus=est&orci=et&luctus=tempus&et=semper&ultrices=est&posuere=quam&cubilia=pharetra&curae=magna&mauris=ac&viverra=consequat&diam=metus&vitae=sapien&quam=ut&suspendisse=nunc&potenti=vestibulum&nullam=ante&porttitor=ipsum&lacus=primis&at=in&turpis=faucibus&donec=orci&posuere=luctus&metus=et&vitae=ultrices&ipsum=posuere&aliquam=cubilia&non=curae&mauris=mauris&morbi=viverra&non=diam&lectus=vitae&aliquam=quam&sit=suspendisse&amet=potenti&diam=nullam&in=porttitor&magna=lacus&bibendum=at&imperdiet=turpis&nullam=donec&orci=posuere&pede=metus&venenatis=vitae&non=ipsum&sodales=aliquam&sed=non&tincidunt=mauris&eu=morbi&felis=non&fusce=lectus&posuere=aliquam&felis=sit&sed=amet&lacus=diam&morbi=in&sem=magna&mauris=bibendum', 'jtarpey4', 'Ulc35ozrR');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (6, 'Kasper', 'Amata', 'akasper5@tripod.com', '7193236880', '7/19/2022', 'https://phoca.cz/at.json?odio=vivamus&consequat=vestibulum&varius=sagittis&integer=sapien&ac=cum&leo=sociis&pellentesque=natoque&ultrices=penatibus&mattis=et&odio=magnis&donec=dis&vitae=parturient&nisi=montes&nam=nascetur&ultrices=ridiculus&libero=mus&non=etiam&mattis=vel&pulvinar=augue', 'akasper5', '1MzOTPJj');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (7, 'Chattey', 'Joanna', 'jchattey6@cornell.edu', '9114121471', '9/30/2022', 'https://scribd.com/ac.png?sed=ligula&vestibulum=sit&sit=amet&amet=eleifend&cursus=pede&id=libero&turpis=quis&integer=orci&aliquet=nullam&massa=molestie&id=nibh&lobortis=in&convallis=lectus&tortor=pellentesque&risus=at&dapibus=nulla&augue=suspendisse&vel=potenti&accumsan=cras&tellus=in&nisi=purus&eu=eu&orci=magna&mauris=vulputate&lacinia=luctus&sapien=cum&quis=sociis&libero=natoque&nullam=penatibus&sit=et&amet=magnis&turpis=dis&elementum=parturient&ligula=montes&vehicula=nascetur&consequat=ridiculus&morbi=mus&a=vivamus&ipsum=vestibulum&integer=sagittis&a=sapien&nibh=cum&in=sociis&quis=natoque&justo=penatibus&maecenas=et&rhoncus=magnis&aliquam=dis&lacus=parturient&morbi=montes&quis=nascetur&tortor=ridiculus&id=mus&nulla=etiam&ultrices=vel&aliquet=augue&maecenas=vestibulum&leo=rutrum&odio=rutrum&condimentum=neque&id=aenean&luctus=auctor&nec=gravida', 'jchattey6', 'cEucu3bzT7Id');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (8, 'Aslet', 'Valle', 'vaslet7@elegantthemes.com', '8294819636', '10/28/2022', 'https://google.nl/donec/ut/mauris/eget.png?at=tortor&lorem=id&integer=nulla&tincidunt=ultrices&ante=aliquet&vel=maecenas&ipsum=leo&praesent=odio&blandit=condimentum&lacinia=id&erat=luctus&vestibulum=nec&sed=molestie&magna=sed&at=justo&nunc=pellentesque&commodo=viverra&placerat=pede&praesent=ac&blandit=diam&nam=cras&nulla=pellentesque&integer=volutpat&pede=dui&justo=maecenas&lacinia=tristique&eget=est&tincidunt=et&eget=tempus&tempus=semper&vel=est&pede=quam&morbi=pharetra&porttitor=magna&lorem=ac&id=consequat&ligula=metus&suspendisse=sapien&ornare=ut&consequat=nunc&lectus=vestibulum&in=ante&est=ipsum&risus=primis&auctor=in&sed=faucibus&tristique=orci&in=luctus&tempus=et&sit=ultrices&amet=posuere&sem=cubilia&fusce=curae&consequat=mauris&nulla=viverra&nisl=diam&nunc=vitae&nisl=quam&duis=suspendisse&bibendum=potenti&felis=nullam&sed=porttitor&interdum=lacus&venenatis=at&turpis=turpis&enim=donec&blandit=posuere&mi=metus&in=vitae&porttitor=ipsum&pede=aliquam&justo=non&eu=mauris&massa=morbi&donec=non&dapibus=lectus&duis=aliquam&at=sit&velit=amet&eu=diam&est=in&congue=magna&elementum=bibendum&in=imperdiet&hac=nullam&habitasse=orci&platea=pede&dictumst=venenatis&morbi=non&vestibulum=sodales&velit=sed&id=tincidunt&pretium=eu', 'vaslet7', 'NNmzJoHe');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (9, 'Fernyhough', 'Christian', 'cfernyhough8@blog.com', '7841162475', '4/7/2022', 'https://ifeng.com/vel/augue/vestibulum.png?donec=integer&odio=ac&justo=neque&sollicitudin=duis&ut=bibendum&suscipit=morbi&a=non&feugiat=quam&et=nec&eros=dui&vestibulum=luctus&ac=rutrum&est=nulla&lacinia=tellus&nisi=in&venenatis=sagittis&tristique=dui&fusce=vel&congue=nisl&diam=duis&id=ac&ornare=nibh&imperdiet=fusce&sapien=lacus&urna=purus&pretium=aliquet&nisl=at&ut=feugiat&volutpat=non&sapien=pretium&arcu=quis&sed=lectus&augue=suspendisse&aliquam=potenti&erat=in&volutpat=eleifend&in=quam&congue=a&etiam=odio&justo=in&etiam=hac&pretium=habitasse&iaculis=platea&justo=dictumst&in=maecenas&hac=ut&habitasse=massa&platea=quis&dictumst=augue&etiam=luctus&faucibus=tincidunt&cursus=nulla&urna=mollis&ut=molestie&tellus=lorem&nulla=quisque&ut=ut&erat=erat&id=curabitur&mauris=gravida&vulputate=nisi&elementum=at&nullam=nibh&varius=in&nulla=hac&facilisi=habitasse&cras=platea&non=dictumst&velit=aliquam&nec=augue&nisi=quam&vulputate=sollicitudin&nonummy=vitae&maecenas=consectetuer&tincidunt=eget', 'cfernyhough8', '0GJSXouA');
insert into USER (ID, NOM, PRENOM, MAIL, TEL, DATE_NAISSANCE, LIEN_PORTE_FOLIO, LOGIN, MDP) values (10, 'Tricker', 'Marysa', 'mtricker9@icq.com', '8423525348', '2/23/2022', 'http://google.it/bibendum/felis/sed/interdum/venenatis.js?eget=amet&massa=diam&tempor=in&convallis=magna&nulla=bibendum', 'mtricker9', 'rIGJ9MJ');

insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (1, 'Sherrington', 'Elladine', 'Labbey', '7/13/2022', '8:13 PM', '01:30:00', 'B301');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (2, 'Pavlenkov', 'Monica', 'Martin', '3/10/2022', '7:54 AM', '01:00:00', 'B302');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (3, 'Spacie', 'Lyman', 'Bugdell', '11/1/2022', '9:20 PM', '02:00:00', 'B303');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (4, 'Jirik', 'Binky', 'Stichall', '3/6/2022', '4:43 PM', '01:30:00', 'B301');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (5, 'Bury', 'Agnese', 'Loyd', '5/6/2022', '5:09 PM', '02:00:00', 'B302');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (6, 'Prangley', 'Ines', 'Shillinglaw', '5/21/2022', '5:04 AM', '01:00:00', 'B302');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (7, 'Casa', 'Urbanus', 'Rault', '8/27/2022', '7:37 AM', '02:30:00', 'B303');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (8, 'Yakunikov', 'Lyn', 'Connew', '10/1/2022', '7:24 AM', '01:030:00', 'B307');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (9, 'McGrouther', 'Henriette', 'Treadgall', '8/11/2022', '3:00 PM', '03:00:00', 'B307');
insert into CONFERENCE (ID, THEME, INTERVENENT, LIBELLE, DATE, HEURE, DUREE, SALLE) values (10, 'Triplet', 'Tersina', 'Warr', '8/24/2022', '1:12 AM', '02:30:00', 'B306');
