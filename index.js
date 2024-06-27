// JavaScript pour la fonctionnalité de quiz
const questionContainer = document.querySelector(".box");
const btns = Array.from(questionContainer.querySelectorAll('button'));
const reponse = questionContainer.querySelector('p');
for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', () => {
        if (btns[i].textContent === "Paris") {
            reponse.textContent = "Correct !";  
            reponse.style.backgroundColor = "green";
        } else {
            reponse.textContent = "Incorrect !, la réponse est Paris";
            reponse.style.backgroundColor = "red";
        }
        questionContainer.classList.toggle('responseBox');
        reponse.style.visibility = "visible";
    });
}

// Fonction pour récupérer les données depuis index.php
function fetchData() {
    fetch('index.php')
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById('todo-table-body');
            tableBody.innerHTML = ''; // Effacer les anciennes données
            data.forEach(todo => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${todo.item_id}</td>
                    <td>${todo.content}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Erreur:', error));
}

// Appeler fetchData lorsque la page est chargée
window.onload = fetchData;
