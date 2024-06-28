document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const filePath = urlParams.get('filePath');
    if (filePath) {
        document.getElementById('canvas-image').src = filePath;
    }
});


const results_players = document.querySelector('.results-players');
function getDrawings(){
    fetch('view_results.php')
    .then(response => response.json())
    .then(data => {
        data.forEach(user => {
            let img = document.createElement('src');
            img.src = user.photo_url;
            img.id = "canvas-image";
            let user_name = document.createElement('p');
            user_name.textContent = user.user_name;
            results_players.appendChild(img);
            results_players.appendChild(user_name);
        });
    })
    .catch(error => console.error('Error:', error));
}

setInterval(getDrawings, 5000);

getDrawings();





