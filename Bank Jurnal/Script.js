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
var upload_select = document.querySelectorAll(`.select-btn>div:first-child`);
var upload_input = document.querySelectorAll(`.form_sub.row.box div:not([class]):not([id]) textarea`);
var upload_penulis = document.querySelector(`#profile.form_sub.row`);
var panel_switch = document.querySelectorAll(`form.row .panel`);
var drop_file_input = document.querySelectorAll(`.drop-file__input`);


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
    


console.log(form_page);
console.log(form_sub_list);
console.log(form_sub_list_search);

//function
//mouse clicked
    window.addEventListener('mouseup', function(event){
        // console.log(event.target);
        //general
            headBtn.forEach((btn,index) => {
                if (btn.contains(event.target)) {
                    // console.log(dropdown,dropdown[index-2]);
                    if (btn.nextElementSibling) {
                        if (dropdown[index-2].style.display === "none") { dropdown[index-2].style.display = "block"; }
                        else { dropdown[index-2].style.display = "none"; }
                    }
                    else if (btn.id == taskbarBtnId.id) {
                        if (taskbar.style.display === "none") { taskbar.style.display = "block"; shade_show("show"); }
                        else { taskbar.style.display = "none"; shade_show("remove");}
                    }
                    else if (btn.id.includes("search")) {
                        console.log("modal open");
                        form_function(document.querySelector(`.head-modal`));
                    }
                }
                else {
                    if (btn.nextElementSibling) {
                        if (dropdown[index-2].style.display === "block") {
                            if (!btn.parentNode.contains(event.target)) { dropdown[index-2].style.display = "none"; }
                        }
                    }
                    else if (event.target == taskbar) {
                        if (taskbar.style.display === "block") { taskbar.style.display = "none"; shade_show("remove"); }
                    }
                    else if (event.target == document.querySelector(`#form_search`)) {
                        form_function(document.querySelector(`.head-modal`));
                    }
                }
            });

        //tabel or Slide List
            if (tabel_select) {
                tabel_select.forEach((select,index) => {
                    // console.log("select", select, "select.querySelector", select.querySelector(`.drop-select`));
                    var dropSelect = select.querySelector(`.drop-select`);
                    var selectValue = select.querySelector(`.search-value`);
                    if (dropSelect) {
                        var selectMenu = dropSelect.querySelectorAll(`div ul li`);
                        selectMenu.forEach(i => {
                            // console.log(i);
                        })
                    }
                    var selectValue, inputValue;

                    if (select.contains(event.target)) {
                        // console.log(select,event.target, select.id,selectValue);
                        if (!select.id.includes("jdl")) {
                            if (dropSelect) {
                                selectValue.classList.add("show");
                            }
                        }
                        if (select.querySelector(`.search-value input`)) {
                            inputValue = select.querySelector('.search-value input');
                            selectValue = select.querySelector('.search-value input');
                        }
                        else {
                            inputValue = select.querySelector('.select-search input');
                        }

                        selectMenu.forEach((menu, index) => {
                            if (event.target == menu) {
                                if (dropSelect.querySelector(`ul li.active`)) {
                                    dropSelect.querySelector(`ul li.active`).classList.remove("active");
                                }
                                menu.classList.add("active");
                                // console.log(menu,menu.classList);
                                if (!select.id.includes("final")) {
                                    inputValue.value = menu.textContent;
                                }
                                selectValue.innerHTML = menu.textContent;
                                checkTypeList();
                                
                        
                                selectValue.classList.remove("show");
                            }
                        });
                        if (!select.id.includes("final")) {
                            // console.log(inputValue.value, dropSelect, select.id, selectValue.innerText);
                            suggestionBar(inputValue, dropSelect, select.id, selectValue.textContent);
                        }
                    }
                    else {
                        if (dropSelect) {
                            selectValue.classList.remove("show");
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
                            form_inside(form_wrapper,tr.getAttribute('data-id'));
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
                                        form_inside(form_wrapper,tr.getAttribute('data-id'));
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
            // form
                // if (upload_select) {
                //     upload_select.forEach((item )=> {
                //         var parent = item.parentNode;
                //         var dd = parent.querySelector(`.drop-select`);
                //         var selectParent = parent.parentNode;
                //         var next_input = selectParent.nextElementSibling;
                //         var listRow = selectParent.parentNode;
                //         // console.log(item, parent, selectParent, next_input, listRow);
                //         if (parent.contains(event.target)) {
                //             if (dd) {
                //                 dd.classList.add(`ddShow`);
                //                 var inputValue = dd.querySelector('.se-se-bar .select-search input');
                //                 var selectMenu = dd.querySelectorAll(`div ul li`);
                //                 // console.log(item.textContent);
                //                 suggestionBar(inputValue, dd, item.id, item.textContent);
                                
                //                 selectMenu.forEach((menu) => {
                //                     if (event.target == menu) {
                //                         if (dd.querySelector(`ul li.active`)) {
                //                             dd.querySelector(`ul li.active`).classList.remove("active");
                //                         }
                //                         menu.classList.add("active");
                //                         // console.log(event.target,menu);
                //                         item.innerHTML = menu.textContent;
                //                         item.value = menu.textContent;
                                        
                //                         var child_break = document.createElement("div");
                //                         child_break.classList.add("break");
                //                         var child = document.createElement("div");
                //                         var input;
                //                         if (item.innerHTML.includes("Baru")) {
                //                             // console.log(item.innerHTML);
                //                             if (item.id.includes("pnl")) {
                //                                 listRow.insertBefore(child_break, next_input);
                //                                 listRow.insertBefore(child, next_input);
                //                                 input = `<textarea id="pnl-`+item.id.charAt(item.id.length-1)+`" rows="1" class="searchbar" placeholder="[Nama Penulis]"></textarea>`;
                //                             }
                //                             else {
                //                                 listRow.appendChild(child_break);
                //                                 listRow.appendChild(child);
                //                                 input = `<textarea id="prodi-`+item.id.charAt(item.id.length-1)+`" rows="1" class="searchbar" placeholder="[Nama Prodi]"></textarea>`;
                //                             }
                                            
                //                             child.innerHTML = input;
                //                         }
                //                         else {
                //                             selectParent.nextElementSibling.remove();//remove break div
                //                             selectParent.nextElementSibling.remove();//remove textarea div
                //                         }
                //                         dd.classList.remove("ddShow");
                //                     }
                //                 });
                //             }
                //         }
                //         else {
                //             if (dd) {
                //                 if (!dd.contains(event.target)) {
                //                     dd.classList.remove("ddShow");
                //                 }
                //             }
                //         }
                //     });
                // }
                
                if (form_page) {
                    form_page.forEach((form, form_index, form_array) => {
                        // console.log(form);
                        var form_list = form.querySelectorAll(`.form-sub`);
                        if (form_list) {
                            form_list.forEach(list => {
                                // console.log(form.id,list);
                                var searchbar = list.querySelectorAll(`.search-value`);
                                var search_value = list.querySelectorAll(`.searchbar input`);
                                searchbar.forEach(search => {
                                    // console.log(event.target,search.parentNode,search.parentNode.contains(event.target));
                                    if (search.parentNode.contains(event.target)) {
                                        var search_parent = search.parentNode;
                                        var search_dd = search_parent.querySelector(`.search-dd`);
                                        var search_input = search.querySelector(`input`);
                                        var search_dd_menu = search_dd.querySelectorAll(`div ul li`);

                                        form_searchbar(event.target, search_parent, search, search_input, search_dd, search_dd_menu);
                                        
                                        // console.log(search_input.value);
                                        if (!search.classList.contains("show")) {
                                            // console.log(search_parent.parentNode,search_parent.parentNode.nextElementSibling);
                                            var parent = search_parent.parentNode;
                                            var loc_next = parent.nextElementSibling;
                                            if (search_input.value.includes("Baru")) {
                                                // console.log(!loc_next || loc_next.classList.contains("select"));
                                                if (!loc_next || loc_next.classList.contains("select")) {
                                                    var next = document.createElement("div");
    
                                                search_parent.parentNode.classList.forEach(classL => {
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
                                                    inner += `placeholder="[Nama Penulis]">
                                                                </div>
                                                            </div>`
                                                }
                                                else if (search_parent.id.includes("prodi")) {
                                                    inner += `placeholder="[Program Studi]">
                                                                </div>
                                                            </div>`
                                                }
    
                                                form_addNewElement(parent.parentNode, loc_next, next, inner);
                                                }
                                            }
                                            else if (!search_input.value.includes("Baru")) {
                                                console.log(document.getElementById("text-"+search_parent.id));
                                                document.getElementById("text-"+search_parent.id).remove();
                                            }
                                        }

                                    }
                                    else { search.classList.remove(`show`); }
                                })
                                
                                var listBtn = list.querySelectorAll(`button`);
                                listBtn.forEach(btn => {
                                    if (btn.contains(event.target)) {
                                        // console.log(btn.classList);
                                        // console.log(list);
                                        // console.log(form,form.childElementCount,form.children);
                                        if (list.classList.contains("addBox")) {
                                            if (form.childElementCount <= 6) {
                                                var next = document.createElement("div");
                                                var innerText
                                                form.children[1].classList.forEach(classL => {
                                                    next.classList.add(classL);
                                                })
                                                // console.log(form_sub_list,form_index);
                                                form_sub_list.forEach((item, item_index) => {
                                                    if (item_index == 0) {
                                                        item_text = "";
                                                        for (let i = 0; i < item.childElementCount; i++) {
                                                            if (!item.children[i].classList.contains("input")) {
                                                                item_text += item.children[i].outerHTML; //add outerHTML of list
                                                            }
                                                        }
                                                        // console.log(item_text);
                                                        innerText = item_text;
                                                    }
                                                })
                                                // console.log(innerText);
                                                innerText = replace_id_list(innerText, (form.childElementCount-1));
                                                form_addNewElement(form, list, next, innerText);
                                                if (form.childElementCount == 6) {
                                                    btn.parentNode.style.display = "none";
                                                }
                                            }
                                        }
                                        else if (btn.classList.contains("cancel-btn")) {
                                            // console.log("Cancel Penulis");
                                            if (form.childElementCount > 3) { list.remove(); }
                                            if (form.childElementCount < 6) {
                                                form.children[form.childElementCount-1].style.display = null;
                                            }
                                        }

                                        // console.log("List Rechange Name n ID");
                                        for (let i = 1; i < form.childElementCount-1; i++) {
                                            // console.log(form.childElementCount,i,form.children[i]);
                                            changeText = replace_id_list(form.children[i].outerHTML, i);
                                            // console.log(changeText);
                                            form.children[i].outerHTML = changeText;
                                        }
                                    }
                                })
                                
                            })
                        }
                    })
                }
            // form-modal
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
                    // console.log(form_wrapper);
                    var open_form_btn = document.querySelector(`.filter-btn`);

                    if (open_form_btn && open_form_btn.contains(event.target)) {
                        form_function(form_wrapper);
                    }
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
            //login form
                if (panel_switch) {
                    var change_btn = document.querySelector(`.change-btn`);
                    var panelWelcome = '';
                    var panelIsi = '';
                    if (change_btn) {
                        if (change_btn.contains(event.target)) {
                            if (panel_switch[0].classList.contains("second")) {
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
                                                    <button type="button" class="btn change-btn w-100">
                                                        <p>Sign Up</p>
                                                    </button>
                                                </div>`;
    
                                panelIsi += `
                                            <div class="form-title">
                                                <p>Sign In to Rumah Jurnal</p>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="searchbar">
                                                    <input type="text" name="email" id="email" placeholder="Email" class="w-100">
                                                </div>
                                                <div class="searchbar">
                                                    <input type="password" name="pass" id="pass" placeholder="Password" class="w-100">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <button type="button" class="btn log-btn w-100">
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
                            else {
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
                                                    <button type="button" class="btn change-btn w-100">
                                                        <p>Sign In</p>
                                                    </button>
                                                </div>`;
    
                                
                                panelIsi += `
                                            <div class="form-title">
                                                <p>Sign Up to Rumah Jurnal</p>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="searchbar">
                                                    <input type="text" name="username" id="user" placeholder="Username" class="w-100">
                                                </div>
                                                <div class="searchbar">
                                                    <input type="text" name="email" id="email" placeholder="Email" class="w-100">
                                                </div>
                                                <div class="searchbar">
                                                    <input type="password" name="pass" id="pass" placeholder="Password" class="w-100">
                                                </div>
                                                <div class="searchbar">
                                                    <input type="password" name="passS" id="passS" placeholder="Re Enter Password" class="w-100">
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <button type="button" class="btn log-btn w-100">
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
                            panel_switch[0].querySelector(`#change`).innerHTML = panelWelcome;
                            panel_switch[1].innerHTML = panelIsi;
                        }
                    }
                }
            // add form
                // var addBtn = document.querySelector(`.add-btn`);
                // if (addBtn) {
                //     if (addBtn.contains(event.target)) {
                //         var prevAdd = document.querySelector(`.addBox`).previousElementSibling;
                //         var no
                //         for (let i = 0; i <= 3; i++) {
                //             if (prevAdd.id.includes(i)) {
                //                 no = i+1
                //             }
                //         }
                //         console.log(no,prevAdd.id,document.querySelector(`.addBox`));
                //         if (no <= 4) {
                //             var newAuthor = `
                //                         <div class="form_sub_list">Nama Penulis `+no+`</div>
                //                         <div class="searchbar search-penulis selectbar se-selectbar">
                //                             <div class="select-btn">
                //                                 <div id="pnl-`+no+`">>--Pilih Penulis--<
                //                                 </div>
                //                                 <div class="drop-select">
                //                                     <div class="se-se-bar" id="dropdown-pnl">
                //                                         <div class="select-search searchbar">
                //                                             <input type="text" name="s-se-pnl" id="s-se-pnl" placeholder="Penulis">
                //                                         </div>
                //                                         <ul class="select-droped">
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                         </ul>
                //                                     </div>
                //                                 </div>
                //                             </div>
                //                         </div>
                //                         <div class="form_sub_list">Program Studi `+no+`</div>
                //                         <div class="searchbar search-prodi selectbar se-selectbar">
                //                             <div class="select-btn">
                //                                 <div id="prodi-`+no+`">>--Pilih Program Studi--<</div>
                //                                 <div class="drop-select">
                //                                     <div class="se-se-bar" id="dropdown-prodi">
                //                                         <div class="select-search searchbar">
                //                                             <input type="text" name="s-se-pnl" id="s-se-pnl" placeholder="Penulis">
                //                                         </div>
                //                                         <ul class="select-droped">
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                             <li>poin</li>
                //                                         </ul>
                //                                     </div>
                //                                 </div>
                //                             </div>
                //                         </div>
                //                         `;


                //             var child = document.createElement("div");
                //             child.classList.add("form_sub");
                //             child.classList.add("row");
                //             child.classList.add("box");
                //             child.setAttribute(`id`,`pnl_`+no)
                //             prevAdd.parentNode.insertBefore(child, prevAdd.nextElementSibling);
                //             child.innerHTML = newAuthor;
                //             console.log(prevAdd.parentNode);
                //             upload_select = document.querySelectorAll(`.select-btn>div:first-child`);
                //             upload_input = document.querySelectorAll(`.form_sub.row.box div:not([class]):not([id]) textarea`);
                //             upload_penulis = document.querySelector(`#profile.form_sub.row`);
                //             if (no == 4) {
                //                 addBtn.parentNode.innerHTML = ``;
                //             }
                //         }
                //     }
                // }
                

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
    function replace_id_list(text, id) {
        for (let i = 1; i <= 100; i++) {
            if (text.includes("Penulis")) {
                text = text.replace(`Penulis `+i, `Penulis `+(id));
                text = text.replace(`pnl-`+i, `pnl-`+(id));
                text = text.replace(`pnl_`+i, `pnl_`+(id));
                // console.log(text);
            }
            if (text.includes("Penulis")) {
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
            first_column = `<div class="profile-box d-flex flex-wrap justify-content-around align-items-center col-md-3 m-2 mx-3">
                            <img src="" alt="profile-image">
                            <p id="profile-name">`+ pnl +`</p>
                        </div>`;
        }
        
        
        return first_column + last_column;
    }
    function RenderFinal(type) {
        var render_item = [].concat(final_list);
        var judul_search, final_select, pnl_select, prodi_select = '';
        tabel_select.forEach(item => {
            // console.log(item,item.id,item.querySelector('.search-value').textContent);
            // console.log(item,item.querySelector('.search-value'),item.querySelector('.search-value').innerText);
            
            if (item.id.includes("jdl")) { judul_search = item.querySelector('.search-value input').value }
            if (item.id.includes("final")) { final_select = item.querySelector('.search-value').innerText; }
            if (item.id.includes("pnl")) { pnl_select = item.querySelector('.search-value').innerText; }
            if (item.id.includes("prodi")) { prodi_select = item.querySelector('.search-value').innerText; }
        });
        
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
        else if (lokasi.includes("upload")) {
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
    }
    //form
        function form_searchbar(value_select, search_wrapper, value_wrapper, input_wrapper, dd_wrapper, dd_menu) {
            // console.log(value_select, search_wrapper, value_wrapper, input_wrapper, dd_wrapper);
            var dd_menu_active = dd_wrapper.querySelector(`div ul li.active`);
            if (value_wrapper.classList.contains("show")) {
                dd_menu.forEach(menu => {
                    if (value_select == menu) {
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
                suggestionBar(input_wrapper, dd_wrapper, input_wrapper.id, input_wrapper.textContent);
            }
        }
        function form_addNewElement(main_wrapper, Next, New, InnerNew) {
            // console.log("main_wrapper",main_wrapper, "Next",Next, "New",New, "InnerNew",InnerNew);
            if (Next) { main_wrapper.insertBefore(New, Next); }
            else { main_wrapper.appendChild(New); }
            New.innerHTML = InnerNew;
        }
        function form_function(modal) {
            // console.log(modal);
            if (modal.style.display === "none") {
                modal.style.display = null;
                modal.classList.add("show");
                shade_show("show");
                overflow_body("hidden");
            }
            else {
                modal.style.display = "none";
                modal.classList.remove("show");
                shade_show("remove");
                overflow_body("auto");
            }
        }
        function form_inside(wrapper,id) {
            form_function(wrapper);
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
                    dropZone.classList.remove(`drop-file__hover`)
                });
            })
        }
            function dropDragFile(zone, file) {
                var extension = file.name.split('.').pop();
                    // console.log(extension);

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

var form = document.querySelector('#jdl-search form');
if (form) {
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        checkTypeList();
    });
}
function suggestionBar(input_box, dd, parent_id, selectValue) {
    // console.log("input_box (suggestionBar())",input_box, "dd",dd, "parent_id",parent_id, selectValue);
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
    }
    var parent = dd.parentNode;
    var dd = parent.querySelector(`.search-value`);
    var space = parent.querySelector(`.search-break`);
    // console.log(dd);

    showSuggestions([],parent_id, selectValue); //rewrite first
    
    // if user press any key and release
    input_box.onkeyup = (e)=>{
        let userData = e.target.value; //user enetered data
        let emptyArray = [];
        if(userData){
            dd.classList.add("show");
            if (space) { space.classList.remove("col-3"); }
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
            showSuggestions(emptyArray,parent_id, selectValue);
        }
        else{
            if (parent_id.includes("jdl")) {
                dd.classList.remove("show");
                if (space) { space.classList.add("col-3"); }
            }
            showSuggestions(emptyArray,parent_id, selectValue);
        }
    }
    function showSuggestions(list, parent_id, selectValue){
        let listData;
        let parent = document.getElementById(parent_id);
        // console.log(parent);
        var loc_list = parent.querySelector('.drop-select .select-droped');
        // console.log(parent,loc_list);
        if (!loc_list) {
            var select_parent = document.getElementById(parent_id).parentNode;
            loc_list = select_parent.querySelector('.drop-select .select-droped');
        }
        if(!list.length){
            userValue = input_box.value;
            if (!userValue || userValue.includes(" ")) {
                listData = "";
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
        // console.log(loc_list);
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
            if (items[0] == ">--Pilih Semua--<") { index = 1; }
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
