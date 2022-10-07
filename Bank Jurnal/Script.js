//Variabel
var headBtn = document.querySelectorAll('.head-button');
var taskbarBtnId = document.getElementById('taskbar-btn');
var dropdown = document.querySelectorAll('.dropdown-menu');
var taskbar = document.getElementById('taskbar');
var shade = document.getElementById("shade");
var lokasi = window.location.href; // link web
var dropmenu = document.querySelectorAll(`.drop-btn`);
var prodi_all = document.querySelector(`form .row article.row #all`);
var prodi_Unall = document.querySelector(`form .row article.row #allClear`);
var pointer_history = document.querySelectorAll(`.history_list .pointer`);

//list example
    let list_judul = [];
        for (let i = 1; i <= 100; i++) { list_judul.push("Artikel "+i); }
    let list_finalize = ["Yes","No","All"];
    let list_penulis = [];
        for (let i = 0; i < 25; i++) { list_penulis.push("Penulis "+String.fromCharCode(i+97)); }
    let list_prodi = [];
        for (let i = 0; i < 16; i++) { list_prodi.push("Prodi "+String.fromCharCode(i+65)); }
    let final_list = [];
        for (let i = 0; i < list_judul.length; i++) {
            const fnl = Math.floor(Math.random() * ((list_finalize.length-1) - 1 + 1) + 1);
            const pnl = Math.floor(Math.random() * ((list_penulis.length-1) - 1 + 1) + 1);
            const prodi = Math.floor(Math.random() * ((list_prodi.length-1) - 1 + 1) + 1);
            final_list.push([list_judul[i], list_finalize[fnl-1], list_penulis[pnl-1], list_prodi[prodi-1]]);
        }
    let render_list = [].concat(final_list);
// console.table(final_list);

//banyak histori dalam 1 artikel
    const count_history = [];
    for (let i = 0; i < final_list.length; i++) {
        count_history.push(Math.floor(Math.random() * (4 - 2 + 1) + 2));
    }
    var prodi_select_list = [].concat(list_prodi);

// location data
    //tabel
        var tabel_wrapper = document.querySelector('.artikel-tabel-edit');
        if (tabel_wrapper) {
            var tabel_select = tabel_wrapper.querySelectorAll('.article-order .selectbar');
            var tabel_list = tabel_wrapper.querySelector('.tabel-card tbody');
            var tabel_page = tabel_wrapper.querySelector('.page .page-button #no_loc_artikel');
            var tabel_detail = tabel_wrapper.querySelector('.page #article_pagination_count');
        }
        const row_tabel = 10;
    //prodi-select
        var prodi_wrapper = document.querySelector('.filter-prodi .filter-body');
        var check_prodi_list = document.querySelector('.prodi-pilih');
    //slide
        var slide_wrapper = document.querySelector('.slide-penulis');
        if (slide_wrapper) {
            var slide_main = slide_wrapper.querySelector('.penulis-isi .card-body');
            var slide_list = slide_main.querySelector('.container-slide');
            var slide_page = slide_main.querySelector('.page .page-button #no-loc-penulis');
            var slide_detail = slide_main.querySelector('.page #penulis_pagination_count');
        }
        const row_slide = 10;
        var penulis_slide = [];
    //form
        var form_wrapper = document.querySelector(`.form-modal`);
        if (form_wrapper) {
            var form_judul = form_wrapper.querySelector(`#judul`);
            if (form_judul) { form_judul = form_wrapper.querySelector(`#judul`).childNodes[3]; }
            var form_penulis = form_wrapper.querySelector(`#penulis`);
            if (form_penulis) { form_penulis = form_wrapper.querySelector(`#penulis`).childNodes[3]; }
            var form_history = form_wrapper.querySelector(`.history_form`);
        }
    //btn
    var page_button = document.querySelectorAll(`.np-btn`);
    


// console.log(headBtn);

