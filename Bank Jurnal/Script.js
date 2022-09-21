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
    // console.log(event.target);

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
        if (event.target == form_modal || event.target.classList == "btn"){
            console.log("FormEnd!!");
            form_modal.parentNode.style.display = "none";
            shade_show("remove");
            overflow_body("auto");
            
            var parent = document.querySelector('.history_form');
            parent.innerHTML = '';
        }
        document.getElementById("form-status").onsubmit = function() {
            //ubah finalize menjadi Yes
            alert("The form was submitted");
            return false;
        }
    }
    var judul = document.getElementById("dropdown-jdl");
    if (event.target != judul && event.target.parentNode != judul.parentNode){
        judul.style.display = "none";
        document.getElementById("jdl-search").classList.remove("active");
    }

    var prodi = document.getElementById("dropdown-prodi");
    if (event.target != prodi && event.target.parentNode != prodi.parentNode){
        prodi.style.display = "none";
        document.getElementById("prodi-select").classList.remove("active");
    }
    if (prodi.contains(event.target)) {
        if (event.target.parentNode.classList.contains("select-droped")) {
            if (document.querySelector('#prodi-select .drop-select ul .active')) {
                document.querySelector('#prodi-select .drop-select ul .active').classList.remove("active");
            }
            event.target.classList.add("active");
            document.querySelector('#select-prodi').innerHTML = event.target.innerHTML;
            prodi.style.display = "none";
            changeFinal();
        }
    }
    
    var pnl = document.getElementById("dropdown-pnl");
    if (event.target != pnl && event.target.parentNode != pnl.parentNode){
        pnl.style.display = "none";
        document.getElementById("pnl-select").classList.remove("active");
    }  
    if (pnl.contains(event.target)) {
        if (event.target.parentNode.classList.contains("select-droped")) {
            if (document.querySelector('#pnl-select .drop-select ul .active')) {
                document.querySelector('#pnl-select .drop-select ul .active').classList.remove("active");
            }
            event.target.classList.add("active");
            document.querySelector('#select-pnl').innerHTML = event.target.innerHTML;
            pnl.style.display = "none";
            changeFinal();
        }
    }

    var final = document.getElementById("dropdown-final");
    if (event.target != final && event.target.parentNode != final.parentNode){
        final.style.display = "none";
        document.getElementById("final-select").classList.remove("active");
    } 
    if (final.contains(event.target)) {
        document.querySelector('#final-select .drop-select ul .active').classList.remove("active");
        event.target.classList.add("active");
        document.querySelector('#select-final').innerHTML = event.target.innerHTML;
        final.style.display = "none";
        changeFinal();
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
            var last_list = parent.parentNode.lastElementChild;

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
                
            if (last_list == parent) {
                console.log("Ini adalah element terakhir ",parent);
                input = `<div class="form_sub row" id="lama">
                        <div class="md5 form_sub_title">Status Lama</div>
                        <div>[Status Lama]</div>
                    </div>
                    <div class="form_sub row" id="baru">
                        <div class="md5 form_sub_title">Status Baru</div>
                        <div>
                            <select name="" id="tabel_status_change">
                                <option  disabled selected value>[Status Baru]</option>
                                <option value="">Draft</option>
                                <option value="">Revisi Minor</option>
                                <option value="">Revisi Mayor</option>
                                <option value="">Layak Publish</option>
                            </select>
                        </div>
                    </div>
                    <div class="form_sub row" id="catatan">
                        <div class="md5 form_sub_title">Catatan</div>
                        <div>
                            <textarea name="" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]"></textarea>
                        </div>
                    </div>
                    <div class="link" id="see_article">Lihat Artikel></div>`;
            }
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
            console.log("OpenForm!!");
        }
    });
}
function form_inside(id) {
    form_function();
    console.log("id: ",id);

    n_history = count_history[id];
    console.log("n_history = ",n_history);
    var parent = document.querySelector('.history_form');
    
    for (let i = 0; i < n_history; i++) {
        console.log("history ke: ",i+1);
        var child = document.createElement("div");
        parent.appendChild(child);

        child.classList.add("history_list");
        child.classList.add("row");

        if (i != 0) {
            child.classList.add("border-top");
        }

        console.log("position is ",parent.lastElementChild);
        var loc = parent.lastElementChild;
        var input = `<div class="date_up">MM/DD/YY</div>
            <span></span>
            <div class="pointer">V</div>`;
        loc.innerHTML = input;
    }
}
function dropdown(id){
    var prof = document.getElementById(id);
    var parent = prof.parentNode;
    console.log(parent);
    if (prof.style.display === "none") {
        prof.style.display = "block";
        parent.classList.add("active");
        if (parent.id.includes("final-select")) {
            
        }
        else {
            var input;
            if (parent.id.includes("jdl")) {
                input = document.querySelector('.active form input');
            }
            else {
                input = document.querySelector('.active .drop-select .select-search form input');
            }
            suggestionBar(input,parent.id);
        }
    }
}
// function dropdown_penulis(){
//     var pnl = document.getElementById("dropdown-pnl");
//     var lbl_1 = document.getElementById("search-pnl");
//     var lbl_2 = document.getElementById("select-pnl");
//     var btn = document.getElementById("pnl-select");
//     if (pnl.style.display == "none") {
//         btn.style.boxShadow = "none";
//         pnl.style.display = "block";
//         lbl_1.style.color = "#FFFFFF";
//         lbl_2.style.color = "#FFFFFF";
//         btn.style.backgroundColor = "#A8D470";
//     }
// }
// function dropdown_select(){
//     var prof = document.getElementById("dropdown-prodi");
//     var lbl_1 = document.getElementById("search-prodi");
//     var lbl_2 = document.getElementById("select-prodi");
//     var btn = document.getElementById("prodi-select");
//     if (prof.style.display === "none") {
//         btn.style.boxShadow = "none";
//         prof.style.display = "block";
//         lbl_1.style.color = "#FFFFFF";
//         lbl_2.style.color = "#FFFFFF";
//         btn.style.backgroundColor = "#A8D470";
//     }
// }

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

