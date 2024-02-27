window.addEventListener("DOMContentLoaded", function(){
    let mode = getMode();
    changeMode(mode);
});

function getMode(){
    let modeDetected = "";
    window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? modeDetected = "dark" : "light";
    let mode = window.localStorage.getItem("mode") || modeDetected;
    return mode;
}

function changeMode(mode){
    if(mode == "light"){ 
        document.body.classList.add("lightMode"); 
        document.body.classList.remove("darkMode")
     } else {
        document.body.classList.add("darkMode");
        document.body.classList.remove("lightMode");
     }
    window.localStorage.setItem("mode", mode);
}

function toggleMode(){
    if(getMode() == "light"){
        changeMode("dark");
    } else {
        changeMode("light");
    }
}