//function
//mouse clicked
    window.addEventListener('mouseup', function(event){
        // console.log(event.target);
        //general
            headBtn.forEach((btn,index) => {
                if (btn.contains(event.target)) {
                    if (btn.nextElementSibling) {
                        if (dropdown[index-1].style.display === "none") { dropdown[index-1].style.display = "block"; }
                        else { dropdown[index-1].style.display = "none"; }
                    }
                    else if (btn.id == taskbarBtnId.id) {
                        if (taskbar.style.display === "none") { taskbar.style.display = "block"; shade_show("show"); }
                        else { taskbar.style.display = "none"; shade_show("remove");}
                    }
                }
                else {
                    if (btn.nextElementSibling) {
                        if (dropdown[index-1].style.display === "block") {
                            if (!btn.parentNode.contains(event.target)) { dropdown[index-1].style.display = "none"; }
                        }
                    }
                    else if (event.target == taskbar) {
                        if (taskbar.style.display === "block") { taskbar.style.display = "none"; shade_show("remove"); }
                    }
                }
            });

        //tabel or Slide List
            if (tabel_select) {
                tabel_select.forEach((select,index) => {
                    // console.log("select", select, "select.querySelector", select.querySelector(`.drop-select`));
                    var dropSelect = select.querySelector(`.drop-select`);
                    if (dropSelect) {
                        var selectMenu = dropSelect.querySelectorAll(`div ul li`);
                    }
                    var label, suggestSearch;

                    if (select.contains(event.target)) {
                        // console.log(select,event.target, select.id);
                        if (!select.id.includes("jdl")) {
                            if (dropSelect) {
                                dropSelect.classList.add("ddShow");
                                dropSelect.parentElement.classList.add("show");
                            }
                        }
                        if (select.classList.contains("se-selectbar")) {
                            label = select.querySelector('form .select-btn div');
                            suggestSearch = dropSelect.querySelector('.select-search input');
                        }
                        else if (select.classList.contains("search-jdl")) {
                            label = select.querySelector('form input');
                            suggestSearch = select.querySelector('form input');
                        }

                        selectMenu.forEach((menu, index) => {
                            if (event.target == menu) {
                                if (dropSelect.querySelector(`ul li.active`)) {
                                    dropSelect.querySelector(`ul li.active`).classList.remove("active");
                                }
                                menu.classList.add("active");
                                // console.log(menu,menu.classList);
                                label.innerHTML = menu.textContent;
                                label.value = menu.textContent;
                                checkTypeList();
                                
                        
                                dropSelect.classList.remove("ddShow");
                                dropSelect.parentElement.classList.remove("show");
                            }
                        });
                        if (!select.id.includes("final")) {
                            suggestionBar(suggestSearch, dropSelect, select.id, label.textContent);
                        }
                    }
                    else {
                        if (dropSelect) {
                            dropSelect.classList.remove("ddShow");
                            dropSelect.parentElement.classList.remove("show");
                        }
                    }
                    
                });
            }

            if (dropmenu) {
                dropmenu.forEach((btn,index) => {
                    var next = btn.nextElementSibling;
                    var tr = btn.parentNode.parentNode;
                    if (event.target == btn) {
                        if (next) {
                            if (next.style.display === "none") { next.style.display = "block"; }
                            else { next.style.display = "none"; }
                        }
                        else {
                            tr = btn.parentNode;
                            form_inside(tr.getAttribute('data-id'));
                        }
                    }
                    else {
                        if (btn.nextElementSibling) {
                            if (next.style.display === "block") {
                                if (!btn.parentNode.contains(event.target)) { next.style.display = "none"; }
                                else {
                                    if (event.target.textContent.includes("Lihat Artikel")) {
    
                                    }
                                    else if (event.target.textContent.includes("Upload Ulang")) {
                                        
                                    }
                                    else if (event.target.textContent.includes("Status Perubahan")) {
                                        form_inside(tr.getAttribute('data-id'));
                                    }
                                    next.style.display = "none";
                                }
                            }
                        }
                    }
                });
            }
            
            // List Pagination Btn
                if (page_button) {
                    page_button.forEach((btn) => {
                        if (btn.contains(event.target)) {
                            // console.log(btn.id);
                            if (btn.id.includes("artikel")) {
                                if (btn.id.includes("first")) {
                                    tabel_page.innerHTML = 1;
                                }
                                else if (btn.id.includes("prev")) {
                                    if(tabel_page.innerHTML > 1) tabel_page.innerHTML--;
                                }
                                else if (btn.id.includes("next")) {
                                    if((tabel_page.innerHTML * row_tabel) < render_list.length) tabel_page.innerHTML++;
                                }
                                else if (btn.id.includes("last")) {
                                    tabel_page.innerHTML = Math.ceil(render_list.length/row_tabel);
                                }
                            }
                            else if (btn.id.includes("penulis")) {
                                if (btn.id.includes("first")) {
                                    slide_page.innerHTML = 1;
                                }
                                else if (btn.id.includes("prev")) {
                                    if(slide_page.innerHTML > 1) slide_page.innerHTML--;
                                }
                                else if (btn.id.includes("next")) {
                                    if((slide_page.innerHTML * row_slide) < penulis_slide.length) slide_page.innerHTML++;
                                }
                                else if (btn.id.includes("last")) {
                                    slide_page.innerHTML = Math.ceil(penulis_slide.length/row_slide);
                                }
                            }
                            // console.log(tabel_page.innerHTML,slide_page.innerHTML);
                            if (render_list.length != 0) {
                                start();
                            }
                        }
                    });
                }
                

        //form
            if (pointer_history) {
                pointer_history = document.querySelectorAll(`.history_list .pointer`);
                pointer_history.forEach((pointer,index) => {
                    if (pointer.contains(event.target)) {
                        var parent = pointer.parentNode;
                        var detail = parent.nextSibling;
                        var indexChild = 0;
                        form_history.childNodes.forEach((child, index) => { if (parent == child) { indexChild = index + 1; } });
                        
                        if (parent.classList.contains("parent")) {
                            parent.classList.remove("parent");
                            detail.remove();
                        }
                        else {
                            var last_list = form_history.lastElementChild;
            
                            parent.classList.add("parent");
                            var child = document.createElement("div");
                            if (parent.nextSibling) { parent.parentNode.insertBefore(child, parent.nextSibling); }
                            else { parent.parentNode.appendChild(child); }
            
                            child.classList.add("child");
                            var loc = parent.nextElementSibling;
                            var input = input_history(form_judul.textContent, parent, last_list, indexChild);
                            loc.innerHTML = input;
                        }
                    }
                });
            }

            if (form_wrapper) {
                if (form_wrapper.classList.contains("show")) {
                    var from_btn = form_wrapper.querySelectorAll(`.btn`);
                    from_btn.forEach((btn) => {
                        if ((event.target == form_wrapper.childNodes[1]) || (event.target == btn)) {
                            if (btn.type === "submit") {
                                document.getElementById("form-status").addEventListener('submit', (event) => {
                                    event.preventDefault();
                                });
                                // console.log("The form was submitted");
                                if (check_prodi_list) {
                                    var checkboxes = document.querySelectorAll('input[name="prodi"]:checked');
                                    if (checkboxes) {
                                        var values = [];
                                        checkboxes.forEach((checkbox) => {
                                            values.push(checkbox.nextElementSibling.querySelector('span').textContent);
                                        });
                                        ProdiList(values);
                                    }
                                }
                            }
                            form_wrapper.style.display = "none";
                            form_wrapper.classList.remove("show");
                            shade_show("remove");
                            overflow_body("auto");
                        }
                    });
                }
            }

        //prodi_select
            if (lokasi.includes("index")) {
                if (event.target == prodi_all) {
                    prodi_Unall.checked = false;
                    checkProdi(true);
                }
                else if (event.target == prodi_Unall) {
                    prodi_all.checked = false;
                    checkProdi(false);
                }
                if (check_prodi_list.contains(event.target)) {
                    checkProdi_final(event.target,!event.target.checked);
                }
            }
    });

