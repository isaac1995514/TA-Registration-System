window.onload = setUp;
window.onsubmit = validateData;

function setUp(){

    "use strict";

    var randomValueToAvoidCache = (new Date()).getTime();       // Random value used to avoid cache
    let allButtons = document.getElementsByTagName('img');

    // HideShow Button
    document.getElementById('hideShow').addEventListener('click', ()=>{
        let fieldset = document.getElementById('filter');

        if(fieldset.style.display === "none"){
            fieldset.style.display = "block";
        }else{
            fieldset.style.display = "none";
        }
    })

    // Set up Buttons

    for(let btn of allButtons){
        let buttonId = String(btn.getAttribute('id'));
        let appId = buttonId.split('@')[1].trim();
        let rowIdx = btn.parentNode.parentNode.rowIndex;
        let studentId = btn.parentNode.parentNode.parentNode.rows[rowIdx].cells[0].innerHTML;
        let courseCode = btn.parentNode.parentNode.parentNode.rows[rowIdx].cells[6].innerHTML;
        let academicYear = btn.parentNode.parentNode.parentNode.rows[rowIdx].cells[4].innerHTML;
        let term = btn.parentNode.parentNode.parentNode.rows[rowIdx].cells[5].innerHTML;
        let taType = btn.parentNode.parentNode.parentNode.rows[rowIdx].cells[7].innerHTML;
        let canTeach = btn.parentNode.parentNode.getAttribute('class');
    
        // Check what type of button
        if(btn.getAttribute('class') == "assignBtn"){
            btn.addEventListener('click', () =>{
            
                let confirmation = confirm(`Are you sure to assign this student to ${courseCode}`);

                if(confirmation){
                    let section = prompt("Do you wish to assign him/her to a specific section? (Click cancel for any section)");

                    let xHttp = new XMLHttpRequest();
                let params = `?appId=${appId}&
                                studentId=${studentId}&
                                courseCode=${courseCode}&
                                section=${section}&
                                academicYear=${academicYear}&
                                term=${term}&
                                taType=${taType}&
                                canTeach=${canTeach}`;
                let url = "./../../model/ajaxScript/insertTA.php"
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

                            let resultArr = xHttp.responseText.split('|');
                            let errorCode = resultArr[0];
                            let message = resultArr[1];
                        
                            if(errorCode == "0"){
                                window.location.reload(true);
                            }

                            alert(message);
                        } else {
                           alert("Failed to Assing Student as TA to the database. Please report to admin. (2)");
                        }
                    } 
                };

                /* sending request */
                xHttp.send(null);
                }
            })
        }
    }
}

function validateData(){

    "use strict";

    let errorMsg = "";

    let studentId = String(document.getElementById('studentId').value);

    if(studentId != "" && studentId.length != 8 || isNaN(studentId)){
        errorMsg += "Student Id's format is incorrent\n";
    }

    let course = String(document.getElementById('course').value);

    // CMSC433 or CMSC389N
    if(course != "" && (course.length < 7 || course.length > 8)){
        errorMsg += "Course's length is incorrect\n";
    }else{

        if(course != ""){
            if(course.length == 7 && (!isLetter(course.substring(0,4)) || isNaN(course.substring(4,7)))){
                errorMsg += "Please follow the input format 'CMSC###'\n"; 
            }

            if(course.length == 8 && (!isLetter(course.substring(0,4)) || isNaN(course.substring(4,7)) || !isLetter(course.charAt(7)))){
                errorMsg += "Please follow the input format 'CMSC###(Alphabet)'\n"; 
            }
        }
    }

    if(errorMsg.length == 0){
        document.getElementById('filter').style.display = "none";
        return true;
    }else{
        alert(errorMsg);
        return false;
    }
}

function isLetter(str) {
    for (let i = 0; i < str.length; i++) {
      let code = str.charCodeAt(i);
      if (!(code > 64 && code < 91) && // upper alpha (A-Z)
          !(code > 96 && code < 123)) { // lower alpha (a-z)
        return false;
      }
    }
    return true;
  };