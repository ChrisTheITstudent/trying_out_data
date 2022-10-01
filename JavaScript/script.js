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

// When a family is selected, show family login
familyLoginBtn.addEventListener("click", familyBtnClicked)
// // When an educator is selected, show educator login
educatorLoginBtn.addEventListener("click", educatorBtnClicked)
// get children's variable values
// make into an object
getData("familyData.json", testDataEl)