//general
    function overflow_body(isi) {
        var body = document.querySelector("body");
        let head_isi = document.querySelector('body header #head-isi');
        let main_isi = document.querySelector('body main #main-isi');
        body.style.overflow = isi;
        if (isi == "hidden") {
            head_isi.style.paddingRight = (32 + 17);
            main_isi.style.paddingRight = 17;
        }
        else {
            head_isi.style.paddingRight = null;
            main_isi.style.paddingRight = null;
        }
    }
    function shade_show(isi) {
        if (isi == "show") { shade.classList.add(isi); }
        else { shade.classList.remove("show"); }
    }
    function UniqueList(value, index, self) {
        return self.indexOf(value) === index;
      }

//tabel
    function DisplayList(items, location_item, rowsPage, page, type) {
        var item = [].concat(items);
        // console.log(type, type.includes("slide"));
        if (type.includes("slide")) {
            item = [];
            var penulis = [];
            items.forEach((data) => { penulis.push(data[2]) });
            item = penulis.filter(UniqueList).sort();
            penulis_slide = penulis.filter(UniqueList).sort();
        }
        else if (type.includes("dropdown")) {
            var thisAuthor = "Penulis A";
            item = [];
            items.forEach((data) => { 
                if (data[2].toLocaleLowerCase() == thisAuthor.toLocaleLowerCase()) { item.push(data); }
            });
        }
        location_item.innerHTML = '';
        page --;
        let start = rowsPage * page;
        let end = start + rowsPage;
        paginatedItems = item.slice(start, end);

        // console.log(start, end, item);
        let result = '';
        for (let i = 0; i < paginatedItems.length; i++) {
            if (type.includes("slide")) {
                result += input_list((i + 1), "", paginatedItems[i], "", type);
            }
            else if (type.includes("tabel")) {
                result += input_list((i + 1), paginatedItems[i][0], paginatedItems[i][2], paginatedItems[i][3], type);
            }
        }
        location_item.innerHTML = result;
        if (type.includes("tabel")) {
            tabel_page.innerHTML = page + 1;
            tabel_detail.innerHTML = paginatedItems.length +" of " + item.length + " Articles";
        }
        else if (type.includes("slide")) {
            slide_page.innerHTML = page + 1;
            slide_detail.innerHTML = paginatedItems.length +" of " + item.length + " Authors";
        }
        
        // console.log(result);
        if (lokasi.includes("my")) { dropmenu = document.querySelectorAll(`.drop-btn`); }
        else  { dropmenu = document.querySelectorAll(`.pointer`); }
    }
    function input_list(id, judul, pnl, prodi, type) {
        let first_column = '';
        let last_column = '';
        if (type.includes("tabel")) {
            first_column = `<tr  data-id="`+ id +`">
            <td>`+ judul+`</td>`;
            if (type.includes("pointer")) {
                last_column = `<td>`+ pnl +`</td>
                    <td>`+ prodi+`</td>
                    <td class="btn pointer">View</td>
                </tr>`;
            }
            else if (type.includes("status")) {
                last_column = `<td>`+ pnl +`</td>
                    <td>`+ prodi+`</td>
                    <td>Status</td>
                </tr>`;
            }
            else if (type.includes("dropdown")) {
                last_column = `<td>Tanggal Upload</td>
                <td>Tanggal Rilis</td>
                <td>Status</td>
                <td>
                    <button class="btn pointer drop-btn"> Lainnya </button>
                    <div class="dropdown-menu card se-se-bar" id="dropdown-menu-article" style="display: none;">
                        <ul class="select-droped">
                            <li>Lihat Artikel</li>
                            <li>Upload Ulang</li>
                            <li>Status Perubahan</li>
                        </ul>
                    </div>
                </td>
            </tr>`;
            }
        }
        else if (type.includes("slide")) {
            first_column = `<div class="profile-box flex-wrap col-auto">
                            <img src="" alt="profile-image">
                            <p id="profile-name">`+ pnl +`</p>
                        </div>`;
        }
        
        
        return first_column + last_column;
    }
    function RenderFinal(type) {
        var render_item = [].concat(final_list);
        var judul_search, final_select, pnl_select, prodi_select;
        tabel_select.forEach(item => {
            if (item.id.includes("jdl")) {
                judul_search = item.querySelector('form input').value;
            }
            if (item.id.includes("final")) {
                final_select = item.querySelector('form .select-btn #select-final').innerHTML;
            }
            if (item.id.includes("pnl")) {
                pnl_select = item.querySelector('form .select-btn #select-pnl').innerHTML;
            }
            if (item.id.includes("prodi")) {
                prodi_select = item.querySelector('form .select-btn #select-prodi').innerHTML;
            }
        });

        //input all for null data
        if ((!judul_search) || (judul_search == ">--Pilih Semua--<")) { judul_search = "All"}
        if (!final_select) { final_select = "All"}
        if ((!pnl_select) || (pnl_select == ">--Pilih Penulis--<") || (pnl_select == "&gt;--Pilih Penulis--&lt;")) { pnl_select = "All"}
        if ((!prodi_select) || (prodi_select == "&gt;--Pilih Prodi--&lt;") || (prodi_select == "&gt;--Pilih Program Studi--&lt;")) {
            if ((!prodi_select) && (document.querySelector(`.filter-prodi`))) { prodi_select = prodi_select_list; }
            else { prodi_select = "All"; }
        }


        // console.log("judul_search", judul_search, "   || final_select", final_select);
        // console.log("prodi_select", prodi_select, "   || pnl_select", pnl_select);
        
        for (let i = 0; i < render_item.length; i++) {
            if (final_select != "All") {
                if (render_item[i]) {
                    if (render_item[i][1] != final_select) {
                        // console.log(render_item[i]);
                        render_item.splice(i, 1);
                        i--;
                    }
                }
            }
            if (pnl_select != "All") {
                if (render_item[i]) {
                    if (render_item[i][2] != pnl_select) {
                        render_item.splice(i, 1);
                        i--;
                    }
                }
            }
            if (prodi_select != "All") {
                if (render_item[i]) {
                    if (!prodi_select.includes(render_item[i][3])) {
                        render_item.splice(i, 1);
                        i--;
                    }
                }
            }
            if (judul_search != "All") {
                if (render_item[i]) {
                    if (!render_item[i][0].toLocaleLowerCase().includes(judul_search.toLocaleLowerCase())) {
                        render_item.splice(i, 1);
                        i--;
                    }
                }
            }
        }
        
        render_list = [].concat(render_item);
        // console.log(render_item, tabel_list, row_tabel, tabel_page.innerHTML, type);
        if (type.includes("tabel")) { DisplayList(render_item, tabel_list, row_tabel, tabel_page.innerHTML, type); }
        else if (type.includes("slide")) { DisplayList(render_item, slide_list, row_slide, slide_page.innerHTML, "slide"); }
    }
    function checkTypeList() {
        // console.log(lokasi);
        if (lokasi.includes("my")) { RenderFinal("tabel_dropdown"); }
        else if (lokasi.includes("status")) { RenderFinal("tabel_pointer"); }
        else if (lokasi.includes("index")) {
            RenderFinal("tabel_status");
            RenderFinal("slide");
        }
    }
    //form
        function form_function() {
            if (form_wrapper.style.display === "none") {
                form_wrapper.style.display = null;
                form_wrapper.classList.add("show");
                shade_show("show");
                overflow_body("hidden");
            }
        }
        function form_inside(id) {
            form_function();
            const tr = document.querySelectorAll(`tr`);
            tr.forEach((item) => {
                if (item.getAttribute('data-id') == id) {
                    form_judul.innerHTML = item.childNodes[1].textContent;
                    final_list.forEach((data,index) => {
                        if (data[0] == item.childNodes[1].textContent) {
                            form_penulis.innerHTML = data[2];
                            n_history = count_history[index];
                        }
                    });
                }
            });
            
            form_history.innerHTML = '';
            for (let i = 0; i < n_history; i++) {
                var child = document.createElement("div");
                form_history.appendChild(child);

                child.classList.add("history_list");
                child.classList.add("row");
                if (i != 0) { child.classList.add("border-top"); }

                var loc = form_history.lastElementChild;
                var input = `<div class="date_up">MM/DD/YY</div>
                    <span></span>
                    <div class="pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                            <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                        </svg>
                    </div>`;
                loc.innerHTML = input;
            }
            
        }
        function input_history(judulArtikel, parent, last_list, index) {
            var input = `<div class="history_detail row" id="lama">
                            <div class="form_sub_title">Status Lama</div>
                            <div>[Status Lama `+judulArtikel+`-`+(index - 1)+`]</div>
                        </div>`;
            if (last_list != parent) {
                input += `<div class="history_detail row" id="baru">
                            <div class="form_sub_title">Status Baru</div>
                            <div>[Status Baru `+judulArtikel+`-`+index+`]</div>
                        </div>
                        <div class="history_detail row" id="catatan">
                            <div class="form_sub_title">Catatan</div>
                            <div>[Catatan Revisi `+judulArtikel+`-`+index+`]</div>
                        </div>
                        <div class="history_detail row" id="artikel">
                            <div class="link" id="see_article">Lihat Artikel</div>
                        </div>`;
            }
            else if (last_list == parent) {
                if (lokasi.includes("status")) {
                    input += `<div class="history_detail row" id="baru">
                                <div class="form_sub_title">Status Baru</div>
                                <div>
                                    <select name="" id="tabel_status_change">
                                        <option disabled="" selected="" value="">[Status Baru]</option>
                                        <option value="">Draft</option>
                                        <option value="">Revisi Minor</option>
                                        <option value="">Revisi Mayor</option>
                                        <option value="">Layak Publish</option>
                                    </select>
                                </div>
                            </div>
                            <div class="history_detail row" id="catatan">
                                <div class="form_sub_title">Catatan</div>
                                <div>
                                    <textarea name="" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]"></textarea>
                                </div>
                            </div>
                            <div class="history_detail row" id="artikel">
                                <div class="link" id="see_article">Lihat Artikel</div>
                            </div>`;
                }
                else {
                    input += `<div class="history_detail row" id="baru">
                                <div class="form_sub_title">Status Baru</div>
                                <div>-- Belum Ada Status Baru --</div>
                            </div>
                            <div class="history_detail row" id="catatan">
                                <div class="form_sub_title">Catatan</div>
                                <div>-- Belum Ada Catatan Baru --</div>
                            </div>
                            <div class="history_detail row" id="artikel">
                                <div class="link" id="see_article">Lihat Artikel</div>
                            </div>`;
                }
            }
            return input;
        }

