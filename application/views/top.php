<body>
<div class="row">
            <div class="col-lg-3">
                <a href="/"><h1 class="text-center"><img src="media/images/BCC_LOGO.jpg" class="logo"></h1></a>
            </div>
            <div class="col-lg-9">
                
                <h1 class="text-center text-primary">Вы зашли как 
                    <?php echo Cookie::get('user'); ?>
                </h1>
            </div>
        </div>


        
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="/media/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/media/js/bootstrap.js"></script>

<!— Start: Кнопки вверх вниз —>
<script type="text/javascript">
jQuery(function(){
if ($(window).scrollTop()>="250") $("#ToTop").fadeIn("slow")
$(window).scroll(function(){
if ($(window).scrollTop()<="250") $("#ToTop").fadeOut("slow")
else $("#ToTop").fadeIn("slow")
});
if ($(window).scrollTop()<=$(document).height()-"999") $("#OnBottom").fadeIn("slow")
$(window).scroll(function(){
if ($(window).scrollTop()>=$(document).height()-"999") $("#OnBottom").fadeOut("slow")
else $("#OnBottom").fadeIn("slow")
});
$("#ToTop").click(function(){$("html,body").animate({scrollTop:0},"slow")})
$("#OnBottom").click(function(){$("html,body").animate({scrollTop:$(document).height()},"slow")})
});
</script>
<div class="go-up" title="Вверх" id='ToTop'>?</div>
<div class="go-down" title="Вниз" id='OnBottom'>?</div>
<!— End: Кнопки вверх вниз —>
<script src="/media/js/scroll-startstop.events.jquery.js" type="text/javascript"></script>


</body>