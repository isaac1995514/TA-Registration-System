window.onload = () => {
    "use strict";
   
    var randomValueToAvoidCache = (new Date()).getTime();       // Random value used to avoid cache
    let removeBtns = document.getElementsByTagName('img');

    for(let btn of removeBtns){
        let buttonId = String(btn.getAttribute('id'));
        let appId = buttonId.split('@')[1].trim();
        btn.addEventListener('click',()=>{

            let confirmation = confirm("Are you sure to remove this application?");

            // If the user decide to remove the application
            if(confirmation){
                let xHttp = new XMLHttpRequest();
                let params = `?appId=${appId}`
                let url = "./../../model/ajaxScript/removeStudentApplication.php"
                let asynch = true;
    
                /* adding appId to url */
                url += params;

                // Add Random value to avoid cache
                url += "&randomValue=" + randomValueToAvoidCache;
            
                xHttp.open("GET", url, asynch);
                xHttp.onreadystatechange = () =>{
                    if (xHttp.readyState === 4) {
                        if (xHttp.status === 200) {
                            /* retrieving response */
                            let result = xHttp.responseText;

                            if(result == "0"){
                                alert("Application Removed From the database");

                                let index = document.getElementById(buttonId).parentNode.parentNode.rowIndex;
                                document.getElementById('current').deleteRow(index);


                            }else{
                                alert("Application Failed to Remove from the database. Please report to admin. (1)");
                            }
                        } else {
                           alert("Application Failed to Remove from the database. Please report to admin. (2)");
                        }
                    } 
                };

                /* sending request */
                xHttp.send(null);
            }
        });
    }
}








