function GetDate()
{
    //creates js date object and outputs the date
    let date=new Date();
    console.log("bruh");

    let todaysDate=date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
    document.getElementById("notice").innerHTML="This site is currently under construction as of "+todaysDate;
}