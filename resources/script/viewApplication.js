window.onload = () => {
   
    let removeBtns = document.getElementsByTagName('img');
    let removeId = document.getElementById('removeId');

    for(let btn of removeBtns){
        let buttonId = String(btn.getAttribute('id'));
        let appId = buttonId.split('@')[1].trim();
        btn.addEventListener('click',()=>{
            let confirmation = confirm("Are you sure to remove this application?");

            if(confirmation){
                removeId.setAttribute("value", appId);
                document.getElementById('removeApp').submit();
            }
        });
    }
}






