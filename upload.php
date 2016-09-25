<?php define('INDEX', true); require_once 'includes/ezsolder.php'; ?>

<!DOCTYPE html>
<html>
    <?php include 'includes/html/head.php'; ?>
        <div id="content">
            <?php require 'includes/process.php'; ?>
            <button class="button info" onclick="window.history.back();">&larr; <?php lang('button_return'); ?></button>
        </div>
        <?php include 'includes/html/footer.php'; ?>
    </div>
</body>
</html>