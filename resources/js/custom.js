// Body event delegation - any form (least efficient)

/*
document.body.addEventListener('keydown', function(e) {
    if(!(e.keyCode === 13 && e.metaKey)) return;

    const target = e.target;
    if(target.form) {
        target.form.submit();
    }
});
*/
