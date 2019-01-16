$(document).ready(function(){
	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		return false;
	});
});

    function add2Fav (x){
        if (document.all  && !window.opera) {
             if (typeof window.external == "object") {
                window.external.AddFavorite (document.location, document.title);
                return true;
              }
              else return false;

        }
        else{
            x.href=document.location;
            x.title=document.title;
            x.rel = "sidebar";
            return true;
        }
    }