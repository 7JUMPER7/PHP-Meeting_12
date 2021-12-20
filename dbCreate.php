<?php
    // include_once('functions.php');
    include_once('./models/Tools.php');
    
    $query1 = "CREATE TABLE Roles(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Role VARCHAR(20) NOT NULL UNIQUE
    );";
    $query2 = "CREATE TABLE Customers(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Email VARCHAR(60) NOT NULL UNIQUE,
        Password VARCHAR(20) NOT NULL,
        Discount DOUBLE DEFAULT 0,
        Avatar MEDIUMBLOB,
        RoleId INT NOT NULL DEFAULT 1,
        FOREIGN KEY (RoleId) REFERENCES Roles(Id) ON DELETE CASCADE
    );";
    $query3 = "CREATE TABLE Categories(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Category VARCHAR(50) NOT NULL
    );";
    $query4 = "CREATE TABLE Goods(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        Good VARCHAR(40) NOT NULL,
        CategoryId INT,
        Stars INT,
        Price DOUBLE,
        Description TEXT,
        FOREIGN KEY (CategoryId) REFERENCES Categories(Id) ON DELETE SET NULL
    );";
    $query5 = "CREATE TABLE Images(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GoodId INT,
        Path VARCHAR(300),
        FOREIGN KEY (GoodId) REFERENCES Goods(Id) ON DELETE SET NULL
    );";
    $query6 = "CREATE TABLE Sales(
        Id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        GoodId INT,
        CustomerId INT,
    	Count INT NOT NULL,
    	TotalPrice DOUBLE NOT NULL,
        FOREIGN KEY (GoodId) REFERENCES Goods(Id) ON DELETE SET NULL,
        FOREIGN KEY (CustomerId) REFERENCES Customers(Id) ON DELETE SET NULL
    );";

    $query7 = "INSERT INTO Roles (Role) VALUES('Customer');";
    $query8 = "INSERT INTO Roles (Role) VALUES('Admin');";

    $pdo = Tools::connect('arsenii_shop_db', 'localhost', 'root', 'root');
    if($pdo) {
        Tools::createDb($pdo, $query1, $query2, $query3, $query4, $query5, $query6, $query7, $query8);
    }
?>