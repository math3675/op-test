const showButton = document.querySelectorAll(".show-info");

showButton.forEach((element) => {
  element.addEventListener(click, theFunction);
});

function theFunction() {
  document.getElementById("demo").innerHTML = "YOU CLICKED ME!";
}