//banyak histori dalam 1 artikel
const count_history = [];
for (let i = 0; i < list_items.length; i++) {
    count_history.push(Math.floor(Math.random() * (4 - 2 + 1) + 1));
}
// console.log(count_history);

//Keterangan finalize tiap artikel
const finalize = [];
for (let i = 0; i < list_items.length; i++) {
    var arr = ["Yes", "No"];
    var select = Math.floor(Math.random() * (arr.length - 1 + 1) + 1); 
    finalize.push(arr[select-1]);
}
// console.log(finalize);
final_count = 0;
for (let i = 0; i < finalize.length; i++) {
    if (finalize[i]=="No") {
        final_count += 1;
    }
    
}

// Keterangan penulis
var loc_penulis = document.querySelector('#pnl-select .drop-select .select-droped');
var loc_prodi = document.querySelector('#prodi-select .drop-select .select-droped');

var arr = ["1", "2", "3", "4", "5"];
const penulis = [];
const prodi = [];
var input_penulis = " ";
var input_prodi = " ";

let suggestions = [];

for (let i = 0; i < arr.length; i++) {
    if (i==0) {
        input_penulis += `<li>>--Pilih Semua--<</li>`
        input_prodi += `<li>>--Pilih Semua--<</li>`        
        suggestions.push(">--Pilih Semua--<");
    }
    input_penulis += `<li>Penulis Item `+(arr[i])+`</li>`
    input_prodi += `<li>Program Studi Item `+(arr[i])+`</li>`
    suggestions.push("Penulis Item "+arr[i]);
}
// penulis & prodi per list
for (let i = 0; i < list_items.length; i++) {
    var select = Math.floor(Math.random() * (arr.length - 1 + 1) + 1); 
    penulis.push("Penulis Item "+arr[select-1]);
    prodi.push("Program Studi Item "+arr[select-1]);
}
loc_penulis.innerHTML = input_penulis;
loc_prodi.innerHTML = input_prodi;

