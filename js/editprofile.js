window.onload=function(){

    var fields=document.querySelectorAll('input[type="text"],textarea,input[type="email"]');
    for(i=0;i<fields.length;i++){
        fields[i].addEventListener('focus',(event)=>{
            event.target.className="highlight";
        })
        fields[i].addEventListener('blur',(event)=>{
            event.target.className="removal";
        })
    }

    document.getElementById('editprofile').onsubmit=function (e){
        var fname=document.forms["editprofile"]["firstname"].value;
        var lname=document.forms["editprofile"]["lastname"].value;
        var email=document.forms["editprofile"]["email"].value;
        var bio=document.getElementById("bio").value;
        // var image=document.forms["editprofile"]["prof_image"].value;
        
        if(fname==""&&lname==""&&email==""&&bio==""&&image==""){
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
        if(email==""|| email==null){
            alert("You must enter an email");
            e.preventDefault();
        }else
        if(bio==""||bio==null){
            alert("You must enter an bio");
            e.preventDefault();
        }
        // if(image==""|| image==null){
        //     alert("you must upload an image");
        //     e.preventDefault();
        // }
    }
}