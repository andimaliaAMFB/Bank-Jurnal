//Variabel
var headBtn = document.querySelectorAll('.head-button');
var taskbarBtnId = document.getElementById('taskbar-btn');
var dropdown = document.querySelectorAll('.dropdown-menu');
var taskbar = document.getElementById('taskbar');
var shade = document.getElementById("shade");
var lokasi = window.location.href; // link web
var headSearch = document.getElementById("search");
var headSearchDd = document.getElementById("dropdown-search");
var dropmenu = document.querySelectorAll(`.drop-btn`);
var prodi_all = document.querySelector(`form .row article.row #all`);
var prodi_Unall = document.querySelector(`form .row article.row #allClear`);
var pointer_history = document.querySelectorAll(`.history_list .pointer`);
var upload_select = document.querySelectorAll(`.select-btn>div:first-child`);
var upload_input = document.querySelectorAll(`.form_sub.row.box div:not([class]):not([id]) textarea`);
var upload_penulis = document.querySelector(`#profile.form_sub.row`);
var panel_switch = document.querySelectorAll(`form.row .panel`);
var drop_file_input = document.querySelectorAll(`.drop-file__input`);

// alert(tryExport + 2); // Try Export Variable
// console.table(arrayExport);
document.querySelectorAll(`input`).forEach(element => {
    if (!element.hasAttribute('autocomplete')) {
        element.setAttribute('autocomplete','off');
    }
});


//list example
    if (list_judul.length) {list_judul.sort();}
    if (list_penulis.length) {list_penulis.sort();}
    if (list_prodi.length) {
        if(lokasi.includes("dashboard")) {list_prodi.push('[ N/a ]');}
        list_prodi.sort();
    }
    if (final_search.length) {final_search.sort();}
    let render_list = [].concat(final_list);

//banyak histori dalam 1 artikel
    const count_history = [];
    for (let i = 0; i < final_list.length; i++) {
        if (lokasi.includes("my") || lokasi.includes("status")) {
            count_history.push(historyArray[i][1]);
        }
        else {
            count_history.push(Math.floor(Math.random() * (4 - 2 + 1) + 2));
        }
    }

var prodi_select_list = [].concat(list_prodi);

