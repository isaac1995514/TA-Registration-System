window.onsubmit = validateData;

function validateData(){
    

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
    let departmentName = document.getElementById("departmentName").value;
   
    if(!contains(department, departmentName)){
        invalidMessages += "Invalid Department!";
    }

    if(invalidMessages.length == 0){
        return (window.confirm('Do you want to submit the form data?')) ? true : false;
    }else{
        alert(invalidMessages);
        return false;
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

