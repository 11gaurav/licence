<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <title>e-License</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- App favicon -->
        <!--<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.jpg">-->

        <?php echo $template_css; ?>
             <script type="text/javascript" charset="UTF-8" src=<?php echo base_url(); ?>assets/js/vendor.min.js?1554960401"></script>
<!--           <script type="text/javascript" charset="UTF-8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script type="text/javascript" charset="UTF-8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        -->
        <?php echo $template_js; ?>
        <script type="text/javascript">
            base_url = '<?php echo base_url() ?>';

            $(document).ready(function () {
                $('form').attr('autocomplete', 'off');
                
                // Topbar - main menu
                $('.navbar-toggle').on('click', function (event) {
                    $(this).toggleClass('open');
                    $('#navigation').slideToggle(400);
                });

                $('.navigation-menu>li').slice(-2).addClass('last-elements');

                $('.navigation-menu li.has-submenu a[href="#"]').on('click', function (e) {
                    if ($(window).width() < 992) {
                        e.preventDefault();
                        $(this).parent('li').toggleClass('open').find('.submenu:first').toggleClass('open');
                    }
                });
            });
        </script>
    </head>
    <body>
        <?php echo $template_header; ?>
        <div class="wrapper">
            <div class="container-fluid">
                <?php echo $template_content; ?>

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->
        <?php echo $template_footer; ?>  
    </body>
</html>