function getNewQuote() {
  $.ajax({
    url: "data.php",
    dataType: "json",
    success: function (data) {
      const quoteElement = $("#quote");
      const authorElement = $("#author");

      // Fade-out-Animation starten
      quoteElement.addClass("fade-out");
      authorElement.addClass("fade-out");

      // Nachdem die Fade-out-Animation abgeschlossen ist
      setTimeout(() => {
        // Zitat und Autor aktualisieren
        quoteElement.html(data.quote);
        authorElement.html("- " + data.author);

        // Fade-in-Animation starten
        quoteElement.removeClass("fade-out");
        authorElement.removeClass("fade-out");
        quoteElement.addClass("fade-in");
        authorElement.addClass("fade-in");

        // Fade-in-Animation entfernen, damit sie beim nächsten Mal wieder angewendet werden kann
        setTimeout(() => {
          quoteElement.removeClass("fade-in");
          authorElement.removeClass("fade-in");
        }, 2000);
      }, 2000);
    },
    error: function () {
      console.error("Network response was not ok");
    },
  });
}

function initForm() {
  $("#quote-form").on("submit", (e) => {
    e.preventDefault();

    const newQuote = $("#new-quote").val();
    const newAuthor = $("#new-author").val();
    const formMessage = $("#form-message");

    const formData = new FormData();
    formData.append("quote", newQuote);
    formData.append("author", newAuthor);

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
          $("#new-author").val("");
        } else {
          formMessage.text("Fehler beim Hinzufügen des Zitats.");
        }
      },
      error: function () {
        console.error("Error:");
        formMessage.text("Fehler beim Hinzufügen des Zitats.");
      },
    });
  });
}

$(document).ready(() => {
  getNewQuote();
  initForm();
});

setInterval(getNewQuote, 7000);