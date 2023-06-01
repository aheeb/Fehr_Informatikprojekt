function getNewQuote() {
  $.ajax({
    url: "data.php",
    dataType: "json",
    success: function (data) {
      const quoteElement = $("#quote");
      const authorElement = $("#author");

      // Start fade-out animation
      quoteElement.fadeOut(2000, function() {
        // Update quote after fade-out animation is complete
        quoteElement.text(data.quote);
        quoteElement.fadeIn(2000);
      });

      authorElement.fadeOut(2000, function() {
        // Update author after fade-out animation is complete
        authorElement.text("- " + data.author_vorname + " " + data.author_nachname);
        authorElement.fadeIn(2000);
      });
    },
    error: function () {
      console.error("Network response was not ok");
    },
  });
}

// Rest of your code...


function initForm() {
  $("#quote-form").on("submit", (e) => {
    e.preventDefault();

    const newQuote = $("#new-quote").val();
    const newAuthorVorname = $("#new-author-vorname").val();
    const newAuthorNachname = $("#new-author-nachname").val();
    const formMessage = $("#form-message");
    const formData = new FormData();
    formData.append("quote", newQuote);
    formData.append("author_vorname", newAuthorVorname);
    formData.append("author_nachname", newAuthorNachname);

    $.ajax({
      url: "add_quote.php",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
        if (result === "1") {
          formMessage.text("Zitat erfolgreich hinzugefügt!");
          $("#new-quote").val("");
          $("#new-author-vorname").val("");
          $("#new-author-nachname").val("");
        } else {
          // Zeigt die Fehlermeldung an, die vom PHP-Skript zurückgegeben wird
          formMessage.text(result);
        }
      },
      
    });
  });
}

$(document).ready(() => {
  getNewQuote();
  initForm();
});

setInterval(getNewQuote, 5000);
