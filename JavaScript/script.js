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

class Educator {
  constructor(educatorName, password, educatorRole, workingStatus) {
    this.role = "educator";
    this.name = educatorName;
    this.password = password;
    this.workingrole = educatorRole;
    this.workingStatus = workingStatus
  }
}

const educatorLoginBtn = document.getElementById('educator-btn');
const familyLoginBtn = document.getElementById('family-btn');
const educatorLoginForm = document.getElementById('educator-form');
const familyLoginForm = document.getElementById('family-form');
const testDataEl = document.getElementById('tester-data');

function validateEducatorLogin(element) {
  let validate = document.forms["educator-form"]["name"].value;
  if (validate == "") {
    alert("Name can not be blank");
    return false;
  }
}
function validateFamilyLogin(element) {
  let validate = document.forms["family-form"]["familyname"].value;
  if (validate == "") {
    alert("Name can not be blank");
    return false;
  }
}
function familyBtnClicked() {
  document.getElementById("family").style.display="block";
}
function educatorBtnClicked() {
  document.getElementById("educator").style.display="block";
}
function sendDataRequest(elementId) {
  const dataRequest = new XMLHttpRequest();
  // response.setHeader("Access-Control-Allow-Origin", "*");
  dataRequest.onload = function(){
     obj = JSON.parse(this.responseText);
     elementId.innerHTML = obj.familyName;
  }
  dataRequest.open("GET", "JavaScript/familyData.json");
  dataRequest.send();
}

// When a family is selected, show family login
familyLoginBtn.addEventListener("click", familyBtnClicked)
// // When an educator is selected, show educator login
educatorLoginBtn.addEventListener("click", educatorBtnClicked)

sendDataRequest(testDataEl)

// Make create family option
// save the object in the JSON file

// Search familyName that coresponds to the login for the family's name
// return the family object
