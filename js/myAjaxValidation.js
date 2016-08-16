function AjaxValidateName(){   
  var userInputName = document.getElementById("naam").value;
  userInputName=userInputName.trim();
  var nameLength = userInputName.length;
  if(userInputName === ""){
    nameError="Vul hier uw naam in."
    document.getElementById("nameErr").innerHTML =nameError; 
  }
  else if(userInputName.search(/^[A-Za-z\-\' ]+$/)=== -1){  
    nameError="Gelieve alleen letters en spaties te gebruiken."
    document.getElementById("nameErr").innerHTML =nameError;      
  }  
  else if (nameLength > 40){
    nameError="Gelieve hier alleen uw naam in te vullen."
    document.getElementById("nameErr").innerHTML =nameError;      
  }
  else {
    nameError=" "
    document.getElementById("nameErr").innerHTML =nameError; 
  }
}  

function AjaxValidateEmail(){ 
  var userInputEmail = document.getElementById("email").value;
  userInputEmail=userInputEmail.trim();
  var regexMail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(userInputEmail === ""){
    mailError="Vul hier uw E-mail adres in."
    document.getElementById("mailErr").innerHTML =mailError; 
  }
  else if (regexMail.test(userInputEmail)=== false){
    mailError="E-mail format is niet juist."
    document.getElementById("mailErr").innerHTML =mailError; 
  }
  else {
    mailError=" "
    document.getElementById("mailErr").innerHTML =mailError; 
  }
}

function AjaxValidateMessage(){ 
  var userInputMessage = document.getElementById("message").value;
  userInputMessage=userInputMessage.trim();
  var messageLength = userInputMessage.length;
  if(userInputMessage === ""){
    messageError="Vul hier nog uw vragen of opmerkingen in."
    document.getElementById("messageErr").innerHTML =messageError; 
  }
  else if (messageLength > 2000){
    messageError="Sorry, dit bericht is te lang. Gelieve niet meer dan 2000 karakters te gebruiken."
    document.getElementById("messageErr").innerHTML =messageError; 
  }
  else {
    messageError=" "
    document.getElementById("messageErr").innerHTML =messageError; 
  }
}