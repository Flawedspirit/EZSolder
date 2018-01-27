$('#modname').on("change textInput input", function() {
    $('#modslug').val(slugify($('#modname').val()));
});

$('#modslug').autocomplete({
    source: 'includes/search.php',
    minLength: 3
});

function slugify(text){
  return text.toString().toLowerCase()
    .replace(/\s+/g, '-')                 // Replace spaces with -
    .replace(/[^\u0100-\uFFFF\w\-]/g,'-') // Remove all non-word chars (fix for UTF-8 chars)
    .replace(/\-\-+/g, '-')               // Replace multiple - with single -
    .replace(/^-+/, '')                   // Trim - from start of text
    .replace(/-+$/, '');                  // Trim - from end of text
}

function validate() {
    var notices = [];

    if($('#dest-other').is(':checked') && $('#otherfield').val() == "") {
        notices.push("A directory name must be entered if \"other\" is selected.");
        $('#otherfield').focus();
    }
    if($('#files').val() == "") {
        notices.push("You must choose a file to upload.");
    }
    if($('#modversion').val() == "") {
        notices.push("A version string must be entered.");
        $('#modversion').focus();
    }
    if($('#modslug').val() == "") {
        notices.push("A mod slug must be entered.");
        $('#modslug').focus();
    }
    if($('#repository').val() == "") {
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