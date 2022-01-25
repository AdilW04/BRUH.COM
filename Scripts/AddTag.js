let tags=new Array()
class Tag{
    constructor(){
        this.questions=[];

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