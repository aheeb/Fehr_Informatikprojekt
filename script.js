function getNewQuote() {
    fetch("data.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        const quoteElement = document.getElementById("quote");
        const authorElement = document.getElementById("author");
  
        // Fade-out-Animation starten
        quoteElement.classList.add("fade-out");
        authorElement.classList.add("fade-out");
  
        // Nachdem die Fade-out-Animation abgeschlossen ist
        setTimeout(() => {
          // Zitat und Autor aktualisieren
          quoteElement.innerHTML = data.quote;
          authorElement.innerHTML = "- " + data.author;
  
          // Fade-in-Animation starten
          quoteElement.classList.remove("fade-out");
          authorElement.classList.remove("fade-out");
          quoteElement.classList.add("fade-in");
          authorElement.classList.add("fade-in");
  
          // Fade-in-Animation entfernen, damit sie beim nächsten Mal wieder angewendet werden kann
          setTimeout(() => {
            quoteElement.classList.remove("fade-in");
            authorElement.classList.remove("fade-in");
          }, 2000);
        }, 2000);
      })
      .catch((error) => console.error(error));
  }
  
  document.addEventListener("DOMContentLoaded", getNewQuote);
  function initForm() {
    document.getElementById("quote-form").addEventListener("submit", (e) => {
        e.preventDefault();

    const newQuote = document.getElementById("new-quote").value;
    const newAuthor = document.getElementById("new-author").value;
    const formMessage = document.getElementById("form-message");

    const formData = new FormData();
    formData.append("quote", newQuote);
    formData.append("author", newAuthor);

    fetch("add_quote.php", {
        method: "POST",
        body: formData,
    })
        .then((response) => response.text())
        .then((result) => {
            if (result === "1") {
                formMessage.innerText = "Zitat erfolgreich hinzugefügt!";
                document.getElementById("new-quote").value = "";
                document.getElementById("new-author").value = "";
            } else {
                formMessage.innerText = "Fehler beim Hinzufügen des Zitats.";
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            formMessage.innerText = "Fehler beim Hinzufügen des Zitats.";
        });
    });
}

document.addEventListener("DOMContentLoaded", () => {
    getNewQuote();
    initForm();
});

setInterval(getNewQuote, 7000);

