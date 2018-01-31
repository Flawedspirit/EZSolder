var $modrepo    = $('#repository');
var $modname    = $('#modname');
var $modauthor  = $('#modauthor');
var $modslug    = $('#modslug');
var $modversion = $('#modversion');
var $mcversion  = $('#mcversion');
var $modfile    = $('#file');
var $modtype    = $('#type');
var $otherfield = $('#otherfield');
var upload_version;

//Automatically slugify mod name
$modname.on('change textInput input', function() {
    $modslug.val(slugify($modname.val()));
});

$modslug.autocomplete({
    source: 'includes/search.php',
    minLength: 3
});

// Handle file input field
$modfile.on('change', fileUpload);

// Handle custom destination field
$modtype.change(function() {
    $otherfield.prop('disabled', !($('#type').val() == "dest-other"));
});

$('input').on('change textInput input', function() {
    if($modslug.val() && $modversion.val() && $modfile[0].files) {
        $('#upload-info').show();
        if($('#use-mc-version').prop('checked')) {
            upload_version = '-mc' + $mcversion.val() + '-' + $modversion.val();
        } else {
            upload_version = '-' + $modversion.val();
        }

        $('#file-to-upload').html('<b>&lt;repository&gt;/' + $modslug.val() + '/' + $modslug.val() + upload_version + '.zip</b>');
    } else {
        $('#upload-info').hide();
    }
});

// Ensure form is reset properly
$('input[type=reset]').click(function() {
    $otherfield.prop('disabled', true);
    location.reload();
});

function slugify(text){
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')                 // Replace spaces with -
    .replace(/[^\u0100-\uFFFF\w\-]/g,'-') // Remove all non-word chars (fix for UTF-8 chars)
    .replace(/\-\-+/g, '-')               // Replace multiple - with single -
    .replace(/^-+/, '')                   // Trim - from start of text
    .replace(/-+$/, '');                  // Trim - from end of text
}

function fileUpload(event) {
    file = event.target.files;
    $('#file-button').attr('value', "Uploading " + file[0].name);
}

function validate() {
    var notices = [];

    if($modtype.val() == "dest-other" && $('#otherfield').val() == "") {
        notices.push("A directory name must be entered if \"other\" is selected.");
        $otherfield.focus();
    }
    if($modfile.val() == "") {
        notices.push("You must choose a file to upload.");
    }
    if($modversion.val() == "") {
        notices.push("A version string must be entered.");
        $modversion.focus();
    }
    if($modslug.val() == "") {
        notices.push("A mod slug must be entered.");
        $modtype.focus();
    }
    if($modrepo.val() == "") {
        notices.push("The mod repository path must be entered.");
    }

    if(notices.length > 0) {
        // Clear out the old error list to prevent content duplication glitches.
        // These aren't rare candies. These duplications aren't awesome.
        $('#val-errors p').empty();
        $('#val-errors span').remove();

        // There were issues; compile a list of messages and alert user
        $('#val-errors').removeAttr('style');
        $('#val-errors p').append('<strong>Please fix these issues and try again:</strong><br />');
        $.each(notices, function(key, message) {
            $('#val-errors p').append(message + '<br />');
            key, message = '';
        });
        $('#val-errors').prepend('<span class="icon-error"></span>');

        return false;
    }
    $('#val-errors').attr('style', 'display: none;');
    return true;
}