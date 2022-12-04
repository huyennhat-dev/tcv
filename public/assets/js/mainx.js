function search_btn() {
    const $ = document.getElementById.bind(document);

    $('search_icon_x').classList.toggle('ti-close')
    $('header_search').classList.toggle('click')
    $('cl1').classList.toggle('close')

}

function menu_btn() {
    const $ = document.getElementById.bind(document);

    $('menu-mobile').classList.add('modal-menu-mobile--active')
    $('cl1').classList.add('d-none')
    $('panel_btn').classList.add('d-none')
}

function panel_btn() {
    const $ = document.getElementById.bind(document);

    $('panel-mobile').classList.add('modal-panel-mobile--active')
    $('cl1').classList.add('d-none')
    $('menu_btn').classList.add('d-none')
}

function close_menu_btn() {
    const $ = document.getElementById.bind(document);

    $('menu-mobile').classList.remove('modal-menu-mobile--active')
    $('cl1').classList.remove('d-none')
    $('panel_btn').classList.remove('d-none')
}

function close_panel_btn() {
    const $ = document.getElementById.bind(document);

    $('panel-mobile').classList.remove('modal-panel-mobile--active')
    $('cl1').classList.remove('d-none')
    $('menu_btn').classList.remove('d-none')
}

function ti_plus1() {
    const $ = document.getElementById.bind(document);

    $('ti_plus').classList.toggle('ti-angle-up')
    $('category_1').classList.toggle('d-block')

}

function ti_plus2() {
    const $ = document.getElementById.bind(document);

    $('ti_plus2').classList.toggle('ti-angle-up')
    $('tbl_rank').classList.toggle('d-block')

}

function ti_plus3() {
    const $ = document.getElementById.bind(document);

    $('ti_plus3').classList.toggle('ti-angle-up')
    $('profile').classList.toggle('d-block')

}

function ti_panel_1() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_1').classList.toggle('ti-angle-up')
    $('ti_panel_1_1').classList.toggle('d-block')
}

function ti_panel_2() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_2').classList.toggle('ti-angle-up')
    $('ti_panel_2_1').classList.toggle('d-block')
}

function ti_panel_3() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_3').classList.toggle('ti-angle-up')
    $('ti_panel_3_1').classList.toggle('d-block')
}

function ti_panel_4() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_4').classList.toggle('ti-angle-up')
    $('ti_panel_4_1').classList.toggle('d-block')
}

function ti_panel_5() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_5').classList.toggle('ti-angle-up')
    $('ti_panel_5_1').classList.toggle('d-block')
}

function ti_panel_6() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_6').classList.toggle('ti-angle-up')
    $('ti_panel_6_1').classList.toggle('d-block')
}

function ti_panel_7() {
    const $ = document.getElementById.bind(document);

    $('ti_panel_7').classList.toggle('ti-angle-up')
    $('ti_panel_7_1').classList.toggle('d-block')
}

function rep_comment() {
    const $ = document.getElementById.bind(document);

    $('rep_cmt-list').classList.add('active')
}

function remove_commet() {
    const $ = document.getElementById.bind(document);

    $('rep_cmt-list').classList.remove('active')
}

function list_chap() {
    const $ = document.getElementById.bind(document);

    $('list_chap').classList.toggle('active')
    $('ti_menu_chap').classList.toggle('ti-close')
    $('close_menu-chap').classList.toggle('active')
}

function rank_table() {
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const tabs = $$(".tab-item");
    const panes = $$(".tab-pane");

    const tabActive = $(".tab-item.active");
    const line = $(".tabs .line");

    line.style.left = tabActive.offsetLeft + "px";
    line.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab, index) => {
        const pane = panes[index];

        tab.onclick = function() {
            $(".tab-item.active").classList.remove("active");
            $(".tab-pane.active").classList.remove("active");

            line.style.left = this.offsetLeft + "px";
            line.style.width = this.offsetWidth + "px";

            this.classList.add("active");
            pane.classList.add("active");
        };
    });
}

rank_table();