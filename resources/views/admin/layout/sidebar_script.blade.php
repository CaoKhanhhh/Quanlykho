<script>
    $(".document").ready(function (){
        var loc =window.location.href;
        $('.nav-link').each(function() {
            $(this).toggleClass('active', $(this).attr('href') == loc);
        });
    })

</script>
