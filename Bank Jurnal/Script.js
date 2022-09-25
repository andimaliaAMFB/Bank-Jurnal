//Variable
var notif = document.getElementById("dropdown-notif");
var prof = document.getElementById("dropdown-profile");
var taskbar = document.getElementById("taskbar");
var form_modal = document.getElementById("form");
var judul = document.getElementById("dropdown-jdl");
var prodi = document.getElementById("dropdown-prodi");
var pnl = document.getElementById("dropdown-pnl");
var final = document.getElementById("dropdown-final");
var prodi_all = document.querySelector(`form .row article.row #all`);
var prodi_Unall = document.querySelector(`form .row article.row #allClear`);
var check_prodi_list = document.querySelector('.prodi-pilih');

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

    //general
        if (notif.style.display == "block") {
            if (!notif.contains(event.target)){ notif.style.display = "none"; }
        }
        else if ((notif.style.display == "none") && (event.target.id == "button-notif")) {
            notif.style.display = "block";
        }
        
        if (prof.style.display == "block") {
            if (!prof.contains(event.target)){ prof.style.display = "none"; }
        }
        else if ((prof.style.display == "none") && (event.target.id == "button-profile")) {
            prof.style.display = "block";
        }
        
        if (taskbar.parentNode.style.display == "block") {
            if ((!taskbar.contains(event.target)) || (event.target.classList.contains("taskbar-btn"))){
                taskbar.parentNode.style.display = "none";
                shade_show("remove");
            }
        }
        else if ((taskbar.parentNode.style.display == "none") && (event.target.classList.contains("taskbar-btn"))) {
            taskbar.parentNode.style.display = "block";
            taskbar.parentNode.classList.add("show");
            shade_show("show");
        }
    

        if (form_modal) {
            if (form_modal.parentNode.style.display == "block") {
                // console.log(form_modal.parentNode);
                if (event.target == form_modal || event.target.classList == "btn"){
                    // console.log("FormEnd!!");
                    form_modal.parentNode.style.display = "none";
                    shade_show("remove");
                    overflow_body("auto");
                    
                    var parent = document.querySelector('.history_form');
                    if (parent) { parent.innerHTML = ''; }
                }
                document.getElementById("form-status").onsubmit = function() {
                    //submit form
                    // alert("The form was submitted");
                    if (lokal.includes("index")) {
                        let checkboxes = document.querySelectorAll('input[name="prodi"]:checked');
                        let values = [];
                        checkboxes.forEach((checkbox) => {
                            // console.log(checkbox.nextElementSibling.querySelector('span').textContent);
                            values.push(checkbox.nextElementSibling.querySelector('span').textContent);
                        });
                        // console.log(checkboxes);
                        // alert(values);
                        ProdiList(values)
                    }
                    return false;
                }
            }
        }

    //index
    if (lokal.includes("index")) {
        if (event.target == prodi_all) {
            // console.log("Check All");
            prodi_Unall.checked = false;
            checkProdi(true);
        }
        else if (event.target == prodi_Unall) {
            // console.log("UnCheck All");
            prodi_all.checked = false;
            checkProdi(false);
        }
        if (check_prodi_list.contains(event.target)) {
            checkProdi_final(event.target,!event.target.checked);
        }
    }
    //status-ubah
        if (judul) {
            if (!judul.parentNode.contains(event.target)){
                judul.style.display = "none";
                document.getElementById("jdl-search").classList.remove("active");
            }
            if (judul.contains(event.target)) {
                if (event.target.parentNode.classList.contains("select-droped")) {
                    if (document.querySelector('#jdl-search .drop-select ul .active')) {
                        document.querySelector('#jdl-search .drop-select ul .active').classList.remove("active");
                    }
                    event.target.classList.add("active");
                    // judul.style.display = "none";
                    document.querySelector('#search-jdl').value = event.target.innerHTML;
                    console.log("judul:",document.querySelector('#s-se-pnl').value);
                    changeFinal();
                }
            }
        }
        if (prodi) {
            if (!prodi.parentNode.contains(event.target)){
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
        }
        if (pnl) {
            if (!pnl.parentNode.contains(event.target)){
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
        }

        if (final) {
            if (!final.parentNode.contains(event.target)){
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
    // console.log(parent);
    if (prof.style.display === "none") {
        prof.style.display = "block";
        parent.classList.add("active");
        if (parent.id.includes("final-select")) {
            
        }
        else {
            var input;
            if (parent.id.includes("search")) {
                input = document.querySelector('.active form input');
                prof.style.display = "none";
            }
            else {
                input = document.querySelector('.active .drop-select .select-search form input');
            }
            suggestionBar(input,parent.id);
        }
    }
}

// lokasi web
let lokal = window.location.href;
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

var arr = Array.from(Array(24).keys())
const penulis_list = [];
const prodi_list = [];
var input_penulis = " ";
var input_prodi = " ";

let suggestions = [];
let sugges_jdl = [];
let sugges_pnl = [];
let sugges_prodi = [];
for (let i = 0; i < arr.length; i++) {
    if (i==0) {
        input_penulis += `<li>>--Pilih Semua--<</li>`
        input_prodi += `<li>>--Pilih Semua--<</li>`
        sugges_pnl.push(">--Pilih Semua--<");
        sugges_prodi.push(">--Pilih Semua--<");
    }
    else {
        input_penulis += `<li>Penulis Item `+(arr[i])+`</li>`
        input_prodi += `<li>Program Studi Item `+(arr[i])+`</li>`
        sugges_pnl.push("Penulis Item "+arr[i]);
        sugges_prodi.push("Program Studi Item "+arr[i]);
    }
}
// penulis & prodi per list
for (let i = 0; i < list_items.length; i++) {
    var select = Math.floor(Math.random() * (arr.length - 2 + 1) + 2); 
    penulis_list.push("Penulis Item "+arr[select-1]);
    prodi_list.push("Program Studi Item "+arr[select-1]);
    sugges_jdl.push(list_items[i]);
}
if (loc_penulis&&loc_prodi) {
    loc_penulis.innerHTML = input_penulis;
    loc_prodi.innerHTML = input_prodi;
}


//Table Render
    // console.log(suggestions);
    // var string = "Penulis Item 2";
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

    const form = document.querySelector('#jdl-search form');
    if (form) {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            changeFinal();
        });
    }

    function suggestionBar(input_box, parent_id) {
        // console.log("input_box (suggestionBar())",input_box);
        if (parent_id.includes("pnl")) { suggestions = [].concat(sugges_pnl); }
        else if (parent_id.includes("prodi")) { suggestions = [].concat(sugges_prodi); }
        else if (parent_id.includes("jdl")) { suggestions = [].concat(sugges_jdl); }
        
        parent = document.getElementById(parent_id);
        dd = parent.querySelector('.drop-select');
        
        // if user press any key and release
        input_box.onkeyup = (e)=>{
            let userData = e.target.value; //user enetered data
            let emptyArray = [];
            if(userData){
                dd.style.display = "block";
                // console.log("==============================================");
                emptyArray = suggestions.filter((data)=>{
                    //filtering array value and user characters to lowercase and return only those words which are start with user enetered chars
                    // console.log("hh");
                    // console.log(data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()));
                    return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()); 
                });
                // console.log("userData: ",userData);
                emptyArray = emptyArray.map((data)=>{
                    // passing return data inside li tag
                    // console.log(data," includes ",userData,data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()));
                    if (data.toLocaleLowerCase().includes(userData.toLocaleLowerCase())) {
                        return data = '<li>'+ data +'</li>';
                    }
                });
                // console.log("emptyArray",emptyArray);
                showSuggestions(emptyArray,parent_id);
            }
            else{
                dd.style.display = "none";
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
    let jdl_slt = document.querySelector('#search-jdl');
    let final_slt = document.querySelector('#select-final');
    let pnl_slt = document.querySelector('#select-pnl');
    let prodi_slt = document.querySelector('#select-prodi');

    var judul_select,final_select,penulis_select,prodi_select;
    if (jdl_slt && final_slt && pnl_slt && prodi_slt) {
        judul_select = jdl_slt.innerHTML;
        final_select = final_slt.innerHTML;
        penulis_select = pnl_slt.innerHTML;
        prodi_select = prodi_slt.innerHTML;
    }
    function changeFinal() {
        if (jdl_slt && final_slt && pnl_slt && prodi_slt) {
            judul_select = jdl_slt.value;
            jdl_slt.innerHTML = judul_select;
            jdl_slt.value = judul_select;
            
            final_select = final_slt.innerHTML;
            final_slt.innerHTML = final_select;

            penulis_select = pnl_slt.innerHTML;
            pnl_slt.innerHTML = penulis_select;

            prodi_select = prodi_slt.innerHTML;
            prodi_slt.innerHTML = prodi_select;

            // console.log("judul_select: ",judul_select,"final_select:",final_select,"\npenulis_select:",penulis_select,"\nprodi_select:",prodi_select);
            finalRender(judul_select, final_select, penulis_select, prodi_select);
        }
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
            <td> `+penulis[i+start]+`</td>
            <td> `+prodi[i+start]+`</td>`;

            if (lokal.includes("index")) {
                result +=`<td>Status</td>
                </tr>`;
            }
            else {
                result +=`<td class="btn pointer">View</td>
                </tr>`;
            }
        }
        wrapper.innerHTML = result;
        current.innerHTML = current_page;
        // console.log(current_page);
        count.innerHTML = paginatedItems.length +" of " + items.length + " Article";
    }


    //list yang digunakan dalam list tabel
    finalize_items = list_items;
    final_judul = list_items;
    final_finalize = finalize;
    final_penulis = penulis_list;
    final_prodi = prodi_list;
    function finalRender(judul_select, final_select, penulis_select, prodi_select) {
        // csonsole.log("================ Start Render ================");
        finalize_items = [];
        final_finalize = [];
        final_penulis = [];
        final_prodi = [];
        final_judul = [];
        // console.log("list_items: ",list_items);
        // console.log("finalize_items: ",finalize_items, "\nfinal_penulis: ",final_penulis);
        // console.log("============== Finalize Start ==============");
        if (final_select != "All") {
            for (let index = 0; index < list_items.length; index++) {
                if (finalize[index] == final_select)
                {
                    finalize_items.push(list_items[index]); 
                    final_finalize.push(finalize[index]); 
                    final_penulis.push(penulis_list[index]); 
                    final_prodi.push(prodi_list[index]); 
                    final_judul.push(list_items[index]); 
                }
            }
        }
        else if (final_select == "All") {
            finalize_items = [].concat(list_items);
            final_finalize = [].concat(finalize);
            final_penulis = [].concat(penulis_list);
            final_prodi = [].concat(prodi_list);
            final_judul = [].concat(list_items);
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
                    final_judul.splice(index, 1);
                    index--;
                }
            }
        }
        // console.log("finalize_items (After):",finalize_items, "\nfinal_penulis: ",final_penulis);
        // console.log("============== Penulis Checked ==============");

        
        // console.log("============== Prodi Start ==============");
        // console.log(prodi_select);
        if (((prodi_select.includes("&gt;--Pilih Program Studi--&lt;")) || (prodi_select.includes("&gt;--Pilih Semua--&lt;")))) {
            // nothing to do here
        }
        else {
            for (let index = 0; index < finalize_items.length; index++) {
                // console.log("final_prodi[",index,"]",final_prodi[index]);
                if (!prodi_select.includes(final_prodi[index])) {
                    finalize_items.splice(index, 1);
                    final_penulis.splice(index, 1);
                    final_prodi.splice(index, 1);
                    final_judul.splice(index, 1);
                    index--;
                }
            }
        }
        // console.log("finalize_items (After):",finalize_items, "\nfinal_prodi: ",final_prodi);
        // console.log("============== Prodi Checked ==============");

        
        // console.log("============== Judul Start ==============");
        // console.log("judul_select",judul_select);
        for (let i = 0; i < finalize_items.length; i++) {
            // console.log(finalize_items[i].toLocaleLowerCase().includes(judul_select.toLocaleLowerCase()));
            if (!finalize_items[i].toLocaleLowerCase().includes(judul_select.toLocaleLowerCase())) {
                // console.log("Dimiss",finalize_items[i]);
                finalize_items.splice(i, 1);
                final_penulis.splice(index, 1);
                final_prodi.splice(index, 1);
                final_judul.splice(index, 1);
                i--;
            }
        }
        // console.log("finalize_items (Last):",finalize_items, "\nfinal_judul: ",final_judul);
        // console.log("============== Judul Checked ==============");
        // console.log("================ Render Stopped ================");
        
        DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);

        if (lokal.includes("index")) {
            final_penulis_unique = final_penulis.filter(UniqueList).sort();
            PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
        }
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
//End Table Render

function UniqueList(value, index, self) {
    return self.indexOf(value) === index;
  }

//Penulis Render
    if (lokal.includes("index")) {
        //var
            let current_page_pnl = 1;
            let rows_pnl = 10;
            var final_penulis_unique = final_penulis.filter(UniqueList).sort();

        
        //lokasi teks dsb yang akan diganti
            const list_element_pnl = document.querySelector('.penulis-isi .card-body .container-slide');
            const count_pnl = document.getElementById('penulis_pagination_count');
            const current_pnl = document.getElementById('no-loc-penulis');
            const pagination_element_pnl = document.getElementById('penulis_pagination');

        function PenulisList(penulis, wrapper, rows_per_page, page) {
            wrapper.innerHTML = "";
            page--;

            // console.log(penulis);
            let start = rows_per_page * page;
            let end = start + rows_per_page;
            paginatedItems = penulis.slice(start, end);

            let result = '';
            for (let i = 0; i < paginatedItems.length; i++) {
                let item = paginatedItems[i];
                // console.log("Finalize is = ",final_select);
                result += `<div class="profile-box">
                        <img src="" alt="profile-image">
                        <p id="profile-name">`+paginatedItems[i]+`</p>
                    </div>`;
            }
            wrapper.innerHTML = result;
            current_pnl.innerHTML = current_page;
            // console.log(current_page);
            count_pnl.innerHTML = paginatedItems.length +" of " + penulis.length + " Authors";
        }
        
        document.querySelector('#next_btn_penulis').addEventListener('click', nextPagePnl, false);
        document.querySelector('#last_btn_penulis').addEventListener('click', lastPagePnl, false);
        document.querySelector('#prev_btn_penulis').addEventListener('click', previousPagePnl, false);
        document.querySelector('#first_btn_penulis').addEventListener('click', firstPagePnl, false);

        function previousPagePnl() {
            if(current_page_pnl > 1) current_page_pnl--;
            PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
        }
        function firstPagePnl() {
            current_page_pnl = 1;
            PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
        }
        function nextPagePnl() {
            if((current_page_pnl * rows_pnl) < final_penulis.length) current_page_pnl++;
            PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
        }
        function lastPagePnl() {
            current_page_pnl = Math.ceil(final_penulis.length/rows_pnl);
            PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
        }
        PenulisList(final_penulis_unique, list_element_pnl, rows_pnl, current_page_pnl);
    }
//End Penulis Render

//Prodi-select Render
    //variabel
    var prodi_select_list = [].concat(sugges_prodi);
    // console.log(prodi_select_list);

    //lokasi teks dsb yang akan diganti
    const prodi_wrapper = document.querySelector('.filter-prodi .filter-body');

    
    //color per prodi
        var pos;
        var r = [], g = [], b = [];
        let normal = 65;
        for (let i = 0; i < sugges_prodi.length; i++) {
            pos = Math.floor(Math.random() * (3 - 1 + 1) + 1);
            if (pos != 1) { r.push(Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
            else { r.push(normal.toString(16) ) }
            if (pos != 2) { g.push(Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
            else { g.push(normal.toString(16) ) }
            if (pos != 3) { b.push(Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
            else { b.push(normal.toString(16) ) }
            // console.log(r[i],g[i],b[i]);
        }
    
    
    function ProdiList(items) {
        if (document.getElementsByClassName("filter-prodi")) {
            let result = '';
            let result_form = '';
            let sisa = 0;
            let show = 0;
            let index = 0;
            if (items[0] == ">--Pilih Semua--<") { index = 1 }
            for (let i = index; i < sugges_prodi.length; i++) {
                //prodi list that selected
                
                    if ((show <= 11) && (items.includes(sugges_prodi[i]))) {
                        result += `<div class="prodi-box" style="background-color: #`+r[i]+g[i]+b[i]+`;">`+sugges_prodi[i]+`</div>`;
                        show += 1;
                    }
                    else if (show > 11) { sisa += 1; }

                    // console.log(items.length,show,sisa);
                    if (index == 0) {
                        if (((show + sisa) == items.length) && (sisa != 0)) {
                            result += `<div class="prodi-box" style="background-color: #787878;">`+sisa+` Other Program Studi</div>`;
                        }
                    }
                    else {
                        if (((show + sisa) == items.length-1) && (sisa != 0)) {
                            result += `<div class="prodi-box" style="background-color: #787878;">`+sisa+` Other Program Studi</div>`;
                        }
                    }
                    

                // prodi list in form
                    if (i >0) {
                        result_form += `<article style="border-color: #`+r[i]+g[i]+b[i]+`;">
                                <input type="checkbox" name="prodi">`;
                        if (index == 0) {
                            result_form += `<div><span>`+sugges_prodi[i]+`</span></div></article>`;
                        }
                        else {
                            result_form += `<div><span>`+sugges_prodi[i]+`</span></div></article>`;
                        }
                    }
            }
            prodi_wrapper.innerHTML = result;
            check_prodi_list.innerHTML = result_form;

            
            let checkboxes = document.querySelectorAll('input[name="prodi"]');
            checkboxes.forEach((checkbox) => {
                if (items.includes
                    (checkbox.nextElementSibling.querySelector('span').textContent)) {
                        checkbox.checked = true;
                        checkbox.nextElementSibling.style.backgroundColor = checkbox.parentNode.style.borderColor;
                }
            });
            finalRender(" ", "All", "&gt;--Pilih Semua--&lt;", items)
        }
    }

    function checkProdi(check) {

        // console.log(check,"prodi_all",prodi_all.checked,"\nprodi_Unall",prodi_Unall.checked);
        for (let i = 0; i < arr.length-1; i++) {
            var check_prodi = check_prodi_list.children[i].querySelector('input');
            // console.log(check_prodi_list.children[i].querySelector('input'));
            check_prodi.checked = check;
            checkProdi_final(check_prodi,check);
        }
    }
    function checkProdi_final(clicked,cek) {
        let parent = clicked.parentNode;
        let div = parent.querySelector('div');
        if (cek) {
            prodi_Unall.checked = false;
            div.style.backgroundColor = parent.style.borderColor;
        }
        else {
            prodi_all.checked = false;
            div.style = null;
        }
    }

    if (lokal.includes("index")) { ProdiList(prodi_select_list); }
//End Prodi-select Render

changeFinal();
// DisplayList(finalize_items, final_penulis, final_prodi, list_element, rows, current_page);
