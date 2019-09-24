$( '.navbar .navbar-nav a' ).on( 'click', function () {
	$( '.navbar .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
	$( this ).parent( 'li' ).addClass( 'active' );
});


function printdiv()
{
    var newstr=document.getElementById("printpage").innerHTML;
    var popupWin = window.open('', '_blank','width=1100,height=600');//
    popupWin.document.open();
    popupWin.document.write('<html> <body style="padding-left:100px;padding-right:100px;" onload="window.print()">'+newstr+'</html>' );
    popupWin.document.close(); 
    return false;
}

// SideNav Initialization
$(".button-collapse").sideNav();

new WOW().init();
