function getNewQuote() {
    fetch('data.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            document.getElementById("quote").innerHTML = data.quote;
            document.getElementById("author").innerHTML = "- " + data.author;
        })
        .catch(error => console.error(error));
}

document.addEventListener("DOMContentLoaded", getNewQuote);
setInterval(getNewQuote, 5000);
