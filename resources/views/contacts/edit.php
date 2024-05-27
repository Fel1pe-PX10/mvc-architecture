<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Contact</h1>
    <form action="/contacts/<?=$contact['id']?>" method="POST">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="<?=$contact['name']?>">
        </div>
        <div>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?=$contact['phone']?>">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?=$contact['email']?>">
        </div>
        
        <button type="submit">Edit</button>
    </form>
</body>
</html>