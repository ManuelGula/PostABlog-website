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
    document.getElementById('signin').onsubmit=function (e){
        var username=document.forms["signin"]["username"].value;
        var password=document.forms["signin"]["password"].value;
        if(username=="" && password=="" ){
            alert("enter username and password");
            e.preventDefault();
        }else
        if(username==""){
            alert("enter username to sign in");
            e.preventDefault();
        }else
        if(password==""){
            alert("enter password");
            e.preventDefault();
        }
    }
}