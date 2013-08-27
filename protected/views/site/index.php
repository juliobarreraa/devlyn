<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
Yii::app()->getClientScript()->registerCss('no-content', <<<EOF
	#content { width:auto; }
EOF
);
?>
      <!-- Home Page -->
      <div id="home" class="page color-1">
        <div class="inner-page">
          <h2 class="page-headline large">Tell your projects awesome story.</h2>
        </div>  
        <div class="row-fluid inner-page">
          <div class="span8 pull-right lazy-container">
            <img class="lazy" alt="Looks great on every device" src="<?php echo Yii::app()->baseUrl ?>/images/pixel.png" data-original=" <?php echo Yii::app()->baseUrl ?>/images/home.png"/>
          </div>
          <div class="span4 pull-right">
            <ul class="big-list">
              <li><i class="icon-ok"></i> Flat design</li>
              <li><i class="icon-tablet"></i> Responsive</li>
              <li><i class="icon-cloud"></i> Fast page load</li>
              <li><i class="icon-cog"></i> Built with LESS</li>
            </ul>
            <br />
            <a href="index.html#features" title="Check out more freatures!" class="scroll btn btn-centered"><i class="icon-caret-down"></i> Learn more</a>
          </div>
        </div>
      </div>

      <!-- Sign up -->
      <div class="sign-up color-2 visible-desktop">
        <div class="row-fluid inner-page">
          <div class="span12">
            <h4 class="pull-left">They say visitors prefer scrolling rather than clicking. We combined both.</h4>
            <a href="index.html#features" class="scroll btn pull-right" title="Check out more freatures!"><i class="icon-caret-down"></i> Scroll down</a>
          </div>
        </div>
      </div>

      <!-- Features -->
      <div id="features" class="page color-4">
        <div class="inner-page">
          <h2 class="page-headline">Why should you choose The Story</h2>
        </div>

        <div class="inner-page row-fluid">
          <ul class="features list-inline">
            <li>
              <h3><i class="icon-cog"></i> Make it your own </h3>
              <p>Easily change every color, by changing just few variables. Add or remove pages, and choose from 600+ fonts.</p>
            </li>
            <li>
              <h3><i class="icon-heart"></i> Page speed</h3>
              <p> The theme is highly optimized to ensure fast loading time by lazy-loading of images and beeing minimal by design.</p>
            </li>
            <li>
              <h3><i class="icon-tablet"></i> For every device.</h3>
              <p><strong>The Story</strong> is built to look great on every device. Custom menu for mobile devices, to ensure the best expierence.</p>
            </li>
            </ul>
        </div>
                         
        <div class="row-fluid inner-page">
          <div class="span6 lazy-container">
            <img class="figurette lazy" src="<?php echo Yii::app()->baseUrl ?>/images/pixel.png" data-original=" <?php echo Yii::app()->baseUrl ?>/images/two-phones.png" alt="Zombie ipsum" />
          </div>
          <div class="span6">           
            <h3>All artwork included</h3>
            <p class="lead">Present your project properly. Create your own art from included templates</p>
            <ul class="list-wide">
              <li><i class="icon-check"></i> More than 300 awesome icons from <a href="http://fortawesome.github.io/Font-Awesome/" title="awesome font, awesome">Font-awesome</a></li>
              <li><i class="icon-check"></i> Browser icons</li>
              <li><i class="icon-check"></i> Phone, tablet, laptop, desktop vectors (SVG)</li>
              <li><i class="icon-check"></i> 5 Layered PSD files.</li>
            </ul>         
          </div>
        </div>

        <hr>

        <!-- Video -->
        <div class="row-fluid inner-page">
          <div class="span6 pull-right">
            <div class="btn-container figurette">
              <img src="<?php echo Yii::app()->baseUrl ?>/images/video.png" alt="Play video" />
               <a class="lightbox iframe btn-play" target="_blank" href="http://vimeo.com/61693087"><i class="icon-play"></i></a>
            </div>
          </div>
          <div class="span6 pull-right">
              <ul class="big-list">
                <li><i class="icon-ok"></i> Always latest bootstrap</li>
                <li><i class="icon-play"></i> Responsive video</li>
                <li><i class="icon-resize-full"></i> Adaptive, smart lightbox</li>
                <li><i class="icon-desktop"></i> All modern browsers supported</li>
              </ul>
            <br />
            <a href="index.html#download" class="scroll btn btn-centered"><i class="icon-plus"></i> Even more features</a>
          </div>
        </div>
      </div> <!-- /Features --> 


       <!-- Assets page -->
      <div id="assets" class="page color-3">
          <div class="inner-page">
            <h2 class="page-headline">Page assets</h2>
          </div>

        <!-- Vectors -->
        <div class="row-fluid inner-page">
          <div class="span6 lazy-container">
            <img class="figurette lazy" alt="Original vectors" src="<?php echo Yii::app()->baseUrl ?>/images/pixel.png" data-original="<?php echo Yii::app()->baseUrl ?>/images/responsive-vectors.png"  />
          </div>
          <div class="span6">
            <h3>5 vectors included</h3>
            <p class="lead">Zombie ipsum <abbr title="HyperText Markup Language" class="initialism">HTML</abbr> reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis.</p>
            <p> The voodoo sacerdos flesh eater, suscitat mortuos comedere carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro.. </p>
          </div>
        </div> <!-- /vectors -->

        <hr>

        <!-- Big laptop -->
        <div class="row-fluid inner-page">
          <div class="offset1 span10">
            <div class="lazy-container lazy-large btn-container loaded">
              <div class="btn-container">
                <img class="figurette lazy " src="<?php echo Yii::app()->baseUrl ?>/images/laptop-blue@2x.png" data-original="<?php echo Yii::app()->baseUrl ?>/images/laptop-blue@2x.png" alt="view image in lightbox" style="display: inline;">
                <a href="<?php echo Yii::app()->baseUrl ?>/images/superman.jpg" class="lightbox btn-play" target="_blank">
                  <i class="icon-zoom-in"></i></a>
              </div>
            </div>
          </div>
        </div>
        <!-- Clients -->
        <div class="clients color-1">
          <div class="inner-page">
              <h2 class="page-headline">Who's using stories.</h2>
          </div>
          <div class="inner-page row-fluid">
              <ul class="clients list-inline">
                <li><i class="icon-globe"></i> Earth</li>
                <li><i class="icon-heart"></i> Love</li>
                <li><i class="icon-leaf"></i> Leaves</li>
                <li><i class="icon-cloud"></i> Clouds</li>
              </ul>
          </div>
        </div>

      </div> <!-- /Assets page -->
      <!-- About page -->
      <div id="about" class="page color-4">
        <div class="inner-page">
          <h2 class="page-headline">Who are we and how it all got started. Our story.</h2>
        </div>
        <div class="row-fluid inner-page">
          <div class="span6  lazy-container">
              <img class="figurette lazy" src=" <?php echo Yii::app()->baseUrl ?>/images/pixel.png" data-original=" <?php echo Yii::app()->baseUrl ?>/images/green-office.png" alt="Our workspace" />
          </div>
          <div class="span6">
            <h3>Zonbi tattered for solum.</h3>
            <p class="lead">The voodoo sacerdos flesh eater, suscitat mortuos comedere carnem virus. Zonbi tattered for solum oculi eorum defunctis go lum cerebro.</p>
            <p>Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris. Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium.</p>
          </div>
        </div>

        <hr>

        <!-- Team -->
        <div class="row-fluid inner-page team">
          <div class="span6">
            <img class="pull-left" src=" <?php echo Yii::app()->baseUrl ?>/images/cookies2.png" alt="A cookie" />
            <h4>Jane Doe</h4>
            <p>Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis.</p>
            <ul>
              <li><i class="icon-home"></i> <a href="http://prettystrap.com/themes/the-story/preview/prettystrap.com">http://prettystrap.com</a></li>
              <li><i class="icon-envelope-alt"></i> <a href="http://prettystrap.com/themes/the-story/preview/info@email.com">info@email.com</a></li>
              <li class="social">
                <a href="index.html#about"><i class="icon-facebook-sign"></i></a>
                <a href="index.html#about"><i class="icon-twitter"></i></a>
                <a href="index.html#about"><i class="icon-github-sign"></i></a>
              </li>
            </ul>
          </div>
          <div class="span6 team2">
            <img class="pull-left" src=" <?php echo Yii::app()->baseUrl ?>/images/cookies.png" alt="A cookie" />
            <h4>John Doe</h4>
            <p>Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis.</p>
            <ul>
              <li><i class="icon-home"></i> <a href="http://prettystrap.com/themes/the-story/preview/prettystrap.com">http://prettystrap.com</a></li>
              <li><i class="icon-envelope-alt"></i> <a href="http://prettystrap.com/themes/the-story/preview/info@email.com">info@email.com</a></li>
              <li class="social">
                <a href="index.html#about"><i class="icon-facebook-sign"></i></a>
                <a href="index.html#about"><i class="icon-twitter"></i></a>
                <a href="index.html#about"><i class="icon-github-sign"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>


      <!-- Contact Us -->
      <div id="contact" class="page color-2">
        <div class="inner-page">
          <h2 class="page-headline">Get in touch and stay updated</h2>
        </div>
        <div class="row-fluid inner-page contact">
          <div class="span6">
            <h3>What's on your mind?</h3>
            <textarea rows="6" placeholder="Your story"></textarea>
            <input type="text" placeholder="your@e-mail.com"><br />
            <input type="text" placeholder="Name"><br />
            <button class="btn btn-centered">Contact us</button>
          </div>
          <div class="span6">
            <div class="btn-container centered lazy-container text-center">
              <img src=" <?php echo Yii::app()->baseUrl ?>/images/pixel.png" class="lazy figurette" alt="Open the map"   data-original=" <?php echo Yii::app()->baseUrl ?>/images/map.png"/>
              <a class="lightbox iframe  btn-map" target="blank" title="Open google maps" href="https://maps.google.com/maps?q=Stationsplein,+1012+Centrum,+Amsterdam,+Noord-Holland,+The+Netherlands&hl=en"><i class="pull-left icon-map-marker"></i><div>Stationsplein, 1012 AB,<br />Amsterdam,<br /> The Netherlands</div></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Newsletter -->
      <div class="newsletter color-1">
        <div class="inner-page row-fluid">
          <div class="span4">
            <h4><strong>Be cool</strong>, subscribe to get our latest news</h4>
          </div>
          <div class="span6">
            <input type="email" placeholder="your@e-mail.com" name="EMAIL" class="subscribe">
          </div>
          <div class="span2">
            <button type="submit"  class="btn pull-right subscribe">Subscribe</button>
          </div>
        </div>
      </div>