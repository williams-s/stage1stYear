const questionContainer = document.querySelector(".box");
const btns = Array.from(questionContainer.querySelectorAll('button'));
const reponse = questionContainer.querySelector('p');
for (let i = 0; i < btns.length; i++) {
    console.log(btns[i]);
    btns[i].addEventListener('click', () => {
        if (btns[i].textContent === "Paris") {
            reponse.textContent = "Correct !";  
            reponse.style.backgroundColor = "green";
        } else {
            reponse.textContent = "Incorrect !, la reponse est Paris";
            reponse.style.backgroundColor = "red";
        }
        console.log("yes !")
        questionContainer.classList.toggle('responseBox');
        reponse.style.visibility = "visible";
    })
}

