 
<p>
  <img src="https://github.com/inspetor/slate/blob/master/source/images/logo-color.png" width="200" height="40" alt="Inspetor Logo"> </img> 
</p>

# Inspetor Antifraud
Antrifraud Inspetor library for PHP. 

## Description
This READ ME file is special! It should help you, my dear developer, on your "*publishing library road*". Let's chat about library development and publishing new versions 'cause the war against fraud never ends.

## Setup Guide
This is a step-by-step Inspetor publication guide:

### Development
Ok, so you decided to make changes in this beautiful library. No worries, I appreciate that.
Well, you should clone this repo:
```
git clone https://github.com/inspetor/inspetor-php.git
```
And when it's done, you can start to code. Every useful information to the development of this library can be found [here](https://github.com/inspetor/inspetor-php/blob/master/README.md), general information about Inspetor [here](https://inspetor.github.io/slate/) and [here](https://github.io/inspetor/libraries) are some libraries definitions (swagger).

### TEST YOUR STUFF!
After finishing your code, it's simple to test:
Locally: 
```
./vendor/bin/phpunit
```
Integration tests: 
```
./vendor/bin/phpunit --configuration integration-test.xml 
```

### Publishing
Are you done? Nice! It's time to publish. If you had finished a new brilliant version, you must create a **release** to that version. We did some magic and only realeases will be published into *Packagist* repository and available to new clients. 
P.S.: Packagist is the main repository of PHP packages. 

#### Realeases
The way to keep all active versions alive is creating a new release branch to push this new version.
```
git checkout -b release/[new version] (e.g release/1.2.3-beta)
```
Push your new version there and if everything goes right come back here and publish a new release tagging the branch you just created. You can see how to publish a new release [here](https://help.github.com/en/articles/creating-releases#automatically-creating-releases).

After a couple minutes, your version should be available to be installed by composer. You can verify if it's already available in our [page](https://packagist.org/packages/inspetor/inspetor-php) in Packagist website. 
```
composer require inspetor/inspetor-php:[version] (e.g composer require inspetor/inspetor-php:1.2.3-beta)
```

### Conclusion
Easy, huh? I hope this small guide has been helpful to anyone who wants to improve our library. Nice job!

And never forget that **STEALING IS BULLSHIT**. 

*DPCL (dope cool)*
