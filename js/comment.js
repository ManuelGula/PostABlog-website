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

    document.getElementById('makeacomment-container').onsubmit=function (e){
        var comment=document.getElementById("make_a_comment").value;
        if(comment==""||comment==null){
            alert("Enter a comment before submission");
            e.preventDefault();
        }
    }
}