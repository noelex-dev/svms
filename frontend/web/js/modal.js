$(document).ready(function () {
    $('#svmsModal').on('show.bs.modal', function (e) {
        var target = $(e.relatedTarget);
        var title = target.data('title');
        var subtitle = target.data('subtitle');
        var icon = target.data('icon');
        var id = target.data('id');
        var url = target.data('url');
        var type = target.data('type');
        var width = target.data('width');

        $('#svmsModal .modal-lg').css('max-width', '');
        $('#svmsModalTitle').text('');
        $('#svmsModalIcon').attr('class', 'styled-icon');
        $('#svmsModalSubtitle').text('');
        $('#svmsModalContent').html('');

        $('#svmsModal .modal-lg').css('max-width', width);
        $('#svmsModalTitle').text(title);
        $('#svmsModalIcon').addClass(icon);
        $('#svmsModalSubtitle').text(subtitle);

        $.ajax({
            url: url,
            type: type,
            success: function (data) {
                $('#svmsModalContent').html(data);
            },
            error: function (xhr, status, error) {
                alert('Error loading form: ' + xhr.responseText);
                console.error(xhr.responseText);
            }
        });
    });
});
