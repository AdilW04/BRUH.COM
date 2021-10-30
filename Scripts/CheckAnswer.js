function CheckAnswer()
{
    let input=document.getElementById("answer").value;
    let answer= document.getElementById("actualAnswer").getAttribute("name");
    console.log(input ,answer);
    if (input==answer)
    {
        document.getElementById("actualAnswer").innerHTML=":D Woohoo!";
    }
    else
    {
        document.getElementById("actualAnswer").innerHTML=":( WRONG!";
    }
    let a=location.reload;
    setTimeout(reload,750);
    //location.reload();
}
function reload()
{
    location.reload();
}