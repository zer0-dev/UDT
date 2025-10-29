function filter_table(status){
    hide_all();
    document.querySelectorAll('tr[data-status='+status+']').forEach((e) => {
        show(e);
    });
}

function hide_all(){
    document.querySelectorAll('tr[data-status]').forEach((e) => {
        hide(e);
    });
}

function show_all(){
    document.querySelectorAll('tr[data-status]').forEach((e) => {
        show(e);
    });
}

function hide(item){
    item.setAttribute("style", "display: none;");
}

function show(item){
    item.removeAttribute("style");
}