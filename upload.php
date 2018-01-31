<?php define('INDEX', true); require_once 'includes/ezsolder.php'; ?>

<!DOCTYPE html>
<html>
    <?php include 'includes/html/head.php'; ?>
        <div class="content">
            <?php require 'includes/process.php'; ?>
            <input class="primary" type="button" onclick="window.history.back();" value="&larr; <?php lang('button_return'); ?>">
            <?php include 'includes/html/footer.php'; ?>
        </div>
    </div>
</body>
</html>