document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const filePath = urlParams.get('filePath');
    if (filePath) {
        document.getElementById('canvas-image').src = filePath;
    }
});

const results_players = document.querySelector('.results-players');

function getDrawings() {
    fetch('getDrawings.php')
    .then(response => response.json())
    .then(data => {
        // Effacer le contenu existant de results_players avant d'ajouter de nouvelles images
        results_players.innerHTML = '';

        data.forEach(user => {
            let img = document.createElement('img');
            let borderDrawing = document.createElement('div');
            borderDrawing.classList.add('border-drawing');
            img.src = user.photo_url;
            // Utilisez une classe pour cibler les images générées dynamiquement
            img.classList.add('dynamic-image');
            
            let user_name = document.createElement('p');
            user_name.textContent = user.username;
            //console.log(user_name.textContent);
            borderDrawing.appendChild(img);
            borderDrawing.appendChild(user_name);
            results_players.appendChild(borderDrawing);
/*             results_players.appendChild(img);
            results_players.appendChild(user_name); */
        });
    })
    .catch(error => console.error('Error:', error));
}

// Appel initial à la fonction getDrawings()
getDrawings();

// Rafraîchissement automatique toutes les 5 secondes
setInterval(getDrawings, 5000);
    
document.getElementById('btn-deleteAll').addEventListener('click', () => {
    fetch('delete.php', {
        method: 'DELETE'
    })
    .then(response => response.json())
    .then(data => {
        results_players.innerHTML = '';
        alert('Toutes les images ont été supprimées');
    })
    .catch(error => console.error('Error:', error));
})



const startBtn = document.getElementById('btn1');
startBtn.addEventListener('click', () => {
  localStorage.setItem('startCompteur', 'true');
});