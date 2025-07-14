CREATE TABLE Ex_membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    date_naissance DATE,
    genre VARCHAR(10),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(255),
    image_profil VARCHAR(255)
);

CREATE TABLE Ex_categorie_objet (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100)
);

CREATE TABLE Ex_objet (
    id_objet INT AUTO_INCREMENT PRIMARY KEY,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES Ex_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES Ex_membre(id_membre)
);

CREATE TABLE Ex_images_objet (
    id_image INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    nom_image VARCHAR(255),
    is_principale TINYINT(1) DEFAULT 0,
    FOREIGN KEY (id_objet) REFERENCES Ex_objet(id_objet)
);

CREATE TABLE Ex_emprunt (
    id_emprunt INT AUTO_INCREMENT PRIMARY KEY,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES Ex_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES Ex_membre(id_membre)
);
