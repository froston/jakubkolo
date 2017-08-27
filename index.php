<?php defined('_JEXEC') or die('Restricted access');?>
<!DOCTYPE html>
<html xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <jdoc:include type="head" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta name="google-site-verification" content="L3uA8enHUQdTlJtRGzkTz5QPLp_-wl0Zgl863xgBpy8" />
        <link rel="shortcut icon" type="image/ico" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/favicon.ico"/>
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/bootstrap.min.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/font-awesome/css/font-awesome.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/font-awesome/css/font-awesome-animation.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/responsive.css" type="text/css" />
        <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/template.js"></script>
        <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
          ga('create', '', 'auto');
          ga('send', 'pageview');
        </script>
    </head>
    <body>
        <div id="contact" class="container-fluid">
            <p><i class="fa fa-phone"> +420 775 311 151</i>&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope"> <?php echo JHtml::_('email.cloak', 'jakubkolo@jakubkolo.cz', 0) ?></i></p>
        </div>
        <header id="header">
            <div class="container">
                <div class="row">
                    <?php if($this->countModules('search')) : ?>
                        <div id="search-form" class="col-sm-3">
                            <jdoc:include type="modules" name="search" />  
                        </div>
                    <?php endif; ?>
                    <div id="logo" class="col-sm-6">
                        <a class="logo" href="/index.php">
                          <img alt="Main Logo" src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/logo.png">
                        </a>
                    </div>
                    <?php if($this->countModules('cart')) : ?>
                        <div id="cart" class="col-sm-3">
                            <jdoc:include type="modules" name="login" />
                            <jdoc:include type="modules" name="cart" />
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <?php if($this->countModules('main-menu')) : ?>
                    <div id="main-nav" class="col-md-12">
                        <nav class="navbar navbar-default">
                            <div class="navbar-header">
                                <i id="search-icon" class="fa fa-search fa-2x"></i>
                                <a id="cart-icon" class="cart-count" href="<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart'); ?>"><i class="fa fa-shopping-bag fa-2x"></i></a>
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav-collapse" aria-expanded="false" aria-controls="main-nav-collapse">
                                    <span class="sr-only">Vysouvací menu</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div id="main-nav-collapse" class="navbar-collapse collapse">
                                <jdoc:include type="modules" name="main-menu" />  
                                <div class="clearfix"></div>
                            </div>
                        </nav>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </header>
        <div id="content">
            <div class="container">
                <?php if($this->countModules('breadcrumbs')) : ?>
                    <div id="breadcrumbs">
                        <jdoc:include type="modules" name="breadcrumbs" />  
                    </div>
                <?php endif; ?>
                <div id="message">
                    <jdoc:include type="message" />
                </div>
                <?php if($this->countModules('left-menu')) : ?>
                    <div id="left-menu" class="col-md-2 hidden-xs hidden-sm">
                        <h3>Obchod</h3>
                        <jdoc:include type="modules" name="left-menu" /> 
                        <div class="clearfix"></div>
                        <?php if($this->countModules('aviso')) : ?>
                            <div class="aviso">
                                <jdoc:include type="modules" name="aviso" /> 
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                        <div class="clearfix"></div>
                    </div>
                <?php endif; ?>
                <div id="component">
                    <?php if($this->countModules('slider')) : ?>
                        <div id="slider" class="col-md-10">
                            <jdoc:include type="modules" name="slider" />
                            <div class="clearfix"></div>
                        </div>
                    <?php endif; ?>
                    <jdoc:include type="component" />
                </div>
            </div>
        </div>
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div id="footer-panels" class="clearfix">
                        <div id="footer-menu" class="col-md-2">
                            <?php if($this->countModules('footer-menu')) : ?>
                                <h3>Hlavní menu</h3>
                                <div class="footer-menu">
                                    <jdoc:include type="modules" name="footer-menu" /> 
                                </div>
                            <?php endif; ?>
                        </div>   
                        <div id="footer-categories" class="col-md-2">
                            <?php if($this->countModules('footer-categories')) : ?>
                                <h3>Kategorie</h3>
                                <div class="footer-categories">
                                    <jdoc:include type="modules" name="footer-categories" /> 
                                </div>
                            <?php endif; ?>
                        </div>   
                        <div id="about-us" class="col-md-4">
                            <?php if($this->countModules('about-us')) : ?>
                                <h3>O nás</h3>
                                <div class="about-us">
                                    <jdoc:include type="modules" name="about-us" /> 
                                </div>
                            <?php endif; ?>
                        </div> 
                        <div id="newsletter" class="col-md-4">
                            <?php if($this->countModules('newsletter')) : ?>
                                <h3>Novinky</h3>
                                <div class="newsletter">
                                    <jdoc:include type="modules" name="newsletter" /> 
                                </div>
                            <?php if($this->countModules('social')) : ?>
                            <?php endif; ?>
                                <h3>Sociální sítě</h3>
                                <div id="social">
                                    <jdoc:include type="modules" name="social" /> 
                                    <div class="clearfix"></div>
                                </div>
                            <?php endif; ?>
                        </div>  
                    </div> 
                    <div id="copyright">
                        <?php if($this->countModules('copyright')) : ?>
                            <div class="copyright">
                                <jdoc:include type="modules" name="copyright" /> 
                            </div>
                        <?php endif; ?>
                    </div>   
                </div>                
            </div>
        </footer>
	<?php if($this->countModules('cookies')) : ?>
            <div class="cookies">
                <jdoc:include type="modules" name="cookies" /> 
            </div>
        <?php endif; ?>
    </body>
</html>