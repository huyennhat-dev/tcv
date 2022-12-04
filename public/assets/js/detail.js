function detail() {
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const tabs = $$(".detail_tabs-items");
    const panes = $$(".detail_tabs-panes");

    const tabActive = $(".detail_tabs-items.active");
    const lines = $(".detail_tabss .detail_lines");

    lines.style.left = tabActive.offsetLeft + "px";
    lines.style.width = tabActive.offsetWidth + "px";

    tabs.forEach((tab, index) => {
        const panez = panes[index];

        tab.onclick = function() {
            $(".detail_tabs-items.active").classList.remove("active");
            $(".detail_tabs-panes.active").classList.remove("active");

            lines.style.left = this.offsetLeft + "px";
            lines.style.width = this.offsetWidth + "px";

            this.classList.add("active");
            panez.classList.add("active");
        };
    });
}

function comments() {
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const rep_cmt = $$(".rep_comment");
    const cmt_list = $$(".rep-cmt-list");
    const remove_cmt = $$(".remove_commet");
    const tabActive = $(".rep_comment.active");

    rep_cmt.forEach((tab, index) => {
        const pane = cmt_list[index];

        tab.onclick = function() {

            this.classList.add("active");
            pane.classList.add("active");
        };
    });
    remove_cmt.forEach((tab, index) => {
        const pane = cmt_list[index];
        const repcmt_index = rep_cmt[index];
        tab.onclick = function() {

            this.classList.remove("active");
            pane.classList.remove("active");
            repcmt_index.classList.remove("active");
        };
    });
}
comments()
detail();