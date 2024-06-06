
<?php echo Assets::js(); ?>
<script>
    $(function(){
        'use strict'

        // Toggle Switches
        $('.az-toggle').on('click', function(){
            $(this).toggleClass('on');
        })

        // Input Masks
        $('#dateMask').mask('99/99/9999');
        $('#phoneMask').mask('9999-999999');
        $('#ssnMask').mask('999-99-9999');

        $(document).ready(function(){
            $('.select2').select2({
                placeholder: 'Choose one'
            });

            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose one'
            });
        });

        $('#selectForm').parsley();
        $('#selectForm2').parsley();

    });
</script>
</body>
</html>