var form = document.querySelector('#jdl-search form');
if (form) {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        checkTypeList();
    });
}
function suggestionBar(input_box, dd, parent_id, label) {
    // console.log("input_box (suggestionBar())",input_box, dd, parent_id, label);
    let suggestions;
    let firstSuggestions;
    if (parent_id.includes("pnl")) {
        firstSuggestions = ">--Pilih Penulis--<";
        suggestions = [firstSuggestions].concat(list_penulis);
    }
    else if (parent_id.includes("prodi")) {
        firstSuggestions = ">--Pilih Prodi--<";
        suggestions = [firstSuggestions].concat(list_prodi);
    }
    else if (parent_id.includes("jdl")) {
        firstSuggestions = ">--Pilih Semua--<";
        suggestions = [firstSuggestions].concat(list_judul);
    }

    showSuggestions([],parent_id, label); //rewrite first
    
    // if user press any key and release
    input_box.onkeyup = (e)=>{
        let userData = e.target.value; //user enetered data
        let emptyArray = [];
        if(userData){
            dd.classList.add("ddShow");
            // console.log("==============================================");
            emptyArray = suggestions.filter((data)=>{
                return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()); 
            });
            // console.log("userData: ",userData);
            emptyArray = emptyArray.map((data)=>{
                if (data.toLocaleLowerCase().includes(userData.toLocaleLowerCase())) {
                    return data = '<li>'+ data +'</li>';
                }
            });
            showSuggestions(emptyArray,parent_id, label);
        }
        else{
            if (parent_id.includes("jdl")) { dd.classList.remove("ddShow"); }
            showSuggestions(emptyArray,parent_id, label);
        }
    }
    function showSuggestions(list, parent_id, label){
        let listData;
        let parent = document.getElementById(parent_id);
        var loc_list = parent.querySelector('.drop-select .select-droped');
        if(!list.length){
            userValue = input_box.value;
            if (!userValue || userValue.includes(" ")) {
                listData = "";
                for (let i = 0; i < suggestions.length; i++) {
                    if (label) {
                        // console.log(suggestions[i],label,suggestions[i].toLocaleLowerCase() == label.toLocaleLowerCase());
                        if (suggestions[i].toLocaleLowerCase() == label.toLocaleLowerCase()) {
                            listData += `<li class="active">`+(suggestions[i])+`</li>`
                        }
                        else if ((suggestions[i].includes("Prodi")) && (label == ">--Pilih Program Studi--<") && (i == 0)) {
                            listData += `<li class="active">`+(suggestions[i])+`</li>`
                        }
                        else {
                            listData += `<li>`+(suggestions[i])+`</li>`
                        }
                    }
                    else {
                        listData += `<li>`+(suggestions[i])+`</li>`
                    }
                }
            }
            else{
                listData = '<li><b>Nothing Found</b></li>';
            }
        }else {
            listData = list.join('');
        }
        loc_list.innerHTML = listData;
    }
}

//prodi
    //color per prodi
    var pos;
    var r = [], g = [], b = [];
    let normal = 65;
    for (let i = 0; i < list_prodi.length; i++) {
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
        // console.log(items);
        if (document.getElementsByClassName("filter-prodi")) {
            prodi_select_list = items;
            let result = '';
            let result_form = '';
            let sisa = 0;
            let show = 0;
            let index = 0;
            if (items[0] == ">--Pilih Semua--<") { index = 1; console.log(index);}
            for (let i = index; i < list_prodi.length; i++) {
                //prodi list that selected
                    if ((show <= 11) && (items.includes(list_prodi[i]))) {
                        result += `<div class="prodi-box" style="background-color: #`+r[i]+g[i]+b[i]+`;">`+list_prodi[i]+`</div>`;
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
                    result_form += `<article style="border-color: #`+r[i]+g[i]+b[i]+`;">
                    <input type="checkbox" name="prodi">
                    <div><span>`+list_prodi[i]+`</span></div></article>`;
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
            checkTypeList();
        }
    }

    function checkProdi(check) {
        for (let i = 0; i < list_prodi.length; i++) {
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

function start() {
if (lokasi.includes("index")) { ProdiList(list_prodi); }
else { checkTypeList(); }
}
start();
