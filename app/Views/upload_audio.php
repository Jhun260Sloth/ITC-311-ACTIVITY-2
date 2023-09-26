<?php if (!empty($validationErrors)): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($validationErrors as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="alert alert-danger">
    <?= esc($validationErrors['filepath']) ?>
</div>

<?php endif; ?>