// console.log(suggestions);
var string = "Penulis Item 2";
// console.log("string.includes('Item')",string.includes("Item"));
// se-se-bar
// function SeSeBar() {
//     console.log(document.getElementById('s-se-pnl').value);
//     let search = document.getElementById('s-se-pnl').value;
//     // if (search.value == "") {
//     //     penulis_list();
//     // }
//     // else {
//     //     input_penulis = "";
//     //     for (let i = 0; i < penulis.length; i++) {
//     //         if (penulis[i].includes(search)) {
//     //             input_penulis += `<li>Penulis Item `+(arr[i])+`</li>`
//     //         }
//     //     }
//     //     loc_penulis.innerHTML = input_penulis;
//     // }
// }

// getting all required elements

function suggestionBar(input_box, parent_id) {
    console.log("input_box (suggestionBar())",input_box);
    
    // if user press any key and release
    input_box.onkeyup = (e)=>{
        let userData = e.target.value; //user enetered data
        let emptyArray = [];
        if(userData){
            console.log("==============================================");
            emptyArray = suggestions.filter((data)=>{
                //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
                // console.log("hh");
                // console.log(data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()));
                return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()); 
            });
            console.log("userData: ",userData);
            emptyArray = emptyArray.map((data)=>{
                // passing return data inside li tag
                // console.log(data," includes ",userData,data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()));
                if (data.toLocaleLowerCase().includes(userData.toLocaleLowerCase())) {
                    return data = '<li>'+ data +'</li>';
                }
            });
            console.log("emptyArray",emptyArray);
            showSuggestions(emptyArray,parent_id);
        }
        else{
            showSuggestions(emptyArray,parent_id);
        }
    }
    function showSuggestions(list,parent_id){
        let listData;
        let parent = document.getElementById(parent_id);
        var loc_list = parent.querySelector('.drop-select .select-droped');
        if(!list.length){
            userValue = input_box.value;
            if (!userValue || userValue.includes(" ")) {
                listData = "";
                for (let i = 0; i < suggestions.length; i++) {
                    listData += `<li>`+(suggestions[i])+`</li>`
                }
            }
            else{
                listData = '<li><b>Nothing Found<b></li>';
            }
        }else {
            listData = list.join('');
        }
        loc_list.innerHTML = listData;
    }
}

// Change Finale lineup
var final_select = document.querySelector('#select-final').innerHTML;
var penulis_select = document.querySelector('#select-pnl').innerHTML;
var prodi_select = document.querySelector('#select-prodi').innerHTML;
function changeFinal() {
    final_select = document.querySelector('#select-final').innerHTML;
    document.querySelector('#select-final').innerHTML = final_select;

    penulis_select = document.querySelector('#select-pnl').innerHTML;
    document.querySelector('#select-pnl').innerHTML = penulis_select;

    prodi_select = document.querySelector('#select-prodi').innerHTML;
    document.querySelector('#select-prodi').innerHTML = prodi_select;

    // console.log("final_select:",final_select,"\npenulis_select:",penulis_select,"\nprodi_select:",prodi_select);
    finalRender(final_select, penulis_select, prodi_select);
}


//lokasi teks dsb yang akan diganti
const list_element = document.querySelector('#list_wrapper div table tbody');
const count = document.getElementById('article_pagination_count');
const current = document.getElementById('no_loc_artikel');
const pagination_element = document.getElementById('article_pagination');

let current_page = 1;
let rows = 10;


