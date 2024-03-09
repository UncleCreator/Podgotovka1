<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body{
        background-color: gray;
    }
</style>
<body>
    <form method="POST">
    Фамилия<input type="text" name="fam"><br>
    Имя<input type="text" name="im"><br>
    Отчетсво<input type="text" name="otch"><br>
    Логин<input type="text" name="login"><br>
    Пароль<input type="text" name="pass"><br>
    Возраст<input type="text" name="age"><br>
    Номер<input type="text" name="pnomer"><br>
    Серия<input type="text" name="pseria"><br>
    Дата<input type="text" name="data"><br>
    Роль<select name="role">
        <?php
            $hostname ="localhost";
            $username ="root";
            $password = "";
            $dbname = "podgotovka1";
            
            $link = mysqli_connect($hostname, $username, $password, $dbname);
            $query = "Select nazvanie from role";
            $result = mysqli_query($link, $query);
            while($a=mysqli_fetch_array($result)){
                $name = $a['nazvanie'];
                print("<option>$name</option>");
            };
        ?>
    </select> 
    <input type="submit"> 
</form>
</body>
</html>
<?php 

$hostname ="localhost";
$username ="root";
$password = "";
$dbname = "podgotovka1";

if($_POST['fam']!="" && $_POST['im']!="" && $_POST['otch']!="" && $_POST['login']!="" && $_POST['pass']!="" && $_POST['age']!="" && $_POST['pnomer']!="" && $_POST['pseria']!="" && $_POST['data']!=""){
    $link = mysqli_connect($hostname, $username, $password, $dbname);
    if(!preg_match("/^[а-я А-Я]+$/u",$_POST['fam']) || !preg_match("/^[0-9]{4}$/",$_POST['pseria']) ){
        print("Неверный тип данных");
    }
    else{
    $fam = $_POST['fam'];
    $im = $_POST['im'];
    $otch = $_POST['otch'];
    $login = $_POST['login'];
    $pass =$_POST['pass'];
    $age = $_POST['age'];
    $pnomer = $_POST['pnomer'];
    $pseria = $_POST['pseria'];
    $data = $_POST['data'];
    $role = $_POST['role'];

    $search = "Select id from role where nazvanie='$role'";
    $sresult = mysqli_query($link, $search);
    $a = mysqli_fetch_array($sresult);
    $ri = $a['id'];

    $query = "Insert into sotrudniki (Familya, Imya, Otchestvo, Login, Password, Age, Pasport_nomer, Pasport_seria, data, Role) VALUES ('$fam','$im','$otch','$login','$pass','$age','$pnomer','$pseria','$data','$ri')";
    $result = mysqli_query($link, $query);
    if($result!=""){
        print("Пользователь создан");
    }
    else{
        print("Где то ошибка");
    }
}
}
else{
    print("ВВедите данные");
}




?>