<div class="style-main-wrapper">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>


    <form action="<?php menu_page_url( 'rdv_options_page_html' ) ?>" method="post">
        <hr>
        <div class="test">TEST</div>
        <div>
            <input type="checkbox" id="delete-all" name="delete-all">
            <label for="date">Tout sélectionner</label>
        </div>
