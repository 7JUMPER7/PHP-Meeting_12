<?php
    class Role {
        protected $Id;
        protected $Role;

        function __construct($Id = 0, $Role) {
            $this->Id = $Id;
            $this->Role = $Role;
        }
    }
?>