<!-- index, send id, router and web,engine render
send post, router and web, valid from contr, db c, respsonse
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Contact</title>
</head>
<body>
    <h1>Edit Contact</h1>
    
    <form action="/durano-mvc-framework/public/contacts/<?= $contact->id ?>/edit" method="POST" novalidate>
        
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
        <button type="submit">Update Contact</button>
        <a href="/durano-mvc-framework/public/">Cancel</a>
    </form>
</body>
</html>
