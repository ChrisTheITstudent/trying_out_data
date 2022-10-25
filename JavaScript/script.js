
// Class for creating familys
class Family {
  constructor(familyName, password, childFirstName, childSecondName, childAge) {
    this.familyName = familyName;
    this.role = "family";
    this.password = password;
    this.children = {
      firstName: childFirstName,
      secondName: childSecondName,
      fullName: function () {
        let name = this.children.firstName + this.children.secondName;
        return name;
      },
      age: childAge,
      isAttending: "False"
    }
  }
}
// Class for creating educators
class Educator {
  constructor(educatorName, password, educatorRole, workingStatus) {
    this.role = "educator";
    this.name = educatorName;
    this.password = password;
    this.workingrole = educatorRole;
    this.workingStatus = workingStatus
  }
}
// HTML element declarations
const educatorLoginBtn = document.getElementById('educator-btn');
const familyLoginBtn = document.getElementById('family-btn');
const educatorLoginForm = document.getElementById('educator-form');
const familyLoginForm = document.getElementById('family-form');
const btnsEl = document.getElementById('buttons')
const createAccountEl = document.getElementById('create-account')
const submitAccountInfoEl = document.getElementById('submit-chd')
const noOfChildrenEl = document.getElementById('no-of-children')
const childForm = document.getElementById('repeat-form')

// document.getElementById("new-chd-form").style.display = "block";
//   document.getElementById("new-account").style.display = "none";

// This function validates the educator login form
function validateEducatorLogin(element) {
  let validate = document.forms["educator-form"]["name"].value;
  if (validate == "") {
    alert("Name can not be blank");
    return false;
  }
}
// This function validates the family login form
function validateFamilyLogin(element) {
  let validate = document.forms["family-form"]["familyname"].value;
  if (validate == "") {
    alert("Name can not be blank");
    return false;
  }
}
// This function displays the family login form when the family button clicked
// and hides the buttons
function familyBtnClicked() {
  document.getElementById("family").style.display = "flex";
  document.getElementById("buttons").style.display = "none";
}
// This function displays the educator login form when the educator button is clicked
// and hides the buttons
function educatorBtnClicked() {
  document.getElementById("educator").style.display = "flex";
  document.getElementById("buttons").style.display = "none";
}
// ----These functions deal with data----
// This function triggers the children's forms and hides the family form
// ####Change this so it listens for change in the dropdown selection####
function createFamilyAccount() {
  let target = document.forms["new-family"]["no-of-children"].value;  
}
// This function submits the new family account information
function submitFamilyAccount(object) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "Server-stuff(PHP)/start.php");
  xhttp.send(object);
  xhttp.close();
}

// ----Event listeners----
// Adds an event listener to the family login button
familyLoginBtn.addEventListener("click", familyBtnClicked)

// Adds an event listener to the educator login button
educatorLoginBtn.addEventListener("click", educatorBtnClicked)

// Adds an event listener to the family creation submit button
createAccountEl.addEventListener("submit", createFamilyAccount)

// Search familyName that coresponds to the login for the family's name
// return the family object
