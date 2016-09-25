<?php define('INDEX', true); require_once 'includes/ezsolder.php'; ?>

<!DOCTYPE html>
<html>
    <?php include 'includes/html/head.php'; ?>
        <div id="content">
        <?php include 'includes/notify.php'; ?>
            <form id="upload-form" name="main" enctype="multipart/form-data" action="upload.php" onsubmit="return validate();" method="POST">
                <div class="form-group">
                    <div class="form-label"><label for="repository"><?php lang('label_repo'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control disabled" id="repository" name="repository" type="text" value="<?php echo $config['repository']; ?>" disabled="disabled" />
                        <p class="form-help"><?php lang('help_repo'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="modname"><?php lang('label_name'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control" id="modname" name="modname" type="text" />
                        <p class="form-help"><?php lang('help_new_only'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="modauthor"><?php lang('label_author'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control" id="modauthor" name="modauthor" type="text" />
                        <p class="form-help"><?php lang('help_new_only'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="modslug"><?php lang('label_slug'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control" id="modslug" name="modslug" type="text" />
                        <p class="form-help emphasize"><?php lang('help_required'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="modversion"><?php lang('label_version'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control" id="modversion" name="modversion" type="text" />
                        <p class="form-help emphasize"><?php lang('help_required'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="files"><?php lang('label_files'); ?></label></div>
                    <div class="form-input">
                        <input class="form-control" id="files" name="files" type="file" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label for="files"><?php lang('label_dest'); ?></label></div>
                    <div class="form-input">
                        <input id="dest-mods" name="type" value="mods" type="radio" checked="checked" />
                        <label class="radio-label" for="dest-mods"><span></span><?php lang('label_dest_mods'); ?></label>
                        <input id="dest-config" name="type" value="config" type="radio" />
                        <label class="radio-label" for="dest-config"><span></span><?php lang('label_dest_conf'); ?></label>
                        <input id="dest-bin" name="type" value="bin" type="radio" />
                        <label class="radio-label" for="dest-bin"><span></span><?php lang('label_dest_bin'); ?></label>
                        <input id="dest-other" name="type" value="other" type="radio" />
                        <label class="radio-label" for="dest-other"><span></span><?php lang('label_dest_other'); ?></label>
                        <input class="form-control" id="otherfield" name="otherfield" type="text" />
                        <p class="form-help"><?php lang('help_dest'); ?></p>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label"><label></label></div>
                    <div class="form-input">
                        <button class="button info" type="submit"><?php lang('button_upload'); ?></button>
                        <button class="button error" type="reset"><?php lang('button_reset'); ?></button>
                    </div>
                </div>
            </form>
        </div>
        <?php include 'includes/html/footer.php'; ?>
    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="includes/js/js.cookie.js"></script>
    <script type="text/javascript" src="includes/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="includes/js/input.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#btn-notice').click(function() {
                Cookies.set('read_disclaimer', 'true', { expires: 365, path: ''});
                $('#disclaimer').attr('style', 'display: none;');
                $('#disclaimer').hide()
            });

            if(Cookies.get('read_disclaimer') != 'true') {
                $('#disclaimer').removeAttr('style');
                $('#disclaimer').show();
            }
        });
    </script>
</body>
</html>