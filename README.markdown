KwattroMarkdownBundle
====================

This bundle lets you easily make use of the markdown parser inside your Symfony applications.

See it in action: http://www.frenchycode.com/billets/3/voir/test_du_kwattromarkdownbundle
Status
------

This bundle is in development phase. Do not hesitate to contribute.

[![Build Status](https://secure.travis-ci.org/kwattro/KwattroMarkdownBundle.png?branch=master)](http://travis-ci.org/kwattro/KwattroMarkdownBundle)

#### Todo's:

* ~~Merge the parameters with the DI config~~
* ~~Add all possible extensions to DI config~~
* Add flags feature
* Convert config files to .xml
* ~~Make the Twig extension use of Markdown class~~
* Add some tests
* Structured docs
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
	extension=sundown.so

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

#### In your twig templates

You can easily use the markdown parser in your Twig templates:

    {{ body | markdown }}

#### In your controllers by using the ``kwattro_markdown`` service name:

    $markdown = $this->container->get('kwattro_markdown');
    $string = $body; //Some string to transform
    $output = $markdown->render($string);

#### You can custom the extensions and the render to use on the fly

##### In your controllers :
````
$md = $this->container->get('kwattro_markdown');
$string = $body; // some string to transform
$output = $md->render($string, array('autolink' => false), 'xhtml')
````

##### In your templates
````
{{ body | markdown( {'autolink': false}, 'html') }}
````

Syntax
------

For more information about the ``Markdown syntax``, visit the markdown author [website] (http://daringfireball.net/projects/markdown/)

Configuration Reference
-----------------------

You can configure the bundle simply in the config.yml file:

````
kwattro_markdown:
    twig_extension: ~ // default is the twig extension provided by the bundle
    renderer : ~ // default `html` You can choose between html | xhtml | base | custom
    render_class: ~ based off the renderer chosen, you have to specify one if "custom" is chosen
    extensions:
        no_intra_emphasis: false
        tables: true
        fenced_code_blocks: true
        autolink: true
        strikethrough: true
        lax_html_blocks: false
        space_after_headers: true
        superscript: false
````
