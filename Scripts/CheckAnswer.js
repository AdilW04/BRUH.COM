function CheckAnswer()
{
    let input=document.getElementById("answer").value;
    let answer= document.getElementById("actualAnswer").getAttribute("name");
    //reads the actual answer by checking the name attribute where i slipped the answer in through php
    console.log(input ,answer);
    //compares the answer given and the actual answer, changes the message accordingly
    if (input=="")
    {
        document.getElementById("actualAnswer").innerHTML=":/ please enter something!!";
    }
    else if (input==answer)
    {

        document.getElementById("actualAnswer").innerHTML=":D Woohoo!";

    }
    else
    {
        document.getElementById("actualAnswer").innerHTML=":( WRONG!";
    }
    // if( document.getElementById("upvote").checked)
    // {
    //     openDatabase()
    // }
    // let a=location.reload;
    // setTimeout(reload,750);
    //location.reload();

}
function reload()
{
    location.reload();
}