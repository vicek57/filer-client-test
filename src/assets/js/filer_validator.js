$(document).ready(function() {
	$('#uploader_file').change(function() {
		$('#file_info').html($('#uploader_file').val().replace('C:\\fakepath\\', ''));
	});
});