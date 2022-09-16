function overflow_body(isi) {
    var body = document.getElementsByTagName("body");
    
    Array.from(body).forEach((x) => {
        x.style.overflow = isi;
    })
    if (isi == "hidden") {
        document.getElementById("head-isi").style.paddingRight = (32 + 17);
        document.getElementById("main-isi").style.paddingRight = 17;
    }
    else {
        document.getElementById("head-isi").style.paddingRight = null;
        document.getElementById("main-isi").style.paddingRight = null;
    }
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

    if (event.target.classList == "btn pointer") {
        //console.log(event.target.parentNode.getAttribute('data-id'));
        form_inside(event.target.parentNode.getAttribute('data-id'));
    }
    
    if (event.target.classList == "pointer") {
        var parent = event.target.parentNode;
        if (parent.classList.contains("parent")) {
            parent.classList.remove("parent");
            parent.nextSibling.remove();
        }
        else {
            parent.classList.add("parent");
            var child = document.createElement("div");
            if (parent.nextSibling) {
                parent.parentNode.insertBefore(child, parent.nextSibling);
            }
            else {
                parent.parentNode.appendChild(child);
            }
            child.classList.add("child");
            var loc = parent.nextElementSibling;
            var input = `<div class="form_sub row" id="lama">
                    <div class="md5 form_sub_title">Status Lama</div>
                    <div>[Status Lama]</div>
                </div>
                <div class="form_sub row" id="baru">
                    <div class="md5 form_sub_title">Status Baru</div>
                    <div>[Status Baru]</div>
                </div>
                <div class="form_sub row" id="catatan">
                    <div class="md5 form_sub_title">Catatan</div>
                    <div>[Catatan Revisi Yang diberikan Oleh Admin]</div>
                </div>
                <div class="link" id="see_article">Lihat Artikel></div>`;
            loc.innerHTML = input;
        }
    }
});

function form_height() {
    console.log(document.getElementById("form").clientHeight);
    if (document.getElementById("form").clientHeight >= window.innerHeight) {
        console.log("bigger");
        overflow_body("hidden");
    }
    else{
        console.log("smaller");
        overflow_body("auto");
    }
}

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
            // console.log("OpenForm!!");
        }
    });
}
function form_inside(id) {
    form_function();
    console.log(id);
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

// tabel list
const list_items = [
	"Item 1",
	"Item 2",
	"Item 3",
	"Item 4",
	"Item 5",
	"Item 6",
	"Item 7",
	"Item 8",
	"Item 9",
	"Item 10",
	"Item 11",
	"Item 12",
	"Item 13",
	"Item 14",
	"Item 15",
	"Item 16",
	"Item 17",
	"Item 18",
	"Item 19",
	"Item 20",
	"Item 21",
	"Item 22"
];
const finalize = [];
for (let i = 0; i < list_items.length; i++) {
    var arr = ["Yes", "No"];
    var select = Math.floor(Math.random() * (arr.length - 1 + 1) + 1); 
    finalize.push(arr[select-1]);
}
console.log(finalize);

var final_select = document.querySelector('#dropdown-final ul .active').innerHTML;
document.querySelector('#select-final').innerHTML = final_select;

finalize_items = [];
for (let index = 0; index < list_items.length; index++) {
    if (finalize[index] == final_select) { finalize_items.push(list_items[index]); }
    else if (final_select == "All") { finalize_items = list_items; }
}
console.log("finalize_items",finalize_items);

const list_element = document.querySelector('#list_wrapper div table tbody');
const count = document.getElementById('article_pagination_count');
const current = document.getElementById('no_loc_artikel');
const pagination_element = document.getElementById('article_pagination');

let current_page = 1;
let rows = 10;


function DisplayList (items, wrapper, rows_per_page, page) {
	wrapper.innerHTML = "";
	page--;

	let start = rows_per_page * page;
	let end = start + rows_per_page;
    paginatedItems = items.slice(start, end);

    let result = '';
	for (let i = 0; i < paginatedItems.length; i++) {
        let item = paginatedItems[i];
        console.log("Finalize is = ",final_select);
        result += `<tr  data-id="`+(i+1)+`">
        <td> Judul Artikel `+item+`</td>
        <td> Penulis `+item+`</td>
        <td> Program Studi `+item+`</td>
        <td class="btn pointer">View</td>
        </tr>`;
		
	}
    list_element.innerHTML = result;
    current.innerHTML = current_page;
    console.log(current_page);
    count.innerHTML = paginatedItems.length +" of " + items.length + " Article";
}

document.querySelector('#next_btn_artikel').addEventListener('click', nextPage, false);
document.querySelector('#last_btn_artikel').addEventListener('click', lastPage, false);
document.querySelector('#prev_btn_artikel').addEventListener('click', previousPage, false);
document.querySelector('#first_btn_artikel').addEventListener('click', firstPage, false);

function previousPage() {
    if(current_page > 1) current_page--;
    DisplayList(finalize_items, list_element, rows, current_page);
}
function firstPage() {
    current_page = 1;
    DisplayList(finalize_items, list_element, rows, current_page);
}

function nextPage() {
    if((current_page * rows) < finalize_items.length) current_page++;
    DisplayList(finalize_items, list_element, rows, current_page);
}
function lastPage() {
    current_page = Math.ceil(finalize_items.length/rows);
    DisplayList(finalize_items, list_element, rows, current_page);
}
DisplayList(finalize_items, list_element, rows, current_page);
