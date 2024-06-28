const timer = document.getElementById("compteur");
const timeReset = parseInt(timer.textContent);
let i = timeReset;
let interval;

function actualise() {
  if (i > 0) {
    i--;
  }
  timer.textContent = i;
  localStorage.setItem("compteur", i); // Mise à jour de l'état du compteur dans localStorage
  if (i <= 0) {
    clearInterval(interval);
  }
}

// Vérifier s'il y a un état de compteur stocké
const storedValue = localStorage.getItem("compteur");
if (storedValue !== null) {
  i = parseInt(storedValue);
  timer.textContent = i;
}

// Ecouter les changements dans localStorage pour démarrer/arrêter le compteur
window.addEventListener("storage", (event) => {
  if (event.key === "startCompteur" && event.newValue === "true") {
    clearInterval(interval);
    i = timeReset;
    interval = setInterval(actualise, 1000);
  }
});
