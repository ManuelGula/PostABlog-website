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
    document.getElementById('adminlogin').onsubmit=function (e){
        var username=document.getElementById("username");
        var password=document.getElementById("password");
        // if(username=="" || password=="" ){
        
        if(username.value!=="admin"){
            alert("You must be an admin to sign in");
            e.preventDefault();
            // return false;
        }else
        if(password.value!=="admin"){
            alert("enter admin's password");
            e.preventDefault();
        }
        }
    }