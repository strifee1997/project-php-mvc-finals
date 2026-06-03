<!-- index, pub index, router and web, engine
 send post, sumbong sa pub index na post req, route and web, db c and m, response
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Contact</title>
</head>
<body>
    <h1>Add New Contact</h1>
    
    <form action="/durano-mvc-framework/public/contacts" method="POST" novalidate>
        
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="<?= htmlspecialchars($contact->name ?? '') ?>">
            <?php if (isset($errors['name'])): ?>
                <div class="error" style="color: red; font-size: 0.9em;"><?= $errors['name'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($contact->email ?? '') ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="error" style="color: red; font-size: 0.9em;"><?= $errors['email'] ?></div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($contact->phone ?? '') ?>">
            <?php if (isset($errors['phone'])): ?>
                <div class="error" style="color: red; font-size: 0.9em;"><?= $errors['phone'] ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label>Tags:</label>
            <input type="text" name="tags" value="<?= htmlspecialchars($contact->tags ?? '') ?>" placeholder="e.g. Work, Family">
        </div>
        <br>
        <button type="submit">Save Contact</button>
        <a href="/durano-mvc-framework/public/">Cancel</a>
    </form>
</body>
</html>
