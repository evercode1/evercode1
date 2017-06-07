$(".prettyprint").each(function() {
    var text = $(this).text();
    text = text.replace("\{\%", "\{\{");
    text = text.replace("\%\}", "\}\}");
    $(this).text(text);

});


