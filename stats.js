$(document).ready(function() {
    $.getJSON('stats.php', function(data) {
        var totalViews = 0;
        $.each(data, function(key, value) {
            $("#quote-table").append("<tr><td>" + value.quote +
                                    "</td><td>" + value.author_vorname + " " + value.author_nachname +
                                    "</td><td>" + value.views +
                                    "</td></tr>");
            totalViews += parseInt(value.views);
        });
        $('#total-quotes').html(data.length);
        $('#total-views').html(totalViews);
    });
});