document.addEventListener('DOMContentLoaded', function() {
    const switchBtn = document.getElementById('switch');
    
    switchBtn.addEventListener('click', function() {
        console.log("clicked");

        // Vérifie l'URL complète pour une correspondance précise
        if (window.location.pathname.endsWith('/view_image.html')) {
            console.log("view_image");
            window.location.href = '/questions.html';
        } else if (window.location.pathname.endsWith('/questions.html')) {
            console.log("questions");
            window.location.href = '/view_image.html';
        }
    });
});
