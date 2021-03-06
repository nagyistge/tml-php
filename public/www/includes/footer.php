
    <hr>

    <style>
        #navlist li {
            display: inline;
            list-style-type: none;
            padding-right: 10px;
        }
    </style>

    <?php tml_begin_block_with_options(array("source" => "footer")) ?>
        <footer>
            <div class="container">
                <ul id="navlist" style="float:right;">
                    <li><a href="http://welcome.translationexchange.com/docs" class="quiet"><?php tre("Documentation") ?></a></li>

                    <li><a href="http://github.com/translationexchange" class="quiet"><?php tre("GitHub") ?></a></li>

                    <li><a href="https://www.facebook.com/translationexchange" class="quiet"><?php tre("Facebook") ?></a></li>
                    <li><a href="http://twitter.com/translationx" class="quiet"><?php tre("Twitter") ?></a></li>

                    <!-- li><a href="/extensions" class="quiet"><span class='tml_translatable tml_not_translated' data-translation_key_id='22'>Extensions</span></a></li -->
                </ul>

                &copy; 2015 <a href="http://welcome.translationexchange.com" class="quiet">Translation Exchange, Inc</a>
            </div>
        </footer>
    <?php tml_finish_block_with_options() ?>

</div>

<?php include('foot.php'); ?>