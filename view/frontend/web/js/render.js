"use strict";

<!-- This function toggles the short description and the full content on click -->
let buttonCollection = document.getElementsByClassName("toggle-read-more"),
    state = false;

for(let button of buttonCollection) {

    button.addEventListener("click", () => {
        <!-- Collecting the specific content of every article -->
        let article = button.parentElement,
            shortDescription = article.getElementsByClassName("short-description")[0],
            fullContent = article.getElementsByClassName("full-content")[0];

        shortDescription.classList.toggle("hidden");
        fullContent.classList.toggle("hidden");

        <!-- Checks the buttons state to toggle the right content mode -->
        state = !state;
        button.innerText = state ? "Read Less" : "Read More";

        <!-- Moves botton in active section for intuitive user behaviour -->
        article.insertBefore(button, fullContent);
    })
}
