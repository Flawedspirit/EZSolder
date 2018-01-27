$(document).ready(function() {

	var file;

	// Handle file input field
	$('#file').on('change', fileUpload);

	// Handle custom destination field
	$('#type').change(function() {
		$('input[name=otherfield]').prop('disabled', !($('#type').val() == "dest-other"));
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

		var formData = new FormData();
		formData.append('modname', $('input[name=modname]').val());
		formData.append('modauthor', $('input[name=modauthor]').val());
		formData.append('modslug', $('input[name=modslug]').val());
		formData.append('modversion', $('input[name=modversion]').val());
		formData.append('modtype', $('select[name=type]').val());
		formData.append('otherfield', $('input[name=otherfield]').val());
		formData.append('file', file[0]);

		$.ajax({
			type: 'POST',
			url: './app/core/process.php',
			data: formData,
			dataType: 'json',
			processData: false,
			contentType: false,
			encode: true
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