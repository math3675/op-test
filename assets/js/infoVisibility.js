const showButton = document.querySelectorAll(".medarbejder-content");
var test = false;

showButton.forEach((element) => {
  console.log(element);

  element.addEventListener("click", displayPhone);

  function displayPhone() {
    const hideButton = element.querySelector(".hide-info");
    const showButton = element.querySelector(".show-info");
    const phoneNo = element.querySelector(".info .phone");

    if (test === false) {
      showButton.style.display = "none";
      hideButton.style.display = "block";
      phoneNo.style.display = "block";
      test = true;
    } else if (test === true) {
      showButton.style.display = "block";
      hideButton.style.display = "none";
      phoneNo.style.display = "none";
      test = false;
    }
  }
});
