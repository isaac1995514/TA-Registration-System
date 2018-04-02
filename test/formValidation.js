
/* Notice that we are setting the function to call when submit is selected */
window.onload = main

/* This function must return true or false */
/* If true the data will be sent to the server */
/* If false the data will not be sent to the server */

function insert(){
     /* Retrieving the values */
     let studentId = document.getElementById("studentId").value;
     let firstName = document.getElementById("firstName").value;
     let middleName = document.getElementById("middleName").value;
     let lastName = document.getElementById("lastName").value;
     let email = document.getElementById("email").value;
     let phone = document.getElementById("phone").value;
     let gpa = document.getElementById("gpa").value;
     let entryYear = document.getElementById("entryYear").value;
     let entryTermArr = document.getElementsByName("entryYear");
     let entryTerm = null;
 
     for(let i = 0; i < entryTermArr.length; i++){
         if(entryTermArr[i].checked){
             entryTerm = entryTermArr[i].value;
             break;
         }
     }
 
     let studentType = document.getElementById("studentType").value;
     let adviser = document.getElementById("adviser").value;
     let masterArr = document.getElementsByName("msDegree");
     let master = null;
 
     for(let i = 0; i < masterArr.length; i++){
         if(masterArr[i].checked){
             master = masterArr[i].value;
             break;
         }
     }
    
     let str = `studentId: ${studentId}\n
                firstName: ${firstName}\n
                middleName: ${middleName}\n
                lastName: ${lastName}\n
                email: ${email}\n
                phone: ${phone}\n
                GPA: ${gpa}\n
                entryYear: ${entryYear}\n
                entryTerm: ${entryTerm}\n
                studentType: ${studentType}\n
                adviser: ${adviser}\n
                MsDegree: ${master}`

    alert(str);


}
function isEmpty(str) {
    return (!str || 0 === str.length);
}


function main() {
    console.log("HELLO");
    
}