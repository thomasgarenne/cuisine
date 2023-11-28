-- Création de la base de données
CREATE DATABASE cook;

-- Table pour les utilisateurs
CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    role JSON,
    avatar VARCHAR(255) NULL,
);

-- Table pour les catégories de recettes
CREATE TABLE Categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT NULL,
    parentId INT NULL,
    FOREIGN KEY (parentId) REFERENCES Categories(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table pour les recettes
CREATE TABLE Recette (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    instructions TEXT NOT NULL,
    timePreparation INT NOT NULL,
    timeCook INT NOT NULL,
    createdAt DATE NOT NULL,
    updatedAt Date NOT NULL,
    categoriesId INT NOT NULL,
    FOREIGN KEY (categoriesId) REFERENCES Categories(id),
    authorId INT NOT NULL,
    FOREIGN KEY (authorId) REFERENCES Users(id)
);

-- Table pour les images
CREATE TABLE Image (
    id INT PRIMARY KEY AUTO_INCREMENT,
    filename VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    recetteId INT NOT NULL,
    FOREIGN KEY (recetteId) REFERENCES Recette(id)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- Table pour les commentaires
CREATE TABLE Commentaire (
    commentaire TEXT NOT NULL,
    createdAt DATETIME,
    notes INT NOT NULL,
    userId INT NOT NULL,
    FOREIGN KEY (userId) REFERENCES Users(id),
    recetteId INT NOT NULL,
    FOREIGN KEY (recetteId) REFERENCES Recette(id)
        ON DELETE CASCADE,
    PRIMARY KEY (userId, recetteId)
);

-- Table pour les ingrédients
CREATE TABLE Ingredient (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE
);

-- Table de liaison pour les recettes et les ingrédients
CREATE TABLE RecetteIngredient (
    recetteId INT,
    ingredientId INT,
    quantite DOUBLE,
    uniteDeMesure VARCHAR(50),
    PRIMARY KEY (recetteId, ingredientId),
    FOREIGN KEY (recetteId) REFERENCES Recette(id),
        ON DELETE CASCADE,
    FOREIGN KEY (ingredientId) REFERENCES Ingredient(id),
        ON DELETE CASCADE
);

CREATE TABLE likes (
    recetteId INT,
    FOREIGN KEY (recetteId) REFERENCES recette(id)
        ON DELETE CASCADE,
    userId INT,
    FOREIGN KEY (userId) REFERENCES users(id)
        ON DELETE CASCADE,
    PRIMARY KEY (userId, recetteId)
);
