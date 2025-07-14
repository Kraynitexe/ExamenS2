CREATE VIEW vue_objets_emprunts AS
SELECT 
    o.id_objet,
    o.nom_objet,
    c.nom_categorie,
    e.date_emprunt
FROM Ex_objet o
JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie
LEFT JOIN Ex_emprunt e ON o.id_objet = e.id_objet;

CREATE VIEW vue_objets_disponibles AS
SELECT 
    o.id_objet,
    o.nom_objet,
    c.nom_categorie
FROM Ex_objet o
JOIN Ex_categorie_objet c ON o.id_categorie = c.id_categorie
WHERE o.id_objet NOT IN (
    SELECT id_objet FROM Ex_emprunt WHERE date_retour IS NULL
);
