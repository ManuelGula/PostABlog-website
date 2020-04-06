window.onload=function(){

    // var fields=document.querySelectorAll('input[type="text"]')
    var fields=document.querySelectorAll('input')
    // var fields=document.getElementsByTagName("input");
    for(i=0;i<fields.length;i++){
        fields[i].addEventListener('focus',(event)=>{
            event.target.className="highlight";
        })
        fields[i].addEventListener('blur',(event)=>{
            event.target.className="removal";
        })
    }
}