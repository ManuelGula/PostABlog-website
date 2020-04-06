window.onload=function(){

    var fields=document.querySelectorAll('input[type="text"],textarea');
    for(i=0;i<fields.length;i++){
        fields[i].addEventListener('focus',(event)=>{
            event.target.className="highlight";
        })
        fields[i].addEventListener('blur',(event)=>{
            event.target.className="removal";
        })
    }

    document.getElementById('createblog').onsubmit=function (e){
                var title=document.forms["createblog"]["title"].value;
                var description=document.getElementById("desc").value;
                var content=document.getElementById("content").value;
                var image=document.forms["createblog"]["blog_image"].value;
                if(title=="" && description=="" && content=="" && image=="" ){
                    alert("All fields must be filled to confirm edit");
                    e.preventDefault();
                }else
                if(title==""||title==null){
                    alert("Enter a title");
                    e.preventDefault();
                }else
                if(description==""||description==null){
                    alert("Enter a description");
                    e.preventDefault();
                }else
                if(content==""||content==null){
                    alert("Fill in your content.");
                    e.preventDefault();
                }else
                if(image==""|| image==null){
                    alert("you must upload an image");
                    e.preventDefault();
                }else
                if(content.length<200){
                    alert("Your blog is too short");
                    e.preventDefault();
                }else
                if(content.length>5000){
                    alert("Your blog is too long");
                    e.preventDefault();
                }
    }
}