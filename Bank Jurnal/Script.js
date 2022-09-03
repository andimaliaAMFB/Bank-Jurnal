function overflow_body(isi) {
    var body = document.getElementsByTagName("body");
    
    Array.from(body).forEach((x) => {
        x.style.overflow = isi;
        if (isi == "hidden") {
            x.style.paddingRight = 17;
        }
        else {
            x.style.paddingRight = null;
        }
    })
}
function shade_show(isi) {
    var shade = document.getElementsByClassName("shade");
    Array.from(shade).forEach((x) => {
        if (isi == "show") {
            x.classList.add(isi);
        }
        else {
            x.classList.remove("show");
        }
    })
}
window.addEventListener('mouseup', function(event){
    console.log(event.target);

    var notif = document.getElementById("dropdown-notif");
    if (notif.style.display == "block") {
        if (event.target != notif && event.target.parentNode != notif && event.target.parentNode.parentNode != notif && event.target.parentNode.parentNode.parentNode != notif){
            console.log("===============");
            console.log(notif);
            console.log("Ended");
            console.log("===============");
            notif.style.display = "none";
        }
    }
    
    var prof = document.getElementById("dropdown-profile");
    if (prof.style.display == "block") {
        if (event.target != prof && event.target.parentNode != prof && event.target.parentNode.parentNode != prof){
            console.log("===============");
            console.log(prof);
            console.log("Ended");
            console.log("===============");
            prof.style.display = "none";
        }
    }
    
    var taskbar = document.getElementById("taskbar");
    if (taskbar.parentNode.style.display == "block") {
        console.log(taskbar);
        if (event.target != taskbar && event.target.parentNode != taskbar && event.target.parentNode.parentNode != taskbar && event.target.parentNode.parentNode.parentNode != taskbar && event.target.parentNode.parentNode.parentNode.parentNode != taskbar){
            console.log("taskbarEnd!!");
            taskbar.parentNode.style.display = "none";
            shade_show("remove");
        }
    }
    else if (taskbar.parentNode.style.display == "none") {
        if (event.target == document.getElementsByClassName("taskbar-btn")) {
            taskbar_function();
        }
    }
    

    var form_modal = document.getElementById("form");
    if (form_modal.parentNode.style.display == "block") {
        console.log(form_modal.parentNode);
        if (event.target == form_modal){
            console.log("FormEnd!!");
            form_modal.parentNode.style.display = "none";
            shade_show("remove");
            overflow_body("auto");
        }
    }
    var prodi = document.getElementById("dropdown-final");
    var lbl_1_prodi = document.getElementById("search-prodi");
    var lbl_2_prodi = document.getElementById("select-prodi");
    if (event.target != prodi && event.target.parentNode != prodi.parentNode){
        prodi.style.display = "none";
        prodi.parentNode.style.boxShadow = "inset 0px 4px 4px rgba(0, 0, 0, 0.25)";
        prodi.parentNode.style.backgroundColor = "#EFF6E3";
        lbl_1_prodi.style.color = "rgba(0, 0, 0, .5)";
        lbl_2_prodi.style.color = "rgba(0, 0, 0, .5)";
        prodi.style.color = "rgba(0, 0, 0, 1)";
    }  
    
    var pnl = document.getElementById("dropdown-pnl");
    var lbl_1_pnl = document.getElementById("search-pnl");
    var lbl_2_pnl = document.getElementById("select-pnl");
    if (event.target != pnl && event.target.parentNode != pnl.parentNode){
        pnl.style.display = "none";
        pnl.parentNode.style.boxShadow = "inset 0px 4px 4px rgba(0, 0, 0, 0.25)";
        pnl.parentNode.style.backgroundColor = "#EFF6E3";
        lbl_1_pnl.style.color = "rgba(0, 0, 0, .5)";
        lbl_2_pnl.style.color = "rgba(0, 0, 0, .5)";
        pnl.style.color = "rgba(0, 0, 0, 1)";
    }  

    var final = document.getElementById("dropdown-prodi");
    var lbl_1_final = document.getElementById("search-final");
    var lbl_2_final = document.getElementById("select-final");
    if (event.target != final && event.target.parentNode != final.parentNode){
        final.style.display = "none";
        final.parentNode.style.boxShadow = "inset 0px 4px 4px rgba(0, 0, 0, 0.25)";
        final.parentNode.style.backgroundColor = "#EFF6E3";
        lbl_1_final.style.color = "rgba(0, 0, 0, .5)";
        lbl_2_final.style.color = "rgba(0, 0, 0, .5)";
        final.style.color = "rgba(0, 0, 0, 1)";
    }  

    
    if (event.target.classList == "pointer") {
        var table = document.getElementById(event.target.id);
        // console.log(event.target.id);
        if (table.parentNode.nextElementSibling.style.display === "none") {
            table.parentNode.nextElementSibling.style.display = "table-row";
        }
        else {
            table.parentNode.nextElementSibling.style.display = "none";
        }
    }
});


function dropdown_notif(){
    var drop = document.getElementById("dropdown-notif");
    if (drop.style.display === "none") {
        drop.style.display = "block";
    }
}
function dropdown_profile(){
    var prof = document.getElementById("dropdown-profile");
    if (prof.style.display === "none") {
        prof.style.display = "block";
    }
}
function taskbar_function() {
    var taskbar = document.getElementsByClassName("taskbar-isi");
    Array.from(taskbar).forEach((x) => {
        if (x.style.display === "none") {
            x.style.display = "block";
            x.classList.add("show");
            shade_show("show");
            console.log("OpenTaskbar!!");
        }
    });
}
function form_function() {
    var form = document.getElementsByClassName("form-modal");
    Array.from(form).forEach((x) => {
        if (x.style.display == "none") {
            x.style.display = "block";
            x.classList.add("show");
            shade_show("show");
            overflow_body("hidden");
            console.log("OpenForm!!");
        }
    });
}

function dropdown_final(){
    var prof = document.getElementById("dropdown-final");
    var lbl_1 = document.getElementById("search-final");
    var lbl_2 = document.getElementById("select-final");
    var btn = document.getElementById("final-select");
    if (prof.style.display === "none") {
        btn.style.boxShadow = "none";
        prof.style.display = "block";
        lbl_1.style.color = "#FFFFFF";
        lbl_2.style.color = "#FFFFFF";
        btn.style.backgroundColor = "#A8D470";
    }
}
function dropdown_penulis(){
    var pnl = document.getElementById("dropdown-pnl");
    var lbl_1 = document.getElementById("search-pnl");
    var lbl_2 = document.getElementById("select-pnl");
    var btn = document.getElementById("pnl-select");
    if (pnl.style.display == "none") {
        btn.style.boxShadow = "none";
        pnl.style.display = "block";
        lbl_1.style.color = "#FFFFFF";
        lbl_2.style.color = "#FFFFFF";
        btn.style.backgroundColor = "#A8D470";
    }
}
function dropdown_select(){
    var prof = document.getElementById("dropdown-prodi");
    var lbl_1 = document.getElementById("search-prodi");
    var lbl_2 = document.getElementById("select-prodi");
    var btn = document.getElementById("prodi-select");
    if (prof.style.display === "none") {
        btn.style.boxShadow = "none";
        prof.style.display = "block";
        lbl_1.style.color = "#FFFFFF";
        lbl_2.style.color = "#FFFFFF";
        btn.style.backgroundColor = "#A8D470";
    }
}