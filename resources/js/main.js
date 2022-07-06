var content = document.getElementById('preview');
    content.style.display = "block";

var previewTrigger = document.getElementById('previewTrigger').addEventListener("click", function () {
    if(content.style.display == 'none')
    {
        content.style.display = "block";
    }else{
        content.style.display = "none";
    }
});
   
    
