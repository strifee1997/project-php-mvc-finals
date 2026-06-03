<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Book MVP</title>
</head>
<body>
    <h1>Contact Book Home</h1>
    
    <a href="/durano-mvc-framework/public/contacts/create">+ Add New Contact</a>
    <br><br>

    <form action="/durano-mvc-framework/public/" method="GET" style="margin-bottom: 20px;">
        <input type="text" name="q" value="<?= htmlspecialchars($searchQuery ?? '') ?>" placeholder="Search by name...">
        <button type="submit">Search</button>
        <a href="/durano-mvc-framework/public/">Clear</a>
    </form>

    <!--
    <a href="/durano-mvc-framework/public/about">
    <button style="margin-bottom: 15px;">About Us</button>
    </a>
    -->

    <?php if (empty($contacts)): ?>
        <p>No contacts found.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($contacts as $contact): ?>
                <li style="margin-bottom: 10px;">
                    <strong><?= htmlspecialchars($contact->name) ?></strong> - <?= htmlspecialchars($contact->email) ?> | <?= htmlspecialchars($contact->phone) ?>
                    
                    <?php if (!empty($contact->tags)): ?>
                        <span style="border: 1px solid #000; padding: 1px 5px; font-size: 0.85em; margin-left: 5px;">
                            <?= htmlspecialchars($contact->tags) ?>
                        </span>
                    <?php endif; ?>
                    
                    &nbsp;&nbsp;
                    <a href="/durano-mvc-framework/public/contacts/<?= $contact->id ?>/edit">[Edit]</a>
                    &nbsp;
                    
                    <form action="/durano-mvc-framework/public/contacts/<?= $contact->id ?>/delete" method="POST" style="display:inline; margin:0; padding:0;">
                        <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; font-family:serif; font-size:16px; padding:0;">
                            [Delete]
                        </button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
