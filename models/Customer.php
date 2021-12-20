<?php
    include_once('./Tools.php');

    class Customer {
        protected $Id;
        protected $Email;
        protected $Password;
        protected $Discount;
        protected $Avatar;
        protected $RoleId;

        function __construct($Email, $Password, $Discount, $Avatar, $RoleId, $Id = 0) {
            $this->Id = $Id;
            $this->Email = $Email;
            $this->Password = $Password;
            $this->Discount = $Discount;
            $this->Avatar = $Avatar;
            $this->RoleId = $RoleId;
        }

        function intoDb() {
            try {
                $pdo = Tools::connect('arsenii_shop_db');
                $ps = $pdo->prepare("INSERT INTO Customers (Email, Password, Discount, Avatar, RoleId) VALUES (:Email, :Password, :Discount, :Avatar, :RoleId)");
                $ar = (array)$this;
                array_shift($ar);
                $ps->execute($ar);
            } catch(PDOException $e) {
                $err = $e->getMessage();
                if(substr($err, 0, strpos($err, ":")) == 'SQLSTATE[23000]:Integrity constraint violation') {
                    return 1062;
                }
                return $e->getMessage();
            }
        }
        static function fromDb($id) {
            $customer = null;
            try {
                $pdo = Tools::connect('arsenii_shop_db');
                $ps = $pdo->prepare("SELECT * FROM Customers WHERE Id = ?");
                $ps->bindParam(1, $id);
                $ps->execute();
                $row = $ps->fetch();
                $customer = new Customer($row['Email'], $row['Password'], $row['Discount'], $row['Avatar'], $row['RoleId'], $row['Id']);
                return $customer;
            } catch(PDOException $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>