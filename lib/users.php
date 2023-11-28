<?php

function verifyUserLoginPassword(PDO $pdo, string $email, string $password): array|bool
{
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $query->bindValue(":email", $email, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {
        return $user;
    } else {
        return false;
    }
}

function showUser(PDO $pdo, int $id)
{
    $query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);
}

function addUser(PDO $pdo, string $username, string $email, string $password): bool
{
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $role = '["ROLE_USER"]';

    $query = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (:username, :pass, :email, :role)");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':pass', $pass, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':role', $role, PDO::PARAM_STR);

    return $query->execute();
}

function addUsername(PDO $pdo, string $username, int $id): bool
{
    $query = $pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    return $query->execute();
}

function addAvatar(PDO $pdo, string $avatar, int $id): bool
{
    $query = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
    $query->bindParam(':avatar', $avatar, PDO::PARAM_STR);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    return $query->execute();
}
