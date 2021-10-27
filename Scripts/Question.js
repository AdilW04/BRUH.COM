//answer=list of possible answers
class Question
{
    constructor(question,answer)
    {
        this.question=question;
        this.answer=answer;
    }
    OutputQuestion()
    {
        console.log(this.question);
    }
    OutputAnswer()
    {
        console.log(this.answer);
    }
}
function SubmitQuestion()
{
    let question= new Question(document.getElementById("question").value,document.getElementById("answer").value);
    question.OutputAnswer();
    question.OutputQuestion();

}


