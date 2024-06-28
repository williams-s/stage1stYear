document.addEventListener('DOMContentLoaded', () => {
    const timer = document.getElementById("compteur");
    if (timer) {
        const timeReset = parseInt(timer.textContent);
        console.log(timeReset);
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

        // Écouter les changements dans localStorage pour démarrer/arrêter le compteur
        window.addEventListener("storage", (event) => {
            if (event.key === "startCompteur" && event.newValue === "true") {
                clearInterval(interval);
                i = timeReset; // Réinitialisation à la valeur initiale
                timer.textContent = i; // Mettre à jour l'affichage
                interval = setInterval(actualise, 1000);
            }
        });
    }
});
