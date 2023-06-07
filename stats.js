$(document).ready(function(){
    $.getJSON('stats.php', function(data) {
        var totalQuotes = 0;
        var totalViews = 0;
        $.each(data, function(key, item) {
            totalQuotes++;
            totalViews += parseInt(item.views, 10);
            $('#quote-table').append('<tr><td>'+item.quote+'</td><td>'+item.author_first_name+'</td><td>'+item.author_last_name+'</td><td>'+item.views+'</td></tr>');
        });
        $('#total-quotes').text(totalQuotes);
        $('#total-views').text(totalViews);
    });
});
