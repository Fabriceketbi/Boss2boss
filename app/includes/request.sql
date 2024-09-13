CREATE TABLE host(
   id_host INT AUTO_INCREMENT,
   name VARCHAR(100),
   PRIMARY KEY(id_host)
);

CREATE TABLE category(
   id_category INT AUTO_INCREMENT,
   name VARCHAR(150) NOT NULL,
   PRIMARY KEY(id_category)
);

CREATE TABLE formation(
   id_formation INT AUTO_INCREMENT,
   name VARCHAR(150) NOT NULL,
   subtitle VARCHAR(250),
   description VARCHAR(500),
   id_category INT NOT NULL,
   id_host INT NOT NULL,
   PRIMARY KEY(id_formation),
   FOREIGN KEY(id_category) REFERENCES category(id_category),
   FOREIGN KEY(id_host) REFERENCES host(id_host)
);

CREATE TABLE session(
   id_session INT AUTO_INCREMENT,
   date_ DATETIME NOT NULL,
   localisation VARCHAR(150) NOT NULL,
   id_formation INT NOT NULL,
   PRIMARY KEY(id_session),
   UNIQUE(id_formation),
   FOREIGN KEY(id_formation) REFERENCES formation(id_formation)
);
