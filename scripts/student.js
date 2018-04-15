function replaceContent(id){
    
}


$(document).ready(function(){
    $("#personalInfo").click(function(){
        alert("HELLO 1");
        let container = document.getElementById("#contentBlock");
        container.load("testing.php");
    })
});
