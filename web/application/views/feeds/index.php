<h2><?php echo $title; ?></h2>

<?php foreach ($feeds as $feeds_item): ?>

    <h3><?php echo $feeds_item['title']; ?></h3>
    <div class="main">
            <?php echo $feeds_item['summary']; ?>
    </div>
    <p><a href="<?php echo $feeds_item['link']; ?>">View article</a></p>

<?php endforeach; ?>
