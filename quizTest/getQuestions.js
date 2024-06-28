fetch('getQuestions.php')
    .then(response => response.json())
    .then(data => {
        const questionsContainer = document.getElementById('questionContainer');
        data.forEach(question => {
            const questionContainer = document.createElement('div');
            questionContainer.className = 'question-container';
            questionContainer.id = `question${question.id}`;
            questionContainer.innerHTML = `
                <p class="question">${question.question}</p>
                <div class="btn-container">
                    <button class="btn-next" onclick="nextQuestion('question${question.id + 1}')">Suivant</button>
                </div>
            `;
            questionsContainer.appendChild(questionContainer);
        });
    })
    .catch(error => console.error(error))