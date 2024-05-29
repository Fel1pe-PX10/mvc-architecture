<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="container mx-auto">
        <h1 class="font-bold text-2xl">Contact List</h1>
        <form action="/contacts" method="GET" class="w-full max-w-sm">
            <div class="flex items-center border-b border-teal-500 py-2">
                <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Search" aria-label="Search" name="search">
                <button class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded">
                    Search
                </button>
            </div>
        </form>
        <p class="mt-4"><a href="/contacts/create">Create Contact</a>
        </p>
        <ul class="list-disc list-inside">
            <?php foreach ($contacts['data'] as $contact) : ?>
                <a href="/contacts/<?= $contact['id'] ?>">
                    <li><?= $contact['name'] ?></li>
                </a>
            <?php endforeach ?>
        </ul>

        <?php
        $paginate = 'contacts';
        include_once '../resources/views/assets/pagination.php';
        ?>
    </div>
</body>
</html>