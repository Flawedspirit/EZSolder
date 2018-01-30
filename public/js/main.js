$(document).ready(function() {
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

	// Handle file input field
	$modfile.on('change', fileUpload);

	// Handle custom destination field
	$modtype.change(function() {
		$otherfield.prop('disabled', !($('#type').val() == "dest-other"));
	});

	$('input').on('change textInput input', function() {
		if($modslug.val() && $modversion.val() && $modfile.val()) {
			$('#upload-info').show();
			if($('#use-mc-version').prop('checked')) {
				upload_version = '-' + $mcversion.val() + '-' + $modversion.val();
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
		$('input[name=otherfield]').prop('disabled', true);
		location.reload();
	});

	// Handle form submission
	$('#upload-form').submit(function(event) {
		// Handle basic evaluation here
		// TO-DO

		var file;
		var formData = new FormData();
		formData.append('modname',    $modname.val());
		formData.append('modauthor',  $('input[name=modauthor]').val());
		formData.append('modslug',    $('input[name=modslug]').val());
		formData.append('modversion', $('input[name=modversion]').val());
		formData.append('modtype',    $('select[name=type]').val());
		formData.append('otherfield', $('input[name=otherfield]').val());
		formData.append('file'),      $('input[name=file')[0].files;

		$.ajax({
			type: 'POST',
			url: './app/core/process.php',
			data: formData,
			dataType: 'json',
			processData: false,
			contentType: false,
		}).done(function(data) {
			console.log(data); // Remove in production
		});

		// Prevent form the submitting in the usual way and refreshing the page
		event.preventDefault();

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

});