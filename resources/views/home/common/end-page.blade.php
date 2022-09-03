<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript" src="js/slick.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script>
    window.addEventListener('scroll',reveal);

    function reveal(){
        var reveal = document.querySelectorAll('.reveal');

        for(var i=0; i< reveal.length; i++){
            var windowheight = window.innerHeight;
            var revealtop = reveal[i].getBoundingClientRect().top;
            var revealpoint =150;

            if(revealtop< windowheight - revealpoint){
                reveal[i].classList.add('active');
            }
            else{
                reveal[i].classList.remove('active');
            }
        }
    }
</script>
</body>

</html>
