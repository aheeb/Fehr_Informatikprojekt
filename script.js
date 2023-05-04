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
  setInterval(getNewQuote, 7000);
  