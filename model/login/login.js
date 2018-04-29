window.onsubmit=validateForm;

function validateForm(){
  var phone = document.getElementById("phone").values;
  var invalidMessage = "";

  if (String(parseInt(phone)) !== phone) {
    invalidMessages += "Invalid phone number\n";
  }

  if (invalidMessages !== "") {
    alert(invalidMessages);
    invalidMessages = "";
    return false;
  }else {
    return true;
  }
}