// location data
    //header
        //search-modal
        var form_modal = document.querySelectorAll(`.head-modal.form-modal`)  
    //tabel
        var tabel_wrapper = document.querySelector('.artikel-tabel-edit');
        if (tabel_wrapper) {
            var tabel_select = tabel_wrapper.querySelectorAll('.article-order .search_input');
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
        const row_slide = 6;
        var penulis_slide = [];
    //form-modal
        var form_page = document.querySelectorAll(`.form_sub.row`);
        var form_sub_list = [];
        var form_sub_list_search = [];
        if (form_page) {
            form_page.forEach(item => {
                item.querySelectorAll(`.form-sub`).forEach(form_sub => {
                    form_sub_list.push(form_sub);
                    form_sub.querySelectorAll(`.select, .input`).forEach(search_select => {
                        form_sub_list_search.push(search_select); 
                    })
                })
            })
        }

        var form_wrapper = document.querySelector(`main .form-modal`);
        if (form_wrapper) {
            var form_judul = form_wrapper.querySelector(`#judul`);
            if (form_judul) { form_judul = form_wrapper.querySelector(`#judul`).childNodes[3]; }
            var form_penulis = form_wrapper.querySelector(`#penulis`);
            if (form_penulis) { form_penulis = form_wrapper.querySelector(`#penulis`).childNodes[3]; }
            var form_history = form_wrapper.querySelector(`.history_form`);
        }
    //btn
    var page_button = document.querySelectorAll(`.np-btn`);
    


// console.log(headSearch, headSearchDd);
// console.log(form_sub_list);
// console.log(form_sub_list_search);

//function
//mouse clicked
    window.addEventListener('mouseup', function(event){
        // console.log(event.target);
        //general
            var minusIndex = 0;
            headBtn.forEach((btn,index) => { //Open Close Header Menu Modal
                
                // console.log(index);
                if (headBtn.length <= 2) { minusIndex = headBtn.length - 2;}
                else if (headBtn.length > 2) { minusIndex = headBtn.length - 3;}
                if (btn.contains(event.target)) {
                    // console.log(dropdown);
                    if (btn.nextElementSibling) {
                        if (dropdown[index-minusIndex].style.display === "none") { dropdown[index-minusIndex].style.display = "block"; } //open modal when clicked menu in hide
                        else { dropdown[index-minusIndex].style.display = "none"; } //hide modal if the menu clicked again
                    }
                    else if (taskbarBtnId && btn.id == taskbarBtnId.id) {
                        if (taskbar.style.display === "none") { taskbar.style.display = "block"; shade_show("show"); } //open taskbar when the menu clicked
                        else { taskbar.style.display = "none"; shade_show("remove");} //close taskbar if the menu clicked again
                    }
                    else if (btn.id.includes("search")) { //open search menu
                        // console.log("modal open");
                        form_function(document.querySelector(`.head-modal`));
                        suggestionBar(headSearch, headSearchDd, headSearch.id, headSearch.textContent);
                    }
                }
                else {
                    if (btn.nextElementSibling) {
                        if (dropdown[index-minusIndex] && dropdown[index-minusIndex].style.display === "block") {
                            if (!btn.parentNode.contains(event.target)) { dropdown[index-minusIndex].style.display = "none"; } //hide modal that the menu not clicked
                        }
                    }
                    else if (event.target == taskbar) {
                        if (taskbar.style.display === "block") { taskbar.style.display = "none"; shade_show("remove"); } //close taskbar if clicked the background
                    }
                    else if ((headBtn.length <= 2 && index == headBtn.length - 2) || (headBtn.length > 2 && index == headBtn.length - 4)) { //close search menu if clicked the background
                        var search_exitBtn = document.querySelector(`#form_search button`);
                        if (event.target == document.querySelector(`#form_search`) || event.target == search_exitBtn) {
                            form_function(document.querySelector(`.head-modal`));
                        }
                    }
                }
            });

        //tabel or Slide List
            if (tabel_select) { //selected filter table
                tabel_select.forEach((select,index) => {
                    // console.log("select", select, "select.querySelector", select.querySelector(`.drop-select`));
                    var dropSelect = select.querySelector(`.drop-select`); //Dropdown menu for filter select list
                    var selectValue = select.querySelector(`.search-value`); //Selected list from filter select list

                    if (dropSelect) { //Chek if this tabel have dropdown menu for each table menu
                        var selectMenu = dropSelect.querySelectorAll(`div ul li`); //List in dropdown menu filter select
                    }
                    var inputValue; //Typed Input from dropdown menu select list

                    if (select.contains(event.target)) {
                        // console.log(select,event.target, select.id,selectValue);
                        if (!select.id.includes("jdl")) { //show dropdown menu of filter select table (catatan penulis, penulis, jurusan)
                            if (dropSelect) {
                                selectValue.classList.add("show");
                            }
                        }
                        if (select.querySelector(`.search-value input`)) { //check if this filter select is Contain Key Input
                            inputValue = select.querySelector('.search-value input'); //location of input variabel and selected same
                            selectValue = select.querySelector('.search-value input');
                        }
                        else {
                            inputValue = select.querySelector('.select-search input'); //location of input variabel and selected different
                        }

                        selectMenu.forEach((menu, index) => {
                            if (event.target == menu) {
                                if (dropSelect.querySelector(`ul li.active`)) { //remove active class from unselected filter list
                                    dropSelect.querySelector(`ul li.active`).classList.remove("active");
                                }
                                menu.classList.add("active"); //add active class for selected filter list
                                // console.log(menu,menu.classList);
                                if (!select.id.includes("final")) { //change value of filter list for (penulis, prodi) select list
                                    inputValue.value = menu.textContent;
                                }
                                selectValue.innerHTML = menu.textContent; //change selectted value of filter list for catatan revisi
                                checkTypeList();
                                
                        
                                selectValue.classList.remove("show"); //close List in dropdown menu filter select
                            }
                        });
                        if (!select.id.includes("final")) {
                            // console.log(inputValue.value, dropSelect, select.id, selectValue.innerText);
                            suggestionBar(inputValue, dropSelect, select.id, selectValue.textContent); //show suggestion for List in dropdown menu filter select
                        }
                    }
                    else {
                        if (dropSelect) {
                            selectValue.classList.remove("show"); //close List in dropdown menu filter select
                        }
                    }
                    
                });
            }

            if (dropmenu) { //dropdown menu for each table row
                dropmenu.forEach((btn,index) => {
                    var next = btn.nextElementSibling;
                    var tr = btn.parentNode.parentNode;
                    if (event.target == btn) {
                        if (next) { //show clicked menu dropdown if hidden
                            if (next.style.display === "none") { next.style.display = "block"; }
                            else { next.style.display = "none"; }
                        }
                        else {
                            tr = btn.parentNode;
                            form_inside(form_wrapper,tr.getAttribute('data-id')); //make div child for every revision in this article
                        }
                    }
                    else {
                        if (next) {
                            if (next.style.display === "block") { //if menu dropdown show
                                if (!btn.parentNode.contains(event.target)) { next.style.display = "none"; } //close unclicked menu dropdown
                                else {
                                    if (event.target.textContent.includes("Lihat Artikel")) { //if click (Lihat Artikel) menu
    
                                    }
                                    else if (event.target.textContent.includes("Upload Ulang")) { //if click (Lihat Artikel) menu
                                        
                                    }
                                    else if (event.target.textContent.includes("Status Perubahan")) { //if click (Lihat Artikel) menu
                                        form_inside(form_wrapper,tr.getAttribute('data-id')); //make div child for every revision in this article
                                    }
                                    else if (event.target.textContent.includes("Hapus Artikel")) { //if click (Lihat Artikel) menu
                                        
                                    }
                                    next.style.display = "none"; //close menu dropdown
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
            // form upload
            if (form_page) { //full form page for upload
                form_page.forEach((form,formIndex) => {
                    // console.log(form);
                    var form_list = form.querySelectorAll(`.form-sub`);

                    if (form_list) {
                        form_list.forEach((list,listIndex) => {
                            // console.log(form.id,list);

                            // Hierarki urutan searchbar
                            // .form-sub \.\ .form-sub.addBox                                                                        (M)
                            // .select   \\ .input                                                                                   (0)
                            // div(Title Searchbar) -|.|- div.search-input                                                           (1)
                            // .................... -|.|- div.searchbar.searchFull.search-value |.| .searchbar.search-dd.drop-select (2)
                            // .................... -|.|- input#id    || button                 |.| .se-se-bar                       (3)
                            // .................... -|.|- ..................................... |.| ul.select-droped                 (4)
                            // .................... -|.|- ..................................... |.| li                               (5)
                            
                            var searchbar = list.querySelectorAll(`.search-value`); //hierarki (2)

                            searchbar.forEach(search => {
                                // console.log(event.target,search.parentNode,search.parentNode.contains(event.target));
                                // console.log(search);
                                var thisBtn = search.querySelector(`button`);
                                if (search.parentNode.contains(event.target) || 
                                    event.target == thisBtn || 
                                    thisBtn.contains(event.target)) { //open searchbar dropdown menu, memilih list row revisi
                                    var search_parent = search.parentNode; //hierarki (1)
                                    var search_dd = search_parent.querySelector(`.search-dd`); //hierarki (2)
                                    var search_input = search.querySelector(`input`);  //hierarki (3)
                                    var search_dd_menu = search_dd.querySelectorAll(`div ul li`);  //hierarki (5)
                                    // console.log(event.target);
                                    form_searchbar(event.target, search_parent, search, search_input, search_dd, search_dd_menu); //open-close dropdown input that has suggestion, add active to selected value
                                    
                                    // console.log(search_input.value);
                                    if (!search.classList.contains("show")) { //change after dropdown input closed
                                        // console.log(search,search_parent.parentNode,search_parent.parentNode.nextElementSibling);
                                        
                                        var parent = search_parent.parentNode; //hierarki (0)
                                        var loc_next = parent.nextElementSibling; //hierarki (0) yang mirip dengan parent
                                        
                                        if (search_input.value.includes("Baru")) { //memilih penulis atau prodi baru yang tidak ada dalam database
                                            // console.log(!loc_next || loc_next.classList.contains("select"));
                                            if (!loc_next || loc_next.classList.contains("select")) {
                                                var next = document.createElement("div"); //membuat .input, hierarki (0), baru di lokasi selanjut hierarki (0)
                                                
                                                // .input
                                                    parent.classList.forEach(classL => {
                                                        // console.log(classL);
                                                        next.classList.add(classL);
                                                    })
                                                    next.classList.add("input");
                                                    next.classList.remove("select");
                                                    next.setAttribute(`id`,`text-`+search_parent.id)
        
                                                    var inner = `<div class="col-md-3"></div>
                                                                <div class="col-md-9 search_input d-flex flex-wrap">
                                                                    <div class="searchbar w-100">
                                                                        <input class="w-100" type="text" name="`+search_parent.id+`" id="`+search_parent.id+`"`
                                                    if (search_parent.id.includes("pnl")) {
                                                        inner += `placeholder="[Nama Penulis]" autocomplete="off">
                                                                    </div>
                                                                </div>`
                                                    }
                                                    else if (search_parent.id.includes("prodi")) {
                                                        inner += `placeholder="[Program Studi]" autocomplete="off">
                                                                    </div>
                                                                </div>`
                                                    }
                                                // .input
    
                                                form_addNewElement(parent.parentNode, loc_next, next, inner);
                                            }
                                        }
                                        else if (!search_input.value.includes("Baru")) { //memilih penulis atau prodi baru yang ada dalam database
                                            if (document.getElementById("text-"+search_parent.id)) {
                                                // console.log(document.getElementById("text-"+search_parent.id));
                                                document.getElementById("text-"+search_parent.id).remove();
                                            }
                                        }
                                        list_penulis_jurusan.forEach(pp => {
                                            if (search_input.value == pp[0]) {
                                                list_up_prodi[search_input.id.split('-')[1]-1] = pp[1];
                                            }
                                        });
                                    }
                                    // console.log(search_input);
                                    if (search_input.id.split('-')[0] == 'pnl') {
                                        list_up_penulis[search_input.id.split('-')[1]-1] = search_input.value;
                                        // console.table(list_up_penulis);
                                    }
                                    else if (search_input.id.split('-')[0] == 'prodi') {
                                        list_up_prodi[search_input.id.split('-')[1]-1] = search_input.value;
                                        // console.table(list_up_prodi);
                                    }

                                }
                                else { search.classList.remove(`show`); } //close searchbar dropdown menu
                            })
                            
                            
                            var listBtn = list.querySelectorAll(`button`); //list semua button yang ada dalam form-sub, hirarki (0)
                            listBtn.forEach(btn => {
                                if (btn.contains(event.target)) {
                                    // console.log(btn);
                                    // console.log(list);
                                    // console.log(form,form.childElementCount,form.children);
                                    
                                    if (list.classList.contains("addBox")) { //click button child of div.form-sub.addBox
                                        // console.log(btn,"Add");
                                        
                                        form_update(list.parentNode);
                                        if (form.childElementCount <= 6) { //this button can only click 3x while form child <= 6
                                            // console.log(form,list);
                                            form_addPenulis(form, list);
                                            if (form.childElementCount == 6) { //hidden .addBox when form child == 6
                                                btn.parentNode.style.display = "none";
                                            }
                                        }
                                    }
                                    else if (btn.classList.contains("cancel-btn")) { //delete a row from list form
                                        // console.log("---------------Cancel Penulis---------------");
                                        if (form.childElementCount > 3) {
                                            list.remove();
                                            // console.log(listIndex);
                                            list_up_penulis[listIndex] = null;
                                            list_up_penulis_text[listIndex] = null;
                                            list_up_prodi[listIndex] = null;
                                            list_up_prodi_text[listIndex] = null;
                                        }
                                        if (form.childElementCount < 6) {
                                            form.children[form.childElementCount-1].style.display = null;
                                        }
                                    }
                                     
                                    ThisForm = document.querySelector(`.form_sub.row#profile`);
                                    if (ThisForm) {
                                        // console.log(ThisForm.childElementCount, ThisForm.querySelectorAll(`.form-sub`).length);
                                        ThisForm.querySelectorAll(`.form-sub`).forEach((item,itemIndex) => {
                                            if (!item.classList.contains(`addBox`)) {
                                                // console.log("Lenght: ",ThisForm.querySelectorAll(`.form-sub`).length, " | itemIndex: ",itemIndex,item);
                                                // // console.log(item,item.querySelectorAll(`input`));
                                                // console.log("replace_id_list(item.outerHTML,", itemIndex+1,")");

                                                item.querySelectorAll(`input`).forEach(input => {
                                                    // console.log("Before: ",input.name," | ",input.id," | ",input.outerHTML);
                                                    input.name = replace_id_list(input.name, itemIndex+1);
                                                    input.id = replace_id_list(input.id, itemIndex+1);
                                                    input.outerHTML = replace_id_list(input.outerHTML, itemIndex+1);
                                                    // console.log("After: ",input.name," | ",input.id," | ",input.outerHTML);
                                                })
                                                item.outerHTML = replace_id_list(item.outerHTML, itemIndex+1);
                                            }
                                        });
                                    }
                                    form_update(form);
                                }
                            
                            })
                            // console.log(list.querySelectorAll(`.search-value`));
                        
                            form_update(form, list);
                        })
                    }
                })
            }    

            
            // form-modal
                if (pointer_history) { //form of history of revision
                    pointer_history = document.querySelectorAll(`.history_list .pointer`);
                    pointer_history.forEach((pointer,pointerIndex) => {

                        //pointer hierarchy
                        //.history_form                                                    (M)
                        //.history_list.parent -|.|- .history_list.border-top -|.|- .child (0)

                        if (pointer.contains(event.target)) { //clicked pointer or the child
                            var parent = pointer.parentNode;
                            var detail = parent.nextSibling;
                            var indexChild = 0;

                            form_history.childNodes.forEach((child, index) => { if (parent == child) { indexChild = index + 1; } });
                            
                            if (parent.classList.contains("parent")) { //child detail deleted
                                parent.classList.remove("parent");
                                detail.remove();
                            }
                            else { //child detail added, add .parent class
                                var last_list = form_history.lastElementChild;
                
                                parent.classList.add("parent");
                                var child = document.createElement("div");

                                //location of detail .child
                                if (parent.nextSibling) { parent.parentNode.insertBefore(child, parent.nextSibling); } //add detail .child after pointer position
                                else { parent.parentNode.appendChild(child); } //add detail .child as last child
                                
                                child.classList.add("child");
                                var loc = parent.nextElementSibling;
                                
                                var thisFinalize = "";
                                var thisStatus = "";
                                var thisNextStatus = "";
                                var thisRevisi = "";
                                var thisJudul = "";
                                render_list.forEach(data => {
                                    if (data[0] == form_judul.textContent)
                                    {
                                        thisFinalize = data[1];
                                    }
                                    historyArray.forEach(element => {
                                        if (element[0] == form_judul.textContent) {
                                            thisStatus = element[4][pointerIndex];
                                            thisNextStatus = element[5][pointerIndex];
                                            thisRevisi = element[6][pointerIndex];
                                            thisJudul = element[7][pointerIndex];
                                        }
                                    });
                                });

                                var input = input_history(thisJudul, parent, last_list, thisFinalize, thisStatus, thisNextStatus, thisRevisi);
                                loc.innerHTML = input;
                                
                                if (form.querySelector(`select`)) {
                                    e = form.querySelector(`select`);
                                    change_Selected_Value(e,thisNextStatus,thisNextStatus);
                                }
                            }
                        }
                    });
                }

                if (form_wrapper) { //modal form of prodi selection
                    // console.log(form_wrapper);
                    var open_form_btn = document.querySelector(`.filter-btn`);

                    if (open_form_btn && open_form_btn.contains(event.target)) { form_function(form_wrapper); } //open modal

                    if (form_wrapper.classList.contains("show")) { //form modal opened
                        
                        if (!check_prodi_list) {
                            // console.log(form_wrapper.querySelector(`form`).action);
                            split_route = form_wrapper.querySelector(`form`).action.split("/");
                            // console.log(split_route, form_judul.textContent);
                            nextAction = '';
                            for (let index = 0; index < split_route.length; index++) {
                                if (index != split_route.length-1) { 
                                    // console.log(split_route[index]);
                                    nextAction = nextAction + split_route[index]+'/'; 
                                }
                                else {
                                    // console.log("last : "+split_route[index]);
                                    nextAction = nextAction + form_judul.textContent; 
                                }
                                // console.log(nextAction);
                            }
                            form_wrapper.querySelector(`form`).action = nextAction;
                            // console.log(form_wrapper.querySelector(`form`).action);
                        }

                        var from_btn = form_wrapper.querySelectorAll(`.btn`);
                        from_btn.forEach((btn) => {
                            if ((event.target == form_wrapper.childNodes[1]) || (event.target == btn)) {
                                if (btn.type === "submit") {
                                    
                                    // console.log("The form was submitted");
                                    if (check_prodi_list) {
                                        document.getElementById("form-status").addEventListener('submit', (event) => { event.preventDefault(); });
                                        var checkboxes = document.querySelectorAll('input[name="prodi"]:checked');
                                        if (checkboxes) {
                                            var values = [];
                                            checkboxes.forEach((checkbox) => {
                                                values.push(checkbox.nextElementSibling.querySelector('span').textContent);
                                            });
                                            if (!lokasi.includes(`profile`)) {
                                                ProdiList(values);
                                            }
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
                    if (form_wrapper.querySelector(`select`)) {
                        e = form_wrapper.querySelector(`select`);
                        eValue = e.value;
                        eText = e.options[e.selectedIndex].text;
                        change_Selected_Value(e,eValue,eText);
                    }
                }

                
            //login form
                if (panel_switch) {
                    var change_btn = document.querySelector(`.change-btn`);
                    
                    if (change_btn) {
                        if (change_btn.contains(event.target)) {
                            before = document.querySelector('form').name;
                            // console.log("from ",document.querySelector('form').name, " || href to ",);

                            if (document.querySelector('form').name == 'signup') {  document.querySelector('form').name = 'login'; }
                            else { document.querySelector('form').name = 'signup'; }

                            after = document.querySelector('form').name
                            // console.log("to ",document.querySelector('form').name);
                            window.location.href = window.location.href.replace(before,after);
                            // panelChange(panel_switch[0].querySelector(`#change`), panel_switch[1], document.querySelector('form').name);
                            
                        }
                    }
                }
            
            //delete from list
            if (document.querySelector(`.cancel-btn`)) {
                var ItemList;
                ItemList = document.querySelectorAll(`.cancel-btn`);
                ItemList.forEach(item => {
                    deleteAdd_btn(item, event.target, 'delete');
                });
            }
            if (document.querySelector(`.add-btn`)) {
                var item = document.querySelector(`.add-btn`);
                deleteAdd_btn(item, event.target, 'add');
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
            head_isi.classList.add(`formShow`);
            main_isi.classList.add(`formShow`);
        }
        else {
            head_isi.classList.remove(`formShow`);
            main_isi.classList.remove(`formShow`);
        }
    }
    function shade_show(isi) {
        if (isi == "show") { shade.classList.add(isi); }
        else { shade.classList.remove("show"); }
    }
    function UniqueList(value, index, self) {
        return self.indexOf(value) === index;
    }
    function change_Selected_Value(selectElement,eValue,eText)
    {
        for (let i = 0; i < e.options.length; i++) {
            if (selectElement.options[i].value == eText) {
                selectElement.options[0].removeAttribute('selected');
                selectElement.options[i].setAttribute('selected',true);
            }
        }
    }
    function deleteAdd_btn(item, clicked, typeBtn) {
        var ItemList_Parent;
        if (lokasi.includes(`prodi`)){
            if (typeBtn == 'add') { ItemList_Parent = item.parentNode.parentNode; }
            else if (typeBtn == 'delete'){ ItemList_Parent = item.parentNode; }
        }
        else if (lokasi.includes(`my`)) {
            if (typeBtn == 'add') { ItemList_Parent = item.parentNode; }
            else if (typeBtn == 'delete'){
                document.querySelectorAll(`table tr`).forEach(element => {
                    if (element.contains(clicked) && element.contains(item)) {
                        ItemList_Parent = element;
                    }
                });
            }
        }
        var item_id;
        var item_name;
        var clickedParent;
        if (lokasi.includes(`prodi`)){
            document.querySelectorAll(`form div input`).forEach(element => {
                if (element.parentNode.contains(clicked)) {
                    clickedParent = (element.id).replace(`img-input_`, ``);
                }
            });
        }
        else if (lokasi.includes(`my`)) {
            document.querySelectorAll(`table tr`).forEach(element => {
                if (element.contains(clicked)) {
                    clickedParent = element.querySelector(`td`).innerText;
                }
            });
        }
        if (ItemList_Parent && ItemList_Parent.querySelector(`.form-modal`)) {
            var modal = ItemList_Parent.querySelector(`.form-modal`);
            var thisForm;
            var typeForm;
            if (lokasi.includes(`prodi`)){
                thisForm = document.querySelector(`main form`);
                if (thisForm.querySelector(`#form_add`)) { typeForm = 'add'; }
                else if (thisForm.querySelector(`#form_delete`)) { typeForm = 'delete_' + clickedParent; }
            }
            else if (lokasi.includes(`my`)) {
                thisForm = modal.querySelector(`form`);
                if (modal.querySelector(`#form_add`)) { typeForm = 'add'; }
                else if (modal.querySelector(`#form_delete`)) { typeForm = 'delete_' + clickedParent; }
            }
            
            if (typeForm) {
                if (typeForm.includes('add')) {
                    thisForm.action = lokasi;
                    thisForm.querySelectorAll(`input`).forEach(inputElement => {
                        if (inputElement.name == `_method`) {inputElement.remove()}
                    });
                }
                else if (typeForm.includes('delete')){
                    item_id = modal.getAttribute(`data-id`);
                    if (lokasi.includes(`prodi`)){
                        item_name = modal.querySelector(`strong`).id;
                        thisForm.querySelectorAll(`input`).forEach(inputElement => {
                            if (inputElement.name == `_method`) {inputElement.value = `DELETE`;}
                        });
                    }
                    else if (lokasi.includes(`my`)) {
                        document.querySelectorAll(`input`).forEach(element => {
                            if (element.type == 'hidden' && !thisForm.contains(element)) {
                                var inputMethod = element;
                                form_addNewElement(thisForm, thisForm.querySelector(`strong`), inputMethod, '');
                                
                                inputMethod = document.createElement("input");
                                inputMethod.type = 'hidden';
                                inputMethod.name = "_method";
                                inputMethod.value = "DELETE";
                                form_addNewElement(thisForm, thisForm.querySelector(`strong`), inputMethod, '');
                            }
                        });
                    }
                    thisForm.action = lokasi+`/delete/`+item_id;
                }
                if (typeForm.includes(typeBtn) && 
                ItemList_Parent.contains(clicked) &&
                (!modal.contains(clicked) ||
                clicked.classList.contains("close-btn"))) {
                    thisForm.action = lokasi+`/update`;
                    if (typeBtn == 'add' && typeForm.includes('add')) {
                        console.log("=================Add Data=================");
                        var inputMethod = document.createElement("input");
                        inputMethod.type = 'hidden';
                        inputMethod.name = "_method";
                        inputMethod.value = "PUT";
                        form_function(modal);
                        modal.remove();
                    }
                    else if (typeBtn == 'delete' && typeForm.includes('delete')){
                        var listData;
                        var listData_Parent;
                        if (lokasi.includes(`prodi`)){ listData = document.querySelectorAll(`form div input`); }
                        else if (lokasi.includes(`my`)) { listData = document.querySelectorAll(`table tr`); }
                        listData.forEach(element => {
                            if (lokasi.includes(`prodi`)){ listData_Parent= element.parentNode; }
                            else if (lokasi.includes(`my`)) { listData_Parent= element; }
                            if (listData_Parent.contains(clicked) && listData_Parent.contains(item)) {
                                thisForm.querySelectorAll(`input`).forEach(inputElement => {
                                    if (inputElement.name == `_method`) {inputElement.value = `PUT`;}
                                });
                                form_function(modal);
                                modal.remove();
                            }
                        });
                    }
    
                }
            }

        }
        else if (item.contains(clicked)){
            if (lokasi.includes(`prodi`)) {
                if (typeBtn == 'add') {}
                else if (typeBtn == 'delete') {
                    ItemList_Parent.querySelectorAll(`input`).forEach(element => {
                        if (element.type == "file") { item_id = (element.id).replace(`img-input_`, ``); }
                        else if (element.type == "text") { item_name = element.value; }
                    });
                }
            }
            else if (lokasi.includes(`my`)) {
                if (typeBtn == 'add') {}
                else if (typeBtn == 'delete') { item_id = clickedParent; }
            }
            modal = document.createElement("div");
            modal.classList.add(`form-modal`);
            modal.style.display = `none`;
            if (typeBtn == 'add' && lokasi.includes(`prodi`)) {
                form_addNewElement(ItemList_Parent, null , modal, 
                    `<div class="fliter-form h-auto p-3" id="form_add">
                        <div class="form-card card col-md-8">
                            <div class="mx-3">
                                <div class="card-head d-flex flex-wrap justify-content-between align-items-center p-3 pt-0">
                                    <h3 class="col-auto">Menambahkan Data</h3>
                                    <button class="btn col-auto close-btn" type="button">X</button>
                                </div>
                                <div class="card-body">
                                    <div class="input d-flex flex-wrap justify-content-between align-items-center my-3 mb-4 my-md-2" id="text-pnl-1">
                                        <div class="col-12 col-md-3"><strong>Lambang Program Studi</strong><strong class="col-red-1 px-1">*</strong></div>
                                        <div class="col-12 col-md-9 search_input d-flex flex-wrap">
                                            <div class="searchbar w-100 px-3 h-auto" style="min-height:15vw">
                                                <input class="form-file" id="Create_img" type="file" name="Create_img" accept=".jpg, .png" autocomplete="off" hidden required onchange="priviewImage('Create_img');">
                                                <label for="Create_img" class="btn w-100 h-100 position-relative d-flex flex-wrap justify-content-center align-items-center">
                                                    <img src="" id="Create_img_upload" style="width:100%;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="blank-pp" class="bi bi-journal" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
                                                    </svg>
                                                    <div class="text-center w-100 d-flex flex-column align-items-center justify-content-center">
                                                        <p>Upload Image (JPG/PNG)</p>
                                                        <p>Max Size 5 MB</p>
                                                        <p class="link"><strong>Pilih Gambar</strong></p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="input d-flex flex-wrap justify-content-between align-items-center my-3 my-mb-2" id="text-pnl-1">
                                        <div class="col-12 col-md-3"><strong>Nama Program Studi</strong><strong class="col-red-1 px-1">*</strong></div>
                                        <div class="col-12 col-md-9 search_input d-flex flex-wrap">
                                            <div class="searchbar w-100 px-3">
                                                <input name="Create_nama" type="text" class="p-0" placeholder="Nama Program Studi" autocomplete="off" required>
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="row justify-content-end">
                                        <button type="button" class="btn submit-btn-border col-auto mx-1 close-btn">Close</button>
                                        <button type="submit" class="btn submit-btn col-auto mx-1">Tambah Baru</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`
                );
            }
            else if (typeBtn == 'delete' && lokasi.includes(`prodi`)) {
                modal.setAttribute(`data-id`,item_id);
                form_addNewElement(ItemList_Parent, null , modal, 
                    `<div class="fliter-form h-auto p-3" id="form_delete">
                        <div class="form-card card col-md-8">
                            <div class="mx-3">
                                <div class="card-head d-flex flex-wrap justify-content-between align-items-center p-3 pt-0">
                                    <h3 class="col-auto">Hapus Data</h3>
                                    <button class="btn col-auto close-btn" type="button">X</button>
                                </div>
                                <div class="card-body">
                                    <form action="`+lokasi+`/delete/`+item_id+`" method="POST">
                                        <strong id="`+item_name+`"> Apakah Anda Yakin akan menghapus Program Studi [`+item_name+`]?</strong>
                                        <div class="row justify-content-end">
                                            <button type="button" class="btn rounded-pill col-auto mx-1 btn-secondary close-btn">Close</button>
                                            <button type="submit" class="btn rounded-pill col-auto bg-red-1 mx-1">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>`
                );
            }
            else if (typeBtn == 'delete' && lokasi.includes(`my`)) {
                modal.setAttribute(`data-id`,item_id);
                form_addNewElement(ItemList_Parent, null , modal, 
                    `<div class="fliter-form h-auto p-3" id="form_delete">
                        <div class="form-card card col-md-8">
                            <div class="mx-3">
                                <div class="card-head d-flex flex-wrap justify-content-between align-items-center p-3 pt-0">
                                    <h3 class="col-auto">Hapus Artikel</h3>
                                    <button class="btn col-auto close-btn" type="button">X</button>
                                </div>
                                <div class="card-body">
                                    <form action="`+lokasi+`/delete/`+clickedParent+`" method="POST">
                                        <strong id="`+clickedParent+`"> Apakah Anda Yakin akan menghapus Artikel [`+clickedParent+`]?</strong>
                                        <div class="row justify-content-end">
                                            <button type="button" class="btn rounded-pill col-auto mx-1 btn-secondary close-btn">Close</button>
                                            <button type="submit" class="btn rounded-pill col-auto bg-red-1 mx-1">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>`
                );
            }
            
            form_function(modal);
        }
    }

//tabel
    function replace_id_list(text, id) {
        for (let i = 1; i <= 100; i++) {
            if (text.includes("Penulis") || text.includes("penulis") || text.includes("pnl")) {
                text = text.replace(`Penulis `+i, `Penulis `+(id));
                text = text.replace(`pnl-`+i, `pnl-`+(id));
                text = text.replace(`pnl_`+i, `pnl_`+(id));
                // console.log(text);
            }
            if (text.includes("Program Studi") || text.includes("Prodi") || text.includes("prodi")) {
                text = text.replace(`Program Studi`+i, `Program Studi `+(id));
                text = text.replace(`Prodi `+i, `Prodi `+(id));
                text = text.replace(`prodi-`+i, `prodi-`+(id));
                text = text.replace(`prodi_`+i, `prodi_`+(id));
                // console.log(text);
            }
        }
        
        
        // console.log(text);
        return text;
    }
    function DisplayList(items, location_item, rowsPage, page, type) {
        var item = [].concat(items);
        // console.log(type, type.includes("slide"));
        if (type.includes("slide")) {
            // item = [];
            var penulis = [].concat(All_penulis);
            penulis = All_penulis.filter(function (value) {
                var selected = false;
                item.forEach(pnl => {
                    if (pnl[2].includes(value['nama_penulis'])) {
                        prodi_select_list.forEach(element => {
                            if (value['nama_jurusan'] == element || value['nama_jurusan'] == null) {
                                selected = true;
                            }
                        });
                    }
                });
                if (selected) { return value; }
            })
            item = penulis.filter(UniqueList).sort();
            
            penulis_slide = penulis.filter(UniqueList).sort();
        }
        else if (type.includes("dropdown")) {
            // var thisAuthor = "Penulis A";
            item = [];
            items.forEach((data) => { 
                if (data[2].toLocaleLowerCase().includes(thisAuthor.toLocaleLowerCase())) { item.push(data); }
            });
        }
        location_item.innerHTML = '';
        page --;
        let start = rowsPage * page;
        let end = start + rowsPage;
        paginatedItems = item.slice(start, end);

        // console.log(start, end, item);
        // console.log(paginatedItems);
        if (paginatedItems.length != 0) {
            let result = '';
            for (let i = 0; i < paginatedItems.length; i++) {
                if (type.includes("slide")) {
                    result += input_list(paginatedItems[i]['id_akun'], paginatedItems[i]['foto_profil'], "", paginatedItems[i]['nama_penulis'], "", "", "", "", type);
                }
                else if (type.includes("tabel")) {
                    result += input_list((i + 1), paginatedItems[i][0], paginatedItems[i][1], paginatedItems[i][2], paginatedItems[i][3], paginatedItems[i][4], paginatedItems[i][5], paginatedItems[i][6], type);
                }
            }
            location_item.innerHTML = result;
        }
        else {
            
        }
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
    function input_list(id, judul, revisi, pnl, prodi, up, rilis, status, type) {
        // console.log(type);
        let first_column = '';
        let last_column = '';
        if (type.includes("tabel")) {
            first_column = `<tr data-id="`+ id +`">
                                <td><a href="../article/`+ judul+`">`+ judul+`</a></td>`;
            if (type.includes("pointer")) {
                last_column = `<td>`;
                if (pnl.includes(", ")) {
                    pnl.split(", ").forEach((element, elementIndex) => {
                        last_column += `<a href="@`+ element +`">`+ element +`</a>`
                        if (elementIndex < (pnl.split(", ").length)-1) {
                            last_column += `, `;
                        }
                    });
                }
                else { last_column += `<a href="@`+ pnl +`">`+ pnl +`</a>` }
                last_column += `</td>
                                <td>`+ prodi+`</td>
                                <td class="btn pointer">View</td>
                            </tr>`;
            }
            else if (type.includes("status")) {
                last_column = `<td>`;
                if (pnl.includes(", ")) {
                    pnl.split(", ").forEach((element, elementIndex) => {
                        last_column += `<a href="@`+ element +`">`+ element +`</a>`
                        if (elementIndex < (pnl.split(", ").length)-1) {
                            last_column += `, `;
                        }
                    });
                }
                else { last_column += `<a href="@`+ pnl +`">`+ pnl +`</a>` }
                last_column += `</td>
                                <td>`+ prodi+`</td>
                            </tr>`;
            }
            else if (type.includes("dropdown")) {
                last_column = `<td>`+ up +`</td>
                <td>`+ rilis +`</td>
                <td>`+ status +`</td>
                <td>
                    <button class="btn pointer drop-btn"> Lainnya </button>
                    <div class="dropdown-menu card se-se-bar" id="dropdown-menu-article" style="display: none;">
                        <ul class="select-droped">
                            <a href="article/`+judul+`"><li>Lihat Artikel</li></a>`;
                if (revisi == 'Yes' && status != 'Layak Publish') {
                    last_column += `<a href="article/`+judul+`/re-upload"><li>Upload Revisi</li></a>`;
                }
                last_column += `<li>Status Perubahan</li>
                                <li class="bg-red-1 cancel-btn">Hapus Artikel</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>`;
            }
            else if (type.includes("artikel_penulis")) {
                last_column = `<td>`+ up +`</td>
                                <td>`+ rilis +`</td>`;
            }
        }
        else if (type.includes("slide")) {
            first_column = `<a href="@`+ pnl +`" class="profile-box d-flex flex-wrap justify-content-around align-items-center col-md-3 m-2 mx-3">`
            if (id && judul) {
                first_column += `<img src="`+ window.location.origin +`/storage/profile-image/`+ judul +`" alt="`+ pnl +`" style="width:75px; height:75px;">`;
            }
            else {
                first_column += `<svg xmlns="http://www.w3.org/2000/svg" width="75" height="75" fill="currentColor" id="blank-pp" class="bi bi-person-circle" viewBox="0 0 16 16" style="display: block; opacity: 0.75;">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                </svg>`;
            }
            first_column += `<p id="profile-name">`+ pnl +`</p>
                            </a>`;
                            
        }
        else if (type.includes("search")) {
            first_column = `<a href="">
                                <li class="d-flex m-3 border-bottom rounded-1 line-1">
                                    <div class="col-4 p-2">
                                        <img src="`+ prodi +`" alt="`+ prodi +`">
                                    </div>
                                    <div class="flex-grow-1 flex-column justify-content-between p-2">
                                        <div>`+ judul +`</div>
                                        <div>`+ pnl +`</div>
                                    </div>
                                </li>
                            </a>`;
        }
        
        
        return first_column + last_column;
    }
    function RenderFinal(type) { //render type table that gonna show
        var render_item = [].concat(final_list); //render list for table
        var judul_search, final_select, pnl_select, prodi_select = ''; //selected item for filter
        tabel_select.forEach(item => { //check if this page has filter menu
            // console.log(item,item.id,item.querySelector('.search-value').textContent);
            // console.log(item,item.querySelector('.search-value'),item.querySelector('.search-value').innerText);
            
            if (item.id.includes("jdl")) { judul_search = item.querySelector('.search-value input').value }
            if (item.id.includes("final")) { final_select = item.querySelector('.search-value').innerText; }
            if (item.id.includes("pnl")) { pnl_select = item.querySelector('.search-value').innerText; }
            if (item.id.includes("prodi")) { prodi_select = item.querySelector('.search-value').innerText; }
        });
        
        // console.log(render_item);
        // console.log(judul_search, final_select, pnl_select, prodi_select);

        //input all for null data
        if ((!judul_search) || (judul_search.includes(">"))) { judul_search = "All"}
        if (!final_select) { final_select = "All"}
        if ((!pnl_select) || pnl_select.includes(">")) { pnl_select = "All"}
        if ((!prodi_select) || prodi_select.includes(">")) {
            if ((!prodi_select) && (document.querySelector(`.filter-prodi`))) { prodi_select = prodi_select_list; }
            else { prodi_select = "All"; }
        }

        // console.log("judul_search", judul_search, "   || final_select", final_select);
        // console.log("prodi_select", prodi_select, "   || pnl_select", pnl_select);
        
        //Filter by Selected
            render_item = render_item.filter(function (value) {//filter Finalize
                if (final_select != "All") { return value[1] == final_select; }
                else { return value }
            })
            render_item = render_item.filter(function (value) {//filter Penulis
                if (pnl_select != "All") { return value[2].includes(pnl_select); }
                else { return value }
            })
            render_item = render_item.filter(function (value) {//filter Prodi
                if (prodi_select != "All") { 
                    if (Array.isArray(prodi_select)) {
                        var selected = false;
                        prodi_select.forEach(prodi => {
                            if (value[3].includes(prodi) || value[3] == null) { selected = true; }
                        });
                        if (selected) { return value; }
                    }
                    else { return value[3].includes(prodi_select); }
                 }
                else { return value }
            })
            render_item = render_item.filter(function (value) {//filter Judul
                if (judul_search != "All") { return value[0].includes(judul_search); }
                else { return value }
            })
        //

        
        render_list = [].concat(render_item); //list yang akan ditampilkan
        // console.log(render_list, tabel_list, row_tabel, tabel_page.innerHTML, type);
        if (type.includes("tabel")) { DisplayList(render_item, tabel_list, row_tabel, tabel_page.innerHTML, type); } //list ditampilkan dalam tampilan tabel
        else if (type.includes("slide")) { DisplayList(render_item, slide_list, row_slide, slide_page.innerHTML, "slide"); } //list ditampilkan dalam tampilan slide
    }
    function checkTypeList() { //type render for every html file
        // console.log(lokasi);
        if (lokasi.includes("my")) { RenderFinal("tabel_dropdown"); } //self article page
        else if (lokasi.includes("status")) { RenderFinal("tabel_pointer"); } //article status change article page -Admin only
        else if (lokasi.includes("index")) { //home page
            RenderFinal("tabel_status");
            RenderFinal("slide");
        }
        else if (lokasi.includes("upload")) { //upload article page
            // console.log(form_sub_list,form_sub_list[0].children);
            form_sub_list.forEach((item, item_index) => {
                if (item_index == 0) {
                    item_text = "";
                    for (let i = 0; i < item.childElementCount; i++) {
                        if (!item.children[i].classList.contains("input")) {
                            item_text += item.children[i].outerHTML; //add outerHTML of list
                        }
                    }
                    innerText = item_text;
                }
            })
            // console.log(upload_penulis.children[1]);
            // console.log(innerText);
            upload_penulis.children[1].innerHTML= innerText;
        }
        else if (lokasi.includes("Penulis")) { //upload article page
            RenderFinal("tabel_artikel_penulis");
        }
    }
    //form
        function form_searchbar(value_select, search_wrapper, value_wrapper, input_wrapper, dd_wrapper, dd_menu) { //open-close dropdown input that has suggestion, add active to selected value
            // console.log(value_select);
            // console.log(search_wrapper);
            // console.log(value_wrapper);
            // console.log("input wrapper ", input_wrapper);
            // console.log(dd_wrapper);
            var dd_menu_active = dd_wrapper.querySelector(`div ul li.active`);
            if (value_wrapper.classList.contains("show")) {
                dd_menu.forEach(menu => {
                    // console.log(menu);
                    if (value_select.textContent == menu.textContent) {
                        if (dd_menu_active) {
                            dd_menu_active.classList.remove("active");
                        }
                        menu.classList.add("active");
                        // console.log(value_select,menu);
                        input_wrapper.value = value_select.textContent;
                        input_wrapper.textContent = value_select.textContent;
                        value_wrapper.classList.remove("show");
                    }
                })
            }
            else {
                value_wrapper.classList.add("show");
                if (input_wrapper.value) {
                    suggestionBar(input_wrapper, dd_wrapper, input_wrapper.id, input_wrapper.value);
                }
                else {
                    suggestionBar(input_wrapper, dd_wrapper, input_wrapper.id, input_wrapper.textContent);
                }
                dd_menu = dd_wrapper.querySelectorAll(`div ul li`)
            }
        }
        function form_addNewElement(main_wrapper, Next, New, InnerNew) {
            // console.log("main_wrapper",main_wrapper);
            // console.log("Next",Next);
            // console.log("New",New);
            // console.log("InnerNew",InnerNew);
            if (Next) { main_wrapper.insertBefore(New, Next); }
            else { main_wrapper.appendChild(New); }
            New.innerHTML = InnerNew;
        }
        function form_function(modal) { //open-clos form modal
            // console.log(modal.classList.contains('show'),modal.style.display);
            if (modal.style.display === "none" || !modal.classList.contains("show")) {
                modal.style.display = null;
                modal.classList.add("show");
                shade_show("show");
                overflow_body("hidden");
            }
            else if (modal.classList.contains('show')){
                modal.style.display = "none";
                modal.classList.remove("show");
                shade_show("remove");
                overflow_body("auto");
            }
        }
        function form_inside(wrapper,id) { //make div child for every revision in this article
            form_function(wrapper); //open-close form modal
            const tr = document.querySelectorAll(`tr`); //list item in form per row
            var arraydate = [];
            var arrayFinalize = 'No';
            tr.forEach((item) => {
                if (item.getAttribute('data-id') == id) {
                    form_judul.innerHTML = item.childNodes[1].textContent;
                    final_list.forEach((data,index) => {
                        if (data[0] == item.childNodes[1].textContent) { //check if title same with loop of every article
                            form_penulis.innerHTML = data[2];
                            n_history = count_history[index];
                            arraydate = historyArray[index][3];
                            arrayFinalize = data[1];
                        }
                    });
                }
            });
            // console.log(wrapper);
            // console.log(wrapper.querySelector(`.card-head h3`));
            if (lokasi.includes('status')) { wrapper.querySelector(`.card-head h3`).textContent = 'Ubah Status Revisi'; }
            else {
                wrapper.querySelector(`.card-head h3`).textContent = 'Status Revisi';
                if (wrapper.querySelector(`.card-body button.submit-btn`)) {
                    wrapper.querySelector(`.card-body button.submit-btn`).remove();
                }
            }
            form_history.innerHTML = '';
            for (let i = 0; i < n_history; i++) { //make div child for every revision in this article
                var child = document.createElement("div");
                form_history.appendChild(child);

                child.classList.add("history_list");
                child.classList.add("row");
                if (i != 0) { child.classList.add("border-top"); }

                var loc = form_history.lastElementChild;
                var input = ``;
                if (arrayFinalize == 'No' && i == n_history-1) {
                    input += `<div class="date_up"><strong class="col-red-1">`+arraydate[i]+`</strong></div>`;
                }
                else {
                    input += `<div class="date_up">`+arraydate[i]+`</div>`;
                }
                input += `<span></span>
                        <div class="pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                            </svg>
                        </div>`;
                loc.innerHTML = input;
            }
            
        }
        function input_history(judulDetail, parent, last_list, sFinalize, CurrentStatus, NextStatus, catatanRevisi) {
            var input = `<div class="history_detail row" id="lama">
                            <div class="form_sub_title">Status Lama</div>
                            <div>[`+CurrentStatus+`]</div>
                        </div>`;
            if (last_list != parent) {
                input += `<div class="history_detail row" id="baru">
                            <div class="form_sub_title">Status Baru</div>
                            <div>[`+NextStatus+`]</div>
                        </div>
                        <div class="history_detail row" id="catatan">
                            <div class="form_sub_title">Catatan</div>
                            <div>[`+catatanRevisi+`]</div>
                        </div>
                        <div class="history_detail row" id="artikel">
                            <div class="link" id="see_article"><a href="../article/`+ judulDetail+`">Lihat Artikel</a></div>
                        </div>`;
            }
            else if (last_list == parent) {
                if (lokasi.includes("status")) {
                    input += `<div class="history_detail row" id="baru">
                                <div class="form_sub_title">Status Baru</div>
                                <div>
                                    <select name="status_baru" id="tabel_status_change">
                                        <option disabled="" selected="" value="">[Status Baru]</option>
                                        <option value="Draft">Draft</option>
                                        <option value="Revisi Mayor">Revisi Mayor</option>
                                        <option value="Revisi Minor">Revisi Minor</option>
                                        <option value="Layak Publish">Layak Publish</option>
                                    </select>
                                </div>
                            </div>`;
                    if(sFinalize == 'No'){
                        input += `<div class="history_detail row" id="catatan">
                                <div class="form_sub_title">Catatan</div>
                                <div>
                                    <textarea name="catatan_revisi" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]"></textarea>
                                </div>
                            </div>`;
                    }
                    else {
                        input += `<div class="history_detail row" id="catatan">
                                <div class="form_sub_title">Catatan</div>
                                <div>
                                    <textarea name="catatan_revisi" id="" rows="10" class="searchbar search-jdl" placeholder="[Catatan Revisi Yang diberikan Oleh Admin]"
                                    >`+catatanRevisi+`</textarea>
                                </div>
                            </div>`;
                    }

                    input += `<div class="history_detail row" id="artikel">
                                <div class="link" id="see_article"><a href="../article/`+ judulDetail+`">Lihat Artikel</a></div>
                            </div>`;
                }
                else {
                    input += `<div class="history_detail row" id="baru">
                                <div class="form_sub_title">Status Baru</div>
                                <div>[`+NextStatus+`]</div>
                            </div>
                            <div class="history_detail row" id="catatan">
                                <div class="form_sub_title">Catatan</div>
                                <div>[`+catatanRevisi+`]</div>
                            </div>
                            <div class="history_detail row" id="artikel">
                                <div class="link" id="see_article"><a href="../article/`+ judulDetail+`">Lihat Artikel</a></div>
                            </div>`;
                }
            }
            return input;
        }
        function form_update(form) {
            // console.table(list_up_penulis);
            // console.table(list_up_prodi);
            // console.log(form);
            if (form.parentNode.parentNode.name == "formUpload") {
                form.querySelectorAll(`.form-sub`).forEach(item => {
                    // console.log(item.parentNode.id);
                    if (!item.classList.contains('addBox') && item.parentNode.id != 'artikel') {
                        item.querySelectorAll(`input`).forEach(element => {
                            if (!element.hasAttribute('autocomplete')) {
                                element.setAttribute('autocomplete','off');
                            }
                            // console.log("before: ",element);
                            // console.log(element.id,element.id.split('-')[1],(element.id.includes('pnl')));
                            if (element.id.includes('pnl')) {
                                if (list_up_penulis[element.id.split('-')[1]-1]) {
                                    if (element.classList.contains('text-center')) {
                                        // console.log(element, element.id.split('-')[1]-1, list_up_penulis[element.id.split('-')[1]-1]);
                                        element.defaultValue = list_up_penulis[element.id.split('-')[1]-1];
                                        element.value = list_up_penulis[element.id.split('-')[1]-1];
                                    }
                                    else {
                                        if (!list_up_penulis_text[element.id.split('-')[1]-1]) { list_up_penulis_text[element.id.split('-')[1]-1] = element.value; }
                                        if (list_up_penulis_text[element.id.split('-')[1]-1]) { element.defaultValue = list_up_penulis_text[element.id.split('-')[1]-1]; }
                                    }
                                }
                                else { element.removeAttribute('value'); }
                            } 
                            else if (element.id.includes('prodi'))
                            {
                                if (list_up_prodi[element.id.split('-')[1]-1]) {
                                    if (element.classList.contains('text-center') && list_up_prodi[element.id.split('-')[1]-1]) {
                                        element.defaultValue = list_up_prodi[element.id.split('-')[1]-1];
                                        element.value = list_up_prodi[element.id.split('-')[1]-1];
                                    }
                                    else {
                                        if (!list_up_prodi_text[element.id.split('-')[1]-1]) { list_up_prodi_text[element.id.split('-')[1]-1] = element.value; }
                                        if (list_up_prodi_text[element.id.split('-')[1]-1]) { element.defaultValue = list_up_prodi_text[element.id.split('-')[1]-1]; }
                                    }
                                }
                                else { element.removeAttribute('value'); }
                            }
                            // console.log("after: ",element);
                        });
                    }
                })
            }
        }
        function form_addPenulis(form, list) {
            var next = document.createElement("div"); //membuat .form-sub, hierarki (M), baru di lokasi selanjut hierarki (M)
            var innerText
            
            // div.form-sub
                form.children[1].classList.forEach(classL => {
                    next.classList.add(classL);
                })
                // console.log(form_sub_list);

                form_sub_list.forEach((item, item_index) => { //add element based html only file
                    if (item_index == 0) {
                        item_text = "";
                        for (let i = 0; i < item.childElementCount; i++) {
                            if (!item.children[i].classList.contains("input")) {
                                if (item.children[i].querySelector('input')) {
                                    item.children[i].querySelector('input').removeAttribute('value');//remove value if exist
                                }
                                // console.log(i,item.children[i].querySelector('input')); //hierarki (0)
                                item_text += item.children[i].outerHTML; //add outerHTML of list
                            }
                        }
                        // console.log(item_text);
                        innerText = item_text;
                    }
                })
                // console.log(innerText);
                // console.log(next);
                innerText = replace_id_list(innerText, (form.childElementCount-1));
                form_addNewElement(form, list, next, innerText);

            // div.form-sub
        }
        if(drop_file_input) {
            
            drop_file_input.forEach(inputElement => {
                const dropZone = inputElement.closest(`.drop-file`);

                dropZone.addEventListener(`click`, (e) => {
                    inputElement.click();
                })

                dropZone.addEventListener("change", (e) => {
                    if (inputElement.files.length) {
                        dropDragFile(dropZone, inputElement.files[0])
                    }
                });

                dropZone.addEventListener(`dragover`, (e) => {
                    e.preventDefault();
                    dropZone.classList.add(`drop-file__hover`)
                })
                
                const drag = [`dragleave`, `dragend`]
                drag.forEach( type => {
                    dropZone.addEventListener(type, (e) => {
                        dropZone.classList.remove(`drop-file__hover`)
                    });
                })

                dropZone.addEventListener(`drop`, (e) => {
                    e.preventDefault();
                    if (e.dataTransfer.files.length) {
                        dropDragFile(dropZone, e.dataTransfer.files[0])
                    }
                    dropZone.classList.remove(`drop-file__hover`);
                    
                });
            })
        }
            function dropDragFile(zone, file) {
                var extension = file.name.split('.').pop();

                    var df_thumb = zone.querySelector(`.drop-file__prompt`);
                    
                    if (df_thumb) {
                        df_thumb.classList.add(`drop-file__thumb`);
                        df_thumb.classList.add(`row`);
                    }
                    else {
                        df_thumb = zone.querySelector(`.drop-file__thumb`);
                    }


                    if (extension.includes(`doc`) || extension.includes(`pdf`)) {
                        if (df_thumb) {
                            df_thumb.classList.remove(`drop-file__prompt`);
                            df_thumb.classList.remove(`flex-column`);
                        }

                        df_thumb.innerHTML = `
                        <div class="col-md-3 drop-file__thumb_img m-3">
                            <span>`+extension+`</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="50%" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16" style="color: white; border-color: white;">
                                <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" style="color: white;"></path>
                                <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" style="color: white;"></path>
                            </svg>
                        </div>
                        <div class="col-md-6 drop-file__thumb_teks d-flex flex-column p-3">
                            <p>`+ file.name +`</p>
                            <p class="link">Browser</p>
                        </div>`;
                        

                        if (extension.includes(`doc`)) {
                                df_thumb.children[0].style.backgroundColor = "#415663";
                        }
                        else {
                            df_thumb.children[0].style.backgroundColor = "#C64141";
                        }
                    }
                    else {
                        if (df_thumb.children[0].classList.contains(`drop-file__thumb_img`)) {
                            df_thumb.children[0].style.backgroundColor = "#0000008c";
                            df_thumb.children[1].children[0].innerHTML = `Drop File (PDF/Doc/Docx)`;
                        }
                        else {
                            df_thumb.children[0].innerHTML = `Drop File (PDF/Doc/Docx)`;
                        }
                    }
            }
        
        function submitEvent (form) {
            // console.log("SUBMIT THIS FORM: ",form.name);
            var formArray = [];
            if (form.querySelectorAll('input')) {
                form.querySelectorAll('input').forEach(elementInput => {
                    // console.log(elementInput, elementInput.value);
                    formArray[elementInput.id] = elementInput.value;
                });
            }
            // console.log(formArray);
            var firstKey = Object.keys(formArray)[0];
            var locationArray = [];
            locationArray['url'] = window.location.href+'?';
            locationArray['cookies'] = "";
            if (form.name == 'login') { locationArray['route'] = "{{route('login.store')}}"; }

            Object.entries(formArray).forEach(([key, value]) => {
                if (key != firstKey) { locationArray['url'] = locationArray['url'] + '&'; }
                locationArray['url'] = locationArray['url'] + key+'='+value;
                locationArray['cookies'] = locationArray['cookies'] + key+'='+value;
                if (key != (formArray.length - 1)) { locationArray['cookies'] = locationArray['cookies'] + ";"; }
            });

            // console.log(newLocation);
            // location.href = newLocation;
            checkTypeList();
            return locationArray;
        }
    //panel
        if (panel_switch && panel_switch.length != 0) {
            panelChange(panel_switch[0].querySelector(`#change`), panel_switch[1], document.querySelector('form').name);
        }
        function panelChange(PanelSwitch, PanelForm, changeTo) {
            panelWelcome = '';
            panelIsi = '';
            if (changeTo == 'login') {
                // document.querySelector('form').action = window.location.href.replace('signup','login');
                panel_switch[0].classList.remove("second");
                panelWelcome += `
                                <div>
                                    <div class="form-title">
                                        <p>Selamat Datang!</p>
                                    </div>
                                    <div class="form-subtitle">
                                        <p>Belum memiliki akun Rumah Jurnal?</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="`+window.location.href.replace('login','signup')+`" class="btn change-btn w-100">
                                        <p>Sign Up</p>
                                    </a>
                                </div>`;

                panelIsi += `
                            <div class="form-title">
                                <p>Sign In to Rumah Jurnal</p>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                    <input type="text" name="username" id="username" placeholder="Username" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    <input type="password" name="pass" id="pass" placeholder="Password" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <button type="submit" class="btn log-btn w-100">
                                    <p>Sign In</p>
                                </button>
                                <div class="form-subtitle">
                                    <p>Atau Sign In Menggunakan</p>
                                </div>
                                <button type="button" class="btn log-btn-border d-flex justify-content-between align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google logo" viewBox="0 0 16 16">
                                        <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"></path>
                                    </svg>
                                    <p class="flex-grow-1">Google</p>
                                </button>
                            </div>`;
            }
            else {
                // document.querySelector('form').action = window.location.href.replace('login','signup');
                panel_switch[0].classList.add("second");
                panelWelcome += `
                                <div>
                                    <div class="form-title">
                                        <p>Hallo!</p>
                                    </div>
                                    <div class="form-subtitle">
                                        <p>Sudah memiliki akun Rumah Jurnal?</p>
                                    </div>
                                </div>
                                <div>
                                    <a href="`+window.location.href.replace('signup','login')+`" class="btn change-btn w-100">
                                        <p>Sign In</p>
                                    </a>
                                </div>`;
                panelIsi += `
                            <div class="form-title">
                                <p>Sign Up to Rumah Jurnal</p>
                            </div>
                            <div class="d-flex flex-column">
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                    <input type="text" name="username" id="username" placeholder="Username" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-open me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882l-6-3.2ZM15 7.383l-4.778 2.867L15 13.117V7.383Zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765l6-3.2Z"/>
                                    </svg>
                                    <input type="text" name="email" id="email" placeholder="Email" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                    </svg>
                                    <input type="password" name="pass" id="pass" placeholder="Password" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                                <div class="searchbar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-key-fill me-1 ms-3" viewBox="0 0 16 16">
                                        <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                    </svg>
                                    <input type="password" name="passS" id="passS" placeholder="Re Enter Password" class="px-0 w-75 me-3 ms-1" value="" autocomplete="off">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <button type="submit" class="btn log-btn w-100">
                                    <p>Sign In</p>
                                </button>
                                <div class="form-subtitle">
                                    <p>Atau Sign In Menggunakan</p>
                                </div>
                                <button type="button" class="btn log-btn-border d-flex justify-content-between align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google logo" viewBox="0 0 16 16">
                                        <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"></path>
                                    </svg>
                                    <p class="flex-grow-1">Google</p>
                                </button>
                            </div>`
            }
            PanelSwitch.innerHTML = panelWelcome;
            PanelForm.innerHTML = panelIsi;
        }

function suggestionBar(input_box, dd, parent_id, selectValue) {
    // console.log("input_box (suggestionBar())",input_box, "dd",dd, "parent_id",parent_id, selectValue);
    
    if (!input_box.hasAttribute('autocomplete')) {
        input_box.setAttribute('autocomplete', 'off');
    }
    let suggestions;
    let firstSuggestions;
    var baru = false;

    for (let i = 1; i <= 3; i++) {
        // console.log(parent_id, parent_id.includes(`-`+i),(`-`+i));
        if (parent_id.includes("pnl")) {
            if (parent_id.includes(`-`+i)) {
                firstSuggestions = "Masukan Nama Penulis Baru";
                baru = true;
            }
            else if (!baru){
                firstSuggestions = ">--Pilih Penulis--<";
            }
            suggestions = [firstSuggestions].concat(list_penulis);
        }
        else if (parent_id.includes("prodi")) {
            if (parent_id.includes(`-`+i)) {
                firstSuggestions = "Masukan Program Studi Baru";
                baru = true;
            }
            else if (!baru){
                firstSuggestions = ">--Pilih Prodi--<";
            }
            suggestions = [firstSuggestions].concat(list_prodi);
        }
        else if ((parent_id.includes("jdl")) && i == 1) {
            firstSuggestions = ">--Pilih Semua--<";
            suggestions = [firstSuggestions].concat(list_judul);
        }
        else if ((parent_id.includes("search")) && i == 1) {
            suggestions = [].concat(final_search);
        }
        else if ((parent_id.includes("kota")) && i == 1) {
            firstSuggestions = ">--Pilih Kota--<";
            suggestions = [firstSuggestions].concat(list_kota);
        }
        else if ((parent_id.includes("prov")) && i == 1) {
            firstSuggestions = ">--Pilih Provinsi--<";
            suggestions = [firstSuggestions].concat(list_prov);
        }
    }
    var parent = dd.parentNode;
    var dd = parent.querySelector(`.search-value`);
    var space = parent.querySelector(`.search-break`);
    // console.log(suggestions);

    showSuggestions([],parent_id, selectValue); //rewrite first
    
    // if user press any key and release
    input_box.onkeyup = (e)=>{
        let userData = e.target.value; //user enetered data
        let emptyArray = [];
        if(userData){
            if (parent_id == "jdl-search") { dd.classList.add("show"); }
            // console.log("==============================================");
            // console.log("emptyArray: ",emptyArray);
            emptyArray = suggestions.filter((data)=>{
                if (parent_id =="search") {
                    let stringData = "";
                    data.filter((dataList) => { stringData = stringData + " || " + dataList; })
                    return stringData.toLocaleLowerCase().includes(userData.toLocaleLowerCase());
                }
                else { return data.toLocaleLowerCase().includes(userData.toLocaleLowerCase()); }
            });
            // console.log("userData: ",userData);
            // console.log("emptyArray: ",emptyArray);
            emptyArray = emptyArray.map((data, dataIndex)=>{
                if (parent_id =="search") {
                    let containData = false;
                    let sudahDitambah = false;
                    let stringData = "";
                    data.filter((dataList,index,array) => {
                        if (dataList.toLocaleLowerCase().includes(userData.toLocaleLowerCase())) {
                            containData = true;
                        }
                        if (containData && !sudahDitambah) {
                            stringData = input_list(dataIndex, array[0], array[1], array[2], array[3],'','','', "search");
                            sudahDitambah = true;
                        }
                    })
                    return stringData;
                }
                else {
                    if (data.toLocaleLowerCase().includes(userData.toLocaleLowerCase())) {
                        return data = '<li>'+ data +'</li>';
                    }
                }
            });
            showSuggestions(emptyArray,parent_id, selectValue);
        }
        else{
            if (parent_id.includes("jdl")) {
                dd.classList.remove("show");
                // if (space) { space.classList.add("col-3"); }
            }
            showSuggestions(emptyArray,parent_id, selectValue);
        }
    }
    function showSuggestions(list, parent_id, selectValue){
        let listData;
        let parent = document.getElementById(parent_id);
        // console.log(parent,list);

        var loc_list = parent.querySelector('.drop-select .select-droped');
        // console.log("selectValue: ",selectValue, " || ",loc_list);

        if (!loc_list) {
            var select_parent = document.getElementById(parent_id).parentNode;
            loc_list = select_parent.querySelector('.drop-select .select-droped');
            if (parent_id =="search") {
                loc_list = headSearchDd;
            }
        }
        if(!list.length){
            // console.log(list.length);
            userValue = input_box.value;
            let searchHead = ``;
            if (!userValue || userValue.includes(" ") 
                || parent_id == 'kota' || parent_id == 'prov' 
                || (parent_id == 'prodi' && lokasi.includes('profile'))) {
                listData = "";
                // console.log(userValue);
                for (let i = 0; i < suggestions.length; i++) {
                    if (selectValue) {
                        // console.log(suggestions[i],selectValue,suggestions[i].toLocaleLowerCase() == selectValue.toLocaleLowerCase());
                        if (suggestions[i].toLocaleLowerCase() == selectValue.toLocaleLowerCase()) {
                            listData += `<li class="active">`+(suggestions[i])+`</li>`
                        }
                        else if ((suggestions[i].includes("Prodi")) && (selectValue == ">--Pilih Program Studi--<") && (i == 0)) {
                            listData += `<li class="active">`+(suggestions[i])+`</li>`
                        }
                        else {
                            listData += `<li>`+(suggestions[i])+`</li>`
                        }
                    }
                    else {
                        if (parent_id =="search") {
                            listData = `<li class="d-flex m-3 border-bottom rounded-1 line-2 p-2 justify-content-center">
                                            <p>Apa yang Anda Cari?</p>
                                        </li>`
                        }
                        else { listData += `<li>`+(suggestions[i])+`</li>`; }
                    }
                }
            }
            else{
                if (parent_id =="search") {
                    listData = `<li class="d-flex m-3 border-bottom rounded-1 bg-red-1 p-2 justify-content-center">
                                    <b>Nothing Found</b>
                                </li>`;
                }
                else { listData = `<li class="text-center">`+(firstSuggestions)+`</li>
                                    <li class="text-center bg-red-1"><b>Nothing Found</b></li>`; }
            }
        }else {
            listData = list.join('');
        }
        // console.log(loc_list, listData);
        loc_list.innerHTML = listData;
    }
}

//prodi
    //color per prodi
    var pos;
    let normal = 65;
    var prodi_color = [];
    list_prodi.forEach(prodi => {
        pos = Math.floor(Math.random() * (3 - 1 + 1) + 1);
        if (pos != 1) { r = (Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
        else { r = (normal.toString(16) ) }
        if (pos != 2) { g = (Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
        else { g = (normal.toString(16) ) }
        if (pos != 3) { b = (Math.floor(Math.random() * (255 - 102 + 1) + 102).toString(16)); }
        else { b = (normal.toString(16) ) }

        if (prodi == '[ N/a ]') { prodi_color.push({ "nama_prodi": prodi, "warna": '343a40'}); }
        else { prodi_color.push({ "nama_prodi": prodi, "warna": r+g+b}); }
    });
    
    function ProdiList(items) {
        if (document.getElementsByClassName("filter-prodi")) {
            prodi_select_list = items;
            let result = '';
            let result_form = '';
            let sisa = 0;
            let show = 0;
            let index = 0;
            if (items[0] == ">--Pilih Semua--<") { index = 1; }
            prodi_color.forEach(prodi => {
                if ((show <= 11) && (items.includes(prodi['nama_prodi']))) {
                    result += `<div class="prodi-box" style="background-color: #`+prodi['warna']+`;">`+prodi['nama_prodi']+`</div>`;
                    show += 1;
                }
                else if (show > 11) { sisa += 1; }
                
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
                result_form += `<article style="border-color: #`+prodi['warna']+`;">
                <input type="checkbox" name="prodi">
                <div><span>`+prodi['nama_prodi']+`</span></div></article>`;
            });
            
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
        for (let i = 0; i < prodi_color.length; i++) {
            var check_prodi = check_prodi_list.children[i].querySelector('input');
            console.log(check_prodi_list.children[i].querySelector('input'));
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
    if (lokasi.slice(-1) == "/" || lokasi.includes("dashboard")) { lokasi = "index"; }
    if (lokasi.includes("index")) { ProdiList(list_prodi); }
    else { checkTypeList(); }
}
start();