<!-- BEGIN content -->
<?php \core\base\Decorator::begin('/layouts/main') ?>
<div id="content">
    <?= $content; ?>
    <!-- end recent posts -->
</div>
<!-- END content -->
<!-- BEGIN sidebar -->
<div id="sidebar">
    <!-- begin popular posts -->
    <div class="box">
        <h2>Popular Posts</h2>
        <ul class="popular">
            <li><a href="http://all-free-download.com/free-website-templates/">Top 10 Ways to Make Money Online</a>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse interdum..</p>
            </li>
            <li><a href="http://all-free-download.com/free-website-templates/">Top 10 Ways to Make Money Online</a>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse interdum..</p>
            </li>
            <li><a href="http://all-free-download.com/free-website-templates/">Top 10 Ways to Make Money Online</a>

                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Suspendisse interdum..</p>
            </li>
        </ul>
    </div>
    <!-- end popular posts -->
    <!-- begin tag cloud -->
    <div class="box">
        <h2>Tag Cloud</h2>

        <div class="tags"><a href="http://all-free-download.com/free-website-templates/">Link</a></div>
    </div>
    <!-- end tag cloud -->
    <!-- BEGIN left -->
    <div class="l">
        <!-- begin categories -->
        <div class="box">
            <h2>Categories</h2>
            <ul>
                <li><a href="http://all-free-download.com/free-website-templates/">Advertising</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">Fashion</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">Gadgets</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">Lifestyle</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">Networking</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">News</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">Sports</a></li>
            </ul>
        </div>
        <!-- end categories -->
    </div>
    <!-- END left -->
    <!-- BEGIN right -->
    <div class="r">
        <!-- begin archives -->
        <div class="box">
            <h2>Archives</h2>
            <ul>
                <li><a href="http://all-free-download.com/free-website-templates/">June 2009</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">May 2009</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">April 2009</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">March 2009</a></li>
                <li><a href="http://all-free-download.com/free-website-templates/">February 2009</a></li>
            </ul>
        </div>
        <!-- end archives -->
    </div>
    <!-- END right -->
</div>
<!-- END sidebar -->

<?php \core\base\Decorator::end() ?>