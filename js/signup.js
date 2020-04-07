window.onload=function(){

    var fields=document.querySelectorAll('input[type="text"],textarea,input[type="password"],input[type="email"]');
    for(i=0;i<fields.length;i++){
        fields[i].addEventListener('focus',(event)=>{
            event.target.className="highlight";
        })
        fields[i].addEventListener('blur',(event)=>{
            event.target.className="removal";
        })
    }

    document.getElementById('signup').onsubmit=function (e){
        var fname=document.forms["signup"]["firstname"].value;
        var lname=document.forms["signup"]["lastname"].value;
        var username=document.forms["signup"]["username"].value;
        var email=document.forms["signup"]["email"].value;
        var bio=document.getElementById("bio").value;
        var pass=document.forms["signup"]["password"].value;
        var repass=document.forms["signup"]["retype-password"].value;
        var image=document.forms["signup"]["prof_image"].value;
        
        if(fname==""&&lname==""&username==""&&email==""&&pass==""&&repass==""&&bio==""&&image==""){
            alert("all fields must be filled")
            e.preventDefault();
        }else
        if(fname==""||fname==null){
            alert("You must enter a first name!");
            e.preventDefault();
        
        }else
        if(lname==""|| lname==null){
            alert("You must enter a  last name!");
            e.preventDefault();
        }else
        if(username==""|| username==null){
            alert("You must enter your username");
            e.preventDefault();
        }else
        if(email==""|| email==null){
            alert("You must enter an email");
            e.preventDefault();
        }else
        if(pass==""|| pass==null){
            alert("You must enter an password");
            e.preventDefault();
        }else
        if(repass==""|| repass==null){
            alert("retype password");
            e.preventDefault();
        }else
        if(bio==""||bio==null){
            alert("You must enter an bio");
            e.preventDefault();
        }else
        if(image==""|| image==null){
            alert("you must upload an image");
            e.preventDefault();
        }else
        if(pass!==repass){
            alert("passwords must match")
            e.preventDefault();
        }else
        if(bio.length>500){
            alert("Bio too long");
            e.preventDefault();
        }
    }
}