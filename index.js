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

const myForm = document.getElementById('myForm');

// Écouter l'événement de soumission du formulaire
myForm.addEventListener('submit', function(event) {
    // Empêcher le comportement par défaut du formulaire (rechargement de page)
    event.preventDefault();

    // Récupérer les données du formulaire
    const name = new FormData(myForm);

    // Effectuer une requête POST avec fetch
    fetch('get.php', {
        method: 'POST',
        body: name
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur lors de la requête');
        }
        return response.text(); // Traitez la réponse comme du texte si nécessaire
    })
    .then(data => {
        // Faire quelque chose avec la réponse si nécessaire
        console.log('Réponse reçue:', data);
        // Exemple : actualiser les données après l'insertion
        fetchData(); // Appeler votre fonction pour actualiser les données
        // Réinitialiser le formulaire si nécessaire
        myForm.reset();
    })
    .catch(error => {
        console.error('Erreur:', error);
        // Gérer les erreurs si nécessaire
    }); 
});




// Appeler fetchData lorsque la page est chargée
window.onload = fetchData;
