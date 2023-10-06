function showCustomMessage(title, message, type) {
    swal(title, message, type);
}

function showMenuSelected(mainMenuId, menuItemId) {
    
    $(mainMenuId).addClass("active");
    $(menuItemId).addClass("active");
}