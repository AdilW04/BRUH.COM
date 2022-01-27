let tags=new Array()
class Controller{
    constructor(){

    }
}
class Tag{
    constructor(){
        this.keywords=[];
        this.name="";

    }
    Specify(question,Questions){
        let QSplit=question.split(" ");
        if (Questions.length==0)
        {
            for(let i=0; i<QSplit.length;i++){
                Questions.append(QSplit[i]);
            }
        }
        else
        {
            console.log("to be continued???");
        }
    }

}
function AddTag()
{
    let tag=document.getElementById("tags").value;
    console.log("tag")
    tags.push(tag);
    document.getElementById("outputTags").innerHTML="";
    let output=""
    for(let i=0; i<tags.length;i++)
    {
        console.log(tags[i]);
        output=output+tags[i];
    }

    document.getElementById("outputTags").innerHTML=document.getElementById("outputTags").innerHTML+output;
    document.getElementById("tags").value="";

}