<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Listado contactos</h1>
    <p><a href="/contacts/create">Crear Contacto</a>
    </p>
    <ul>
    <?php foreach($contacts as $contact): ?>
        <a href="/contacts/<?=$contact['id']?>">
            <li><?=$contact['name']?></li>
        </a>
    <?php endforeach ?>
    </ul>
</body>
</html>