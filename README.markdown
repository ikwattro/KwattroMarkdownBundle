KwattroMarkdownBundle
====================

This is a wrapper of the [php-sundown] (https://github.com/chobie/php-sundown) project.

Installation
-------------

### Install sundown and php-sundown on your server

	git clone https://github.com/chobie/php-sundown.git php-sundown -b development
	cd php-sundown
	# this command will fetch submodule and copy neccesary files to src dir and compile it.
	rake submodule compile
	sudo rake install
	
	# enable the sundown extension by adding the following line to your php.ini
	# extension=sundown.so

### Download the KwattroMarkdownBundle

Add the following to your deps file:

    [KwattroMarkdownBundle]
        git=http://github.com/kwattro/KwattroMarkdownBundle.git
        target=/bundles/Kwattro/MarkdownBundle

And run the following command:

    php bin/vendors install

### Register the bundle

Add the ``Kwattro`` namespace to the autoloader:

    # /app/autoload.php
    $loader->registerNamespaces(array(
    //...
    'Kwattro' => __DIR__.'/../vendor/bundles',
    ));

And finally, register the bundle in your AppKernel

    # /app/AppKernel.php
    public function registerBundles()
    {
        $bundles = array(
        //...
        new Kwattro\MarkdownBundle\KwattroMarkdownBundle(),
        );
    }

