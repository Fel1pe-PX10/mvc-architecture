<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Contacto</h1>
    <p><a href="/contacts">Volver</a></p>
    <p><strong>Nombre:</strong> <?=$contact['name']?></p>
    <p><strong>Telefono:</strong> <?=$contact['phone']?></p>
    <p><strong>Email:</strong> <?=$contact['email']?></p>
    <p><a href="/contacts/<?=$contact['id']?>/edit">Editar</a></p>
    <form action="/contacts/<?=$contact['id']?>/delete" method="POST">
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit">Eliminar</button>
    </form>
</body>
</html>