function DisplayList (items, penulis, prodi, wrapper, rows_per_page, page) {
	wrapper.innerHTML = "";
	page--;

    
	let start = rows_per_page * page;
	let end = start + rows_per_page;
    paginatedItems = items.slice(start, end);

    let result = '';
	for (let i = 0; i < paginatedItems.length; i++) {
        let item = paginatedItems[i];
        // console.log("Finalize is = ",final_select);
        result += `<tr  data-id="`+(i+1)+`">
        <td> Judul Artikel `+item+`</td>
        <td> `+penulis[i]+`</td>
        <td> `+prodi[i]+`</td>
        <td class="btn pointer">View</td>
        </tr>`;
	}
    list_element.innerHTML = result;
    current.innerHTML = current_page;
    // console.log(current_page);
    count.innerHTML = paginatedItems.length +" of " + items.length + " Article";
}


//list yang digunakan dalam list tabel
finalize_items = list_items;
final_finalize = finalize;
final_penulis = penulis;
final_prodi = prodi;
function finalRender(final_select, penulis_select) {
    // csonsole.log("================ Start Render ================");
    finalize_items = [];
    final_finalize = [];
    final_penulis = [];
    final_prodi = [];
    // console.log("list_items: ",list_items);
    // console.log("finalize_items: ",finalize_items, "\nfinal_penulis: ",final_penulis);
    // console.log("============== Finalize Start ==============");
    if (final_select != "All") {
        for (let index = 0; index < list_items.length; index++) {
            if (finalize[index] == final_select)
            {
                finalize_items.push(list_items[index]); 
                final_finalize.push(finalize[index]); 
                final_penulis.push(penulis[index]); 
                final_prodi.push(prodi[index]); 
            }
        }
    }
    else if (final_select == "All") {
        finalize_items = [].concat(list_items);
        final_finalize = [].concat(finalize);
        final_penulis = [].concat(penulis);
        final_prodi = [].concat(prodi);
    }
    // console.log("finalize_items",finalize_items, "final_penulis",final_penulis);
    // console.log("============== Finalize Checked ==============");
    

    // console.log("============== Penulis Start ==============");
    if (((penulis_select == "&gt;--Pilih Penulis--&lt;") || (penulis_select == "&gt;--Pilih Semua--&lt;"))) {
        // nothing to do here
    }
    else {
        for (let index = 0; index < finalize_items.length; index++) {
            // console.log(final_penulis[index]," != ", penulis_select,final_penulis[index] != penulis_select);
            if (final_penulis[index] != penulis_select) {
                finalize_items.splice(index, 1);
                final_penulis.splice(index, 1);
                final_prodi.splice(index, 1);
                index--;
            }
        }
    }
    // console.log("finalize_items (After):",finalize_items, "\nfinal_penulis: ",final_penulis);
    // console.log("============== Penulis Checked ==============");

    
    // console.log("============== Prodi Start ==============");
    if (((prodi_select == "&gt;--Pilih Program Studi--&lt;") || (prodi_select == "&gt;--Pilih Semua--&lt;"))) {
        // nothing to do here
    }
    else {
        for (let index = 0; index < finalize_items.length; index++) {
            // console.log(final_prodi[index]," != ", prodi_select,final_prodi[index] != prodi_select);
            if (final_prodi[index] != prodi_select) {
                finalize_items.splice(index, 1);
                final_prodi.splice(index, 1);
                index--;
            }
        }
    }
    // console.log("finalize_items (After):",finalize_items, "\nfinal_prodi: ",final_prodi);
    // console.log("============== Prodi Checked ==============");
    // console.log("================ Render Stopped ================");
    DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
}
document.querySelector('#next_btn_artikel').addEventListener('click', nextPage, false);
document.querySelector('#last_btn_artikel').addEventListener('click', lastPage, false);
document.querySelector('#prev_btn_artikel').addEventListener('click', previousPage, false);
document.querySelector('#first_btn_artikel').addEventListener('click', firstPage, false);

function previousPage() {
    if(current_page > 1) current_page--;
    DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
}
function firstPage() {
    current_page = 1;
    DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
}
function nextPage() {
    if((current_page * rows) < finalize_items.length) current_page++;
    DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
}
function lastPage() {
    current_page = Math.ceil(finalize_items.length/rows);
    DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
}

changeFinal();
DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
