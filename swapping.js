const swicthBtn = document.getElementById('switch');
swicthBtn.addEventListener('click', () => {
    console.log("clicked");
    if (window.location.pathname === '/view_results.html'){
        console.log("view_results");
        window.location.href = '/questions.html';
    }
    else if (window.location.pathname === '/questions.html'){
        console.log("questions");
        window.location.href = '/view_results.html';
    }
})