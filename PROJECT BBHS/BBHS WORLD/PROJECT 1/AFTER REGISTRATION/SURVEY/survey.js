document.addEventListener("DOMContentLoaded", () => {
  const surveyForm = document.getElementById("surveyForm");

  surveyForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const formElements = surveyForm.elements;
    let answers = {
      A: 0,
      B: 0,
      C: 0,
    };

    let allAnswered = true;

    const categories = ["task", "skill", "approach", "scenario", "environment"];

    categories.forEach((category) => {
      const radios = formElements[category];
      let categoryAnswered = false;

      for (let radio of radios) {
        if (radio.checked) {
          answers[radio.value]++;
          categoryAnswered = true;
          break;
        }
      }

      if (!categoryAnswered) {
        allAnswered = false;
      }
    });

    if (!allAnswered) {
      alert("Please answer all the questions.");
      return;
    }

    let result;
    let resultPage;

    if (answers.A > 2) {
      result = "Blue Team";
      resultPage = "resultblue.html";
    } else if (answers.B > 2) {
      result = "Red Team";
      resultPage = "resultred.html";
    } else if (answers.C > 2 || (answers.A === 2 && answers.B === 2)) {
      result = "Purple Team";
      resultPage = "resultpurple.html";
    }

    localStorage.setItem("surveyResult", result);
    window.location.href = resultPage;
  });
});
