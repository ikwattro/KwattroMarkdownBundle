KwattroMarkdownBundle
====================

This bundle lets you easily make use of the markdown parser inside your Symfony applications.

Status
------

This bundle is in development phase. Do not hesitate to contribute.

#### Todo's:

* Merge the parameters with the DI config
* ~~ Add all possible extensions to DI config ~~
* Add flags feature
* Convert config files to .xml
* Make the Twig extension use of Markdown class
* Add some tests
* Request feedbacks

Open Source Community
---------------------

This bundle wraps the work of amazing developers:

`Sundown` is based on the original Upskirt parser by Natacha Porté, with many additions
by Vicent Marti (@tanoku) and contributions from the following authors:

	Ben Noordhuis, Bruno Michel, Joseph Koshy, Krzysztof Kowalczyk, Samuel Bronson,
	Shuhei Tanuma

`php-sundown` is a php wrapper of the `Sundown` project made by [chobie] (https://github.com/chobie/php-sundown)

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

How to use it
-------------

You can easily use the markdown parser in your Twig templates:

    {{ body | markdown | raw }}

Or in your controllers by using the ``kwattro_md`` alias:

    $markdown = $this->container->get('kwattro_md');
    $string = $body; //Some string to transform
    $output = $markdown->markdown($string);