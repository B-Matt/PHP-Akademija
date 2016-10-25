<?php
    session_start();
    if(isset($_POST['submit'])) {    
        // file upload
        $targetFile = 'uploads/' . basename($_FILES["primjer"]["name"]);

        if($_FILES['primjer']['size'] > 5000000) { // 5MB in bytes
            echo 'Uneseni fajl je prevelik (veci od 5MB)!';
            exit;
        }

        if(move_uploaded_file($_FILES["primjer"]["tmp_name"], $targetFile)) {
            echo 'Fajl ' . basename($_FILES['primjer']['name']) . ' je uspjesno uploadan!' . PHP_EOL;
        } else {
            echo 'Doslo je do greske pri uploadu fajla! =(' . PHP_EOL;
            exit;
        }

        // form to txt
        if(isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['smjer']) && 
           isset($_POST['godina']) && isset($_POST['motivation']) && isset($_POST['knowlage']) &&
           isset($_POST['lang']) )
        {
            $data = $_POST['name'] . ',' . $_POST['mail'] . ',' . $_POST['smjer']. ',' . $_POST['godina'] . ',' . $_POST['motivation'] . ',' . $_POST['knowlage'] . ',' . $_POST['lang'] . PHP_EOL;
            $file = file_put_contents('inputs.txt', $data, FILE_APPEND);
            $_SESSION['is_sent'] = true;   
        }
    }

    
    if(isset($_SESSION['is_sent']) && $_SESSION['is_sent'] == true) {
        echo 'Vec ste se prijavili!';
        exit;
    }
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>
        input, textarea { display: block; }
    </style>
</head>
<body>

<header>
    <ul>
        <li><a href="index.php">Naslovnica</a></li>
        <li><a href="form.php">Prijavi se</a></li>
        <li>Login (za admine)</li>
    </ul>
</header>

<main>

    <h1>Prijavnica za PHP akademiju</h1>

    <p>Prijavnica za prvo osječko izdanje PHP akademije koju Inchoo pokreće u suradnji s FERITom.</p>
    <p>Prijave traju do 10.10., pa požuri i svoje mjesto rezerviraj već sad.</p>
    <p>Više informacija na:
        <a href="http://inchoo.hr/php-akademija-2016/" target="_blank">http://inchoo.hr/php-akademija-2016/</a>
    </p>

    <form method="post" enctype="multipart/form-data">
        <label for="name">Ime i prezime</label>
        <input id="name" name="name" required/>
        <label for="mail">Mail adresa</label>
        <input id="mail" name="mail" type="mail" required />
        <label for="smjer">Smjer</label>
        <input id="smjer" name="smjer" required />
        
        <br>
        <label>Godina studija</label>
        <input name="godina" type="radio" value="1">1<br>
        <input name="godina" type="radio" value="2">2<br>
        <input name="godina" type="radio" value="3">3<br>
        
        <br>
        <label for="motivation">Što te motiviralo da se prijaviš?</label>
        <textarea id="motivation" name="motivation"></textarea>
        <br>

        <label for="knowlage">Imaš li predznanje vezano uz web development?</label>
        <textarea name="knowlage" id="knowlage"></textarea>
        
        <br>
        <lable for="lang">U kojim jezicima si do sada programirao?</lable>
        <input name="lang" type="checkbox" value="C" />C<br>
        <input name="lang" type="checkbox" value="C#" />C#<br>
        <input name="lang" type="checkbox" value="C++" />C++<br>
        <input name="lang" type="checkbox" value="PHP" />PHP<br>
        
        <br>
        Uploadaj primjer svoga koda:
        <input type="file" name="primjer" id="primjer">
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</main>

<footer>
    <p>&copy; PHP Akademija, 2016</p>
</footer>

</body>
</html>