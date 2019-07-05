 
<p>
  <img src="https://github.com/inspetor/slate/blob/master/source/images/logo-color.png" width="200" height="40" alt="Inspetor Logo"> </img> 
</p>

# Inspetor Antifraud
Antrifraud Inspetor library for PHP. 

## Description
This READ ME file is special! It should help you, my dear developer, on your "*publishing library road*". Let's chat about library development and publishing new versions 'cause the war against fraud never ends.

## Setup Guide
This is the step-by-step Inspetor publication:

### Development
Ok, so you decided to make changes in this beautiful library. No worries, I appreciate that.
Well, you should clone this repo:
```
git clone https://github.com/inspetor/inspetor-php.git
```
And it's done, you can start to code. Every useful information to the development of this library could be found [here](https://github.com/inspetor/inspetor-php/blob/master/README.md) and general information about Inspetor [here](https://inspetor.github.io/slate/). 

### Publishing
Are you done? Noice! It's time to publish. If you had finished a new brilliant version, you must create an **release** to that version. We did some magic and only realeases will be published into *Packagist* repository and available to new clients. 
P.S.: Packagist is the main repository of available PHP packages. 

#### Realeases
The way to keep all active versions alive is creating a new release branch to push this new version.
```
git checkout -b release/[new version] (e.g release/1.2.3-beta)
```
Push your new version there and if everything goes right, go back to here and publish a new release tagging the branch you just create. See how to publish a new release [here](https://help.github.com/en/articles/creating-releases#automatically-creating-releases).

After a couple minutes, your version should be available to be installed by composer. You can verify if it's already available in our [page] into Packagist(https://packagist.org/packages/inspetor/inspetor-php). 
```
composer require inspetor/inspetor-php:[version] (e.g composer require inspetor/inspetor-php:1.2.3-beta)
```

### Conclusion
Easy, huh? I hope this small guide has been helpful to anyone who wants to improve our library. Nice job! 

And never forget that **STEALING IS BULLSHIT**. 
