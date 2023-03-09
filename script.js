window.onload=function(){
    console.log("window.onload called");
    // Get the button element by id
    const signupbtn=document.getElementById("signupbtn");

    // Check if the element exists before adding an event listener
    if (signupbtn !== null) {
      signupbtn.addEventListener("click", signupfn);
    } 
    else {
      console.error("Error: Could not find button element.");
    }
};
// for login button
function loginfn(){
  window.location.href = "login.php";
}
// for signup button
function signupfn(){ 
  window.location.href = "signup.php";
}


