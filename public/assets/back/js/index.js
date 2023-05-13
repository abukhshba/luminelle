function getPreloader(){
    let output = '';

    output += '<div class="modal-content">';
    output += '<div class="modal-body">';
    output += '<div class="svg-loader">';
    output += '<svg class="svg-container" height="100" width="100" viewBox="0 0 100 100">';
    output += '<circle class="loader-svg bg" cx="50" cy="50" r="45"></circle>';
    output += '<circle class="loader-svg animate" cx="50" cy="50" r="45"></circle>';
    output += '</svg>';
    output += '</div>';
    output += '</div>';
    output += '</div>';

    return output;
}

if ($( ".row_position" ).length > 0) {

    $( ".row_position" ).sortable({
        delay: 150,
        scroll: true,
        stop: function() {
            var selectedData = new Array();

            $('.card-preloader').show();

            $('.row_position>tr').each(function() {
                selectedData.push($(this).attr("id"));
            });

            updateOrder(selectedData, $('.row_position').data('affects'));
        }
    });

    function updateOrder(data, url) {
        $.ajax({
            url:url,
            type:'post',
            data:{position:data},
            success:function(){
                $('.card-preloader').hide();
            }
        })
    }
}

function reloadTooltip(){
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}
