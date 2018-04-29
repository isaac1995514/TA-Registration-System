window.onsubmit = validateData;

window.onload = validateLinks;

function validateData(){
    
    // Check if the department is valid
    let invalidMessages = "";
    let department = ["Astronomy",
                    "Biology",
                    "Computer Science",
                    "Dance",
                    "Education",
                    "Film Studies",
                    "Government and Politics",
                    "History",
                    "Italian",
                    "Japanese"];

    // Validate phone number
    let phoneNumber = String(document.getElementById('phone').value);
    let parts = phoneNumber.split("-");
    if(parts.length != 3
        || parts[0].length != 3 || parts[1].length != 3 || parts[2].length != 4
        || isNaN(parts[0]) || isNaN(parts[1] || isNaN(parts[2]))){
            invalidMessages += "Phone Number must be in the following format '###-###-####'\n";
    }

    // Validate department name
    let departmentName = document.getElementById("departmentName").value;
   
    if(!contains(department, departmentName)){
        invalidMessages += "Invalid Department!\n";
    }

    // Validate entry semester
    let entryYear = document.getElementById('entryYear').value;
    let entryYearNum = Number(entryYear);

    if(isNaN(entryYear)){
        invalidMessages += "Entry Year must be a number!\n"
    }else if(entryYearNum < 2010 || entryYearNum > 2018){
        invalidMessages += "Entry Year must be in range of [2010, 2018]!\n";
    }



    // Check if the last three options are correctly selected
    
    let foreignStudent = document.getElementById('foreignStudent').value;
    let meiTest = document.getElementById('emiTestPassed').value;
    let currentMEI = document.getElementById('currentEMI').value;
 
    // If you are a foreign student
    if(foreignStudent == "1"){
        if(meiTest == "-1" || currentMEI == "-1"){
            invalidMessages += "You are a foreign student. You are require to fill in your MEI test and course status!";
        }
    // If you are not a foreign student
    }else{
        if(meiTest != "-1" || currentMEI != "-1"){
            invalidMessages += "You are not a foreign stuent. MEI Test and course should not selected!";
        }
    }

    if(invalidMessages.length == 0){
        return (window.confirm('Do you want to submit the form data?')) ? true : false;
    }else{
        alert(invalidMessages);
        return false;
    }

   
}

function validateLinks(){

    let errorMsg = document.getElementById('errorMsg').innerHTML;

    if(errorMsg != ""){
        // Disable all other functions
        document.getElementById('newApp').style.visibility = 'hidden';
        document.getElementById('viewApp').style.visibility = 'hidden';
        document.getElementById('comments').style.visibility = 'hidden';
    }
}

function contains(arr, str) {
    for(let i = 0; i < arr.length; i++){
        if(arr[i].toUpperCase() === str.toUpperCase()){
            return true;
        }
    }
    return false;
}

