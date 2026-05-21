<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Book MVP</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; max-width: 800px; margin: 0 auto; padding: 20px; line-height: 1.6; }
        
        h1 { margin-bottom: 20px; }
        
        /* Button Styles */
        button, .btn { background-color: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; font-family: Arial, sans-serif; font-size: 14px; text-decoration: none; display: inline-block; }
        button:hover, .btn:hover { background-color: #2980b9; }
        .btn-danger { background-color: #e74c3c; }
        .btn-danger:hover { background-color: #c0392b; }
        .btn-secondary { background-color: #7f8c8d; }
        
        /* Clean UI */
        a { color: #333; text-decoration: underline; }
        input[type="text"] { padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-family: Arial, sans-serif; width: 250px; }
        
        .search-container { display: flex; align-items: center; gap: 10px; margin-bottom: 30px; }
        
        ul { list-style-type: none; padding: 0; margin: 0; }
        li { padding: 10px 0; margin-bottom: 10px; } 
        
        /* Updated Tag Styling - Soft Yellow */
        .tag { background-color: #fff3cd; color: #664d03; padding: 3px 8px; border-radius: 4px; font-size: 0.85em; margin-left: 10px; }
        
        .action-links { margin-top: 10px; display: flex; gap: 10px; align-items: center; }
    </style>
</head>
<body>
    <h1>Contact Book Home</h1>
    
    <a href="/durano-mvc-framework/public/contacts/create" class="btn" style="margin-bottom: 20px; text-decoration: none;">+ Add New Contact</a>

    <form action="/durano-mvc-framework/public/" method="GET" class="search-container">
        <input type="text" name="q" value="<?= htmlspecialchars($searchQuery ?? '') ?>" placeholder="Search by name...">
        <button type="submit">Search</button>
        <a href="/durano-mvc-framework/public/">Clear</a>
    </form>
    
    <?php if (empty($contacts)): ?>
        <p>No contacts found.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($contacts as $contact): ?>
                <li>
                    <strong><?= htmlspecialchars($contact['name']) ?></strong> - <?= htmlspecialchars($contact['email']) ?>
                    
                    <?php if (!empty($contact['tags'])): ?>
                        <span class="tag"><?= htmlspecialchars($contact['tags']) ?></span>
                    <?php endif; ?>
                    
                    <div class="action-links">
                        <a href="/durano-mvc-framework/public/contacts/<?= $contact['id'] ?>/edit" class="btn btn-secondary" style="padding: 5px 10px; font-size: 12px; text-decoration: none;">Edit</a>
                        
                        <form action="/durano-mvc-framework/public/contacts/<?= $contact['id'] ?>/delete" method="POST" style="margin: 0;">
                            <button type="submit" class="btn-danger" style="padding: 5px 10px; font-size: 12px;" onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars($contact['name']) ?>?');">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>