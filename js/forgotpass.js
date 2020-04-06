window.onload=function(){
    var fields=document.querySelectorAll('input')
    for(i=0;i<fields.length;i++){
        fields[i].addEventListener('focus',(event)=>{
            event.target.className="highlight";
        })
        fields[i].addEventListener('blur',(event)=>{
            event.target.className="removal";
        })
    }

    document.getElementById('forgotpass').onsubmit=function (e){
        var email=document.forms["forgotpass"]["email"].value;
    
        if(email=="" || email==null){
            alert("enter your email");
            e.preventDefault();
        }
    }
}