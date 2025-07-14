-- Insertion des membres
INSERT INTO Ex_membre (nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
('Lova', '1990-05-12', 'F', 'alice.martin@email.com', 'Paris', 'mdp1', 'alice.jpg'),
('Bryan', '1985-08-23', 'M', 'bob.dupont@email.com', 'Lyon', 'mdp2', 'bob.jpg'),
('Hasina', '1992-11-03', 'F', 'claire.dubois@email.com', 'Marseille', 'mdp3', 'claire.jpg'),
('Dahmany', '1988-02-17', 'M', 'david.leroy@email.com', 'Toulouse', 'mdp4', 'david.jpg');

-- Insertion des catégories
INSERT INTO Ex_categorie_objet (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

-- Insertion des objets (10 par membre, répartis sur les catégories)
INSERT INTO Ex_objet (nom_objet, id_categorie, id_membre) VALUES
('Sèche-cheveux', 1, 1),
('Lisseur', 1, 1),
('Perceuse', 2, 1),
('Tournevis', 2, 1),
('Clé à molette', 3, 1),
('Mixeur', 4, 1),
('Batteur', 4, 1),
('Pinceau maquillage', 1, 1),
('Scie sauteuse', 2, 1),
('Casserole', 4, 1),

('Tondeuse', 1, 2),
('Marteau', 2, 2),
('Tournevis plat', 2, 2),
('Clé plate', 3, 2),
('Robot pâtissier', 4, 2),
('Friteuse', 4, 2),
('Ponceuse', 2, 2),
('Fer à boucler', 1, 2),
('Cafetière', 4, 2),
('Pistolet à colle', 2, 2),

('Brosse à cheveux', 1, 3),
('Perceuse-visseuse', 2, 3),
('Clé dynamométrique', 3, 3),
('Grille-pain', 4, 3),
('Blender', 4, 3),
('Scie circulaire', 2, 3),
('Lime à ongles', 1, 3),
('Tournevis cruciforme', 2, 3),
('Cocotte-minute', 4, 3),
('Pince multiprise', 3, 3),

('Rasoir électrique', 1, 4),
('Perforateur', 2, 4),
('Clé Allen', 3, 4),
('Gaufrier', 4, 4),
('Bouilloire', 4, 4),
('Ponceuse orbitale', 2, 4),
('Brosse lissante', 1, 4),
('Scie égoïne', 2, 4),
('Plancha', 4, 4),
('Clé à pipe', 3, 4);

-- Insertion des images pour quelques objets (exemple)
INSERT INTO Ex_images_objet (id_objet, nom_image) VALUES
(1, 'seche_cheveux.jpg'),
(2, 'lisseur.jpg'),
(11, 'tondeuse.jpg'),
(21, 'brosse_cheveux.jpg'),
(31, 'rasoir_electrique.jpg');

-- Insertion des emprunts (10 exemples)
INSERT INTO Ex_emprunt (id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2024-05-01', '2024-05-10'),
(5, 3, '2024-05-02', '2024-05-12'),
(12, 1, '2024-05-03', '2024-05-13'),
(15, 4, '2024-05-04', NULL),
(22, 2, '2024-05-05', NULL),
(28, 3, '2024-05-06', '2024-05-16'),
(33, 1, '2024-05-07', NULL),
(36, 4, '2024-05-08', '2024-05-18'),
(39, 2, '2024-05-09', NULL),
(40, 1, '2024-05-10', NULL);
