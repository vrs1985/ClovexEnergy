$(document).ready(function () {
   var windowHeight = document.documentElement.clientHeight,
        windowAllWidth = window.innerWidth,
        windowWidth = document.documentElement.clientWidth;
        

        /*  CHANGE HEADER FOR SCROLL    */
        $(document).scroll(function () {
            var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
             console.log('alert: ',  scrollTop);
             if(scrollTop > 870){
                $('.header').removeClass('header-white').addClass('header-purple');
                $('#logo').attr('src', 'img/icon-clovex256.png');
             }else{
                $('.header').removeClass('header-purple').addClass('header-white');
                $('#logo').attr('src', 'img/Clovex-2.png');
             };
        });
    
/*          SMOOTHSCROLL                 */
$('#ddown').smoothScroll();
 /*          END SMOOTHSCROLL                 */     

});