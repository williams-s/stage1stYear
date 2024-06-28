const swicthBtn = document.getElementById('switch');
swicthBtn.addEventListener('click', () => {
    if (window.location.pathname === 'view_results.html'){
        window.location.href = 'questions.html';
    }
    else if (window.location.pathname === 'questions.html'){
        window.location.href = 'view_results.html';
    }
})