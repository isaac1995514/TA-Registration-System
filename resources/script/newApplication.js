window.onsubmit = validateData;

function validateData(){

    invalidMessages = "";

    // Get Cookies Map
    let cookieMap = getCookieMap();
    let nextSemesterYear = cookieMap.get("nextSemesterYear");
    let nextSemesterTerm = cookieMap.get("nextSemesterTerm");

    // Validate entry semester
    let academicYear = document.getElementById('academicYear').value;
    let term = document.getElementById('term').value;

    // Check if year is a number
    if(isNaN(academicYear)){
        invalidMessages += "Academic Year must be a number!\n"
    }

    // Check if the following semester and term is selected
    if(academicYear != nextSemesterYear || term != nextSemesterTerm){
        invalidMessages += `TA Application is only available for ${nextSemesterYear} ${nextSemesterTerm}`;
    }

    if(invalidMessages.length == 0){
        return (window.confirm('Do you want to submit the form data?')) ? true : false;
    }else{
        alert(invalidMessages);
        return false;
    }  
}

function getCookieMap(){

    let cookies = document.cookie.split(/;/g);
    let cookieMap = new Map();

    for(let cookie of cookies){
        let [key, value] = cookie.split("=");
        cookieMap.set(key.trim(), value.trim());
    }
    return cookieMap;
} 


function contains(arr, str) {
    for(let i = 0; i < arr.length; i++){
        if(arr[i].toUpperCase() === str.toUpperCase()){
            return true;
        }
    }
    return false;
}

