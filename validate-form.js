// Checks form inputs for proper values
// The form function could've been made with multiple layers
// I chose to separate them into different funcitons rather than keep one big function
// because each form had different behaviour depending on the form

// Validate search form
function validateSearchForm(form){

  // Grabs all input elements
  var elements = document.getElementsByTagName("input");
  var empty = true;

  // Checks for at least one filled field
  for (var i=0; i < elements.length; i++){
    if (elements[i].type.toLowerCase() == 'text' || elements[i].type.toLowerCase() == 'number'){
      if (elements[i].value != ""){
        empty=false;
      }
    }
  }

  if (empty === true) {
    alert("Please fill out at least one field");
    return false;
  }

  // Check if rating is valid
  if (form.rating.value != "" && validateRating(form.rating.value) === false){
    alert("Invalid rating");
    return false;
  }

  // Check if price is valid
  if (form.price.value != "" && validatePrice(form.price.value) === false){
    alert("Invalid price");
    return false;
  }

  // Check if distance is valid
  if (form.distance.value != "" && validateNum(form.distance.value) === false){
    alert("Invalid distance");
    return false;
  }


  return true;
}

// Validate register form
function validateRegisterForm(form){

  // Grabs all input elements
  var elements = document.getElementsByTagName("input")

  // Checks for empty fields in required inputs
  // and alerts the user for unfilled fields
  for (var i=0; i < elements.length; i++){
    if (elements[i].value == "" && elements[i].required === false){
      alert(elements[i].name + " required");
      return false;
    }
  }

  // Check email
  if (validateEmail(form.email.value) === false){
    alert("Not a valid email");
    return false;
  }

  // Check password
  if (validatePassword(form.password.value) === false){
    alert("Password must be at least eight characters, one letter and one number (no special characters)");
    return false;
  }

  // Check password
  if (form.password.value != form['password-repeat'].value){
    alert("Passwords must match");
    return false;
  }

  return true;
}

// Validate parking submission form
function validateParkingSubForm(form){

  // Grabs all input elements
  var elements = document.getElementsByTagName("input");

  // Checks for empty fields in required inputs
  // and alerts the user for unfilled fields
  for (var i=0; i < elements.length; i++){
    if (elements[i].value == "" && elements[i].required === true){
      alert(elements[i].name + " required");
      return false;
    }
  }

  // Check if latitude and longitude are valid
  if (form.latitude.value != "" && validateNum(form.latitude.value) === false){
    alert("Invalid latitude");
    return false;
  }

  if (form.longitude.value != "" && validateNum(form.longitude.value) === false){
    alert("Invalid longitude");
    return false;
  }

  return true;
}

// '/' starts and ends regular expression in javascript

// Validate email
function validateEmail(email){

  // Implemented a simple regex for emails
  // \S = matches with any non-white space characters
  // + = must happen at least once
  // string must contain one @
  // \S+\.\S+ = string.string
  var pattern = /\S+@\S+\.\S+/;
  return pattern.test(email);
}

// Validate password
// Password must be at least eight characters, one letter and one number (no special characters)
function validatePassword(psw){
  // .* = any character (.) to any amount (*).
  // (?=.*[A-Za-z]) = At least one character must be a letter (A-Z or a-z)
  // (?=.*\d) = At least one character must be a digit (0-9)
  // [A-Za-z\d] = Other characters can be a letter or number
  // {8,} = At least 8 characters
  var pattern = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
  return pattern.test(psw);
}

// Validate date
function validateDate(strDate){
  // (18|19|20)\d\d[-/] = year
  // (0[1-9]|1[012])[-/] = month
  // (0[1-9]|[12][09]|3[01])$ = day
  // \d is a digit (0-9)
  var pattern= /^(18|19|20)\d\d[-/](0[1-9]|1[012])[-/](0[1-9]|[12][09]|3[01])$/g;

  return pattern.test(strDate);
}

// Validate name
function validateName(name){
  // Accept any amount of regular letters with any punctuation
  // + makes sure the character happens at least once.
  var pattern = /^[a-z ,.'-]+$/i;

  return pattern.test(name);
}

// Validates ratings with steps of 0.5
function validateRating(rating){
  var pattern = /^[0-9]+$|^[0-9]+\.[05]$/;

  return pattern.test(rating);
}

// Validates prices in $ (example: 3535135.31)
function validatePrice(price){
  // Accepts whole numbers or floats to the 2nd decimal place
  var pattern = /^[0-9]+\.[0-9]{2}$|^[0-9]+$/;

  return pattern.test(price);
}

// Validates number allowing any number of digits after the decimal
function validateNum(num){
  pattern = /^[+-]?\d+(\.\d+)?$/;

  return pattern.test(num);
}
