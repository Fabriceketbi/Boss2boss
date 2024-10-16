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

CREATE TABLE sub_category(
   id_sub_category INT AUTO_INCREMENT,
   name VARCHAR(150) NOT NULL,
   PRIMARY KEY(id_sub_category)
);

CREATE TABLE admin(
   id_admin INT AUTO_INCREMENT,
   admin_name VARCHAR(150) NOT NULL,
   password VARCHAR(150) NOT NULL,
   PRIMARY KEY(id_admin),
   UNIQUE(admin_name),
   UNIQUE(password)
);

CREATE TABLE video(
   id_video INT AUTO_INCREMENT,
   link VARCHAR(255) NOT NULL,
   PRIMARY KEY(id_video)
);

CREATE TABLE formation(
   id_formation INT AUTO_INCREMENT,
   name VARCHAR(150) NOT NULL,
   subtitle VARCHAR(250),
   description VARCHAR(500),
   localisation VARCHAR(150) NOT NULL,
   specification VARCHAR(255),
   date1_ DATE,
   date2_ DATE,
   date3_ DATE,
   time_ VARCHAR(150),
   nb_participants SMALLINT,
   price INT NOT NULL,
   reduce_price INT,
   id_sub_category INT NOT NULL,
   id_category INT NOT NULL,
   id_host INT NOT NULL,
   PRIMARY KEY(id_formation),
   FOREIGN KEY(id_sub_category) REFERENCES sub_category(id_sub_category),
   FOREIGN KEY(id_category) REFERENCES category(id_category),
   FOREIGN KEY(id_host) REFERENCES host(id_host)
);
