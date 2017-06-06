$(".prettyprint").each(function() {
    var text = $(this).text();
    text = text.replace("\{\%", "\{\{");
    $(this).text(text);

});

$(".prettyprint").each(function() {
    var text = $(this).text();
    text = text.replace("\%\}", "\}\}");
    $(this).text(text);

});
