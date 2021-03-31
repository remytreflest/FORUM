<?php
if (!empty($_SESSION["Role"]) && $_SESSION["Role"] == 2) {
    header("location:admin/");
} else {
    header("location:user/");
}