<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Contact</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; max-width: 500px; margin: 0 auto; padding: 20px; line-height: 1.6; }
        h1 { border-bottom: 1px solid #ddd; padding-bottom: 10px; margin-bottom: 20px; }
        
        button { background-color: #3498db; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-family: Arial, sans-serif; font-size: 14px; margin-top: 10px; }
        button:hover { background-color: #2980b9; }
        a { color: #555; text-decoration: underline; margin-left: 15px; font-size: 14px; }
        
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; margin-bottom: 5px; }
        input[type="text"], input[type="email"] { padding: 8px; border: 1px solid #ccc; border-radius: 4px; font-family: Arial, sans-serif; width: 100%; box-sizing: border-box; }
        .error { color: #e74c3c; font-size: 0.9em; margin-top: 5px; }
    </style>
</head>
<body>
    <h1>Add New Contact</h1>
    
    <form action="/durano-mvc-framework/public/contacts" method="POST" novalidate>
        
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($contact['name'] ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($contact['email'] ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($contact['phone'] ?? '') ?>">
            <?php if (isset($errors['phone'])): ?>
                <div class="error"><?= $errors['phone'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Tags (comma separated):</label>
            <input type="text" name="tags" value="<?= htmlspecialchars($contact['tags'] ?? '') ?>" placeholder="e.g. Work, Family">
        </div>
        
        <button type="submit">Save Contact</button>
        <a href="/durano-mvc-framework/public/">Cancel</a>
    </form>
</body>
</html>