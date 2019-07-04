 
<p>
  <img src="https://github.com/inspetor/slate/blob/master/source/images/logo-color.png" width="200" height="40" alt="Inspetor Logo"> </img> 
</p>

# Inspetor Antifraud
Antrifraud Inspetor library for PHP. 

## Description
Inspetor is an product developed to help your company to avoid fraudulent transactions. This READ ME file should help you to integrate the Inspetor PHP library into your product with a couple steps. 

## Setup Guide
This is the step-by-step Inspetor integration:

### Composer & Packagist
Composer is an application-level package manager for the PHP programming language that provides a standard format for managing dependencies of PHP software and required libraries. It runs from the command line and installs dependencies (e.g. libraries) for an application. You can see Composer documentation [here](https://getcomposer.org/doc/00-intro.md). 

Packagist is the main repository of available PHP packages. It also provides autoload capabilities for libraries that specify autoload information to ease usage of third-party code. The Inspetor package is there as you can see [here](https://packagist.org/packages/inspetor/inspetor-php).

We use the Composer commands to install the Inspetor PHP library hosted into Packagist as below:

``` composer require inspetor/inspetor-php:[version] (e.g. composer require inspetor/inspetor-php:1.2.1) ```

If you're a lucky person and get no errors, the library should be listed in your composer.json 'require' and the library files should be inside your vendor folder. 

### Library setup 
Now you're almost able to call our beautiful library inside your code. But, first, you need to set some **configuration**. To Inspetor avoid your fraud, you only need to provide us **two things**: *"appId"* and *"trackerName"* like that:
```
'inspetor_config' => [
  'trackerName' => cool.name (e.g. company.api),
  'appId'       => unique.number (e.g. 30cdfed3-9f7f-4aaa-b9f1-033c4dbfef58)
]
```

The *"appId"* is an unique identifier that the awesome Inspetor Team will provide you when you start to pay us. The *"trackerName"* is a name that will help us to find your data in our database and we'll provide you a couple of them. Okay, if you did everything right until now, you're really able to call our functions and to begin your fight against fraudulent transactions with us.

We'll gonna code for real now, so we **strongly** recommend you to create an Inspetor class in your code to start our library. There's where you gonna insert Inspetor config you wrote some lines above and retrieve our client. Confusing? Relax, we're kind enough to show you how to do it.

```
namespace NiceCompany\Inspetor;

use Inspetor\InspetorClient;

class InspetorClass 
{
  ...
    /**
     * Let's instantiate this awesome library! 
     */
    public function __construct()
    {
        $this->inspetor = new InspetorClient($inspetor_config);
    }

    /**
     * @return Inspetor\InspetorClient $client
     */
    public function getClient() {
        return $this->inspetor;
    }
  ...
}
```

Now, wherever you need to call some Inspetor function, you just need to import this Class and _voilà_. 

*P.S.: you can place your config wherever you think is better, just before instantiate InspetorClient or into a config file that you include in this class. It's up to you, but we provided you some tips in Best Practices & Tips section.*

### Library Calls 

I'm supposing you did an amazing job until this moment, so let's move on. It's time to make some calls and track some data. Nice, huh? Here we go. 

If you've already read the [general Inspetor files](), you should be aware of all of Inspetor requests and trackers, so our intention here is just to show you how to use the PHP version of some of them. 

Let's imagine that you want to put a tracker in your *"create transaction"* flow to send some data that the best Antifraud team should analyze and tell you if it's a fraud or not. So, it's intuitive that you need to call the *inspetorSaleCreation* and pass the data of that sale, right? 

Yeah, but we must ask you a little favor. Considering the fraud context, it's possible that not all of your transaction data 
help us to indenfity fraud, so we created a **Model** for each instance we use (remember what is a Model [here]()) that you must build and fill with it's needed. Let's see a snippet.

```
namespace NiceCompany\SaleFolder;

use NiceCompany\Inspetor\InspetorClass;

class Sale {
  ...
  
  public function someCompanyFunction() {
      // $company_sale is an example object of the company with sale data
      $inspetor_sale = $this->inspetorSaleBuilder($company_sale);

      $this->inspetor = new InspetorClass();

      if($inspetor_sale) {
          $inspetor->getClient()->trackSaleCreation($inspetor_sale);
      } 
  }
 
  public function inspetorSaleBuilder($company_sale) {
      $model = $this->inspetor->getClient()->getInspetorSale();
      
      $model->setId($company_sale->getId());
      $model->setAccountId($company_sale->getUserId());
      $model->setStatus($company_sale->getSaleStatus());
      $model->setIsFraud($company_sale->getFraud());
      $model->set...
      
      return $model;
  }
  ...
}
```

Following this code and assuming you've builded your model with all required parametes (find out each Model's required parameters [here]()), we *someCompanyFunction* run, the Inspetor code inside will send a great object with all we need to know about that sale. Easy? 

We're using an auxiliar function *inspetorSaleBuilder* to build the *Sale Model* but you don't have to do it, or place it where we do here neither. You could set this *inspetorSaleBuilder* inside your *InspetorClass* that we talked about some lines above, for example. More tips in the next section. 

### What you should notice
Not all of the Model's attributes are required but we trully recommend you work around to pass them all. On the other hand, some of them are **super important** and you should pass it correctly. Let's talk about some of them.
 - ***is_fraud***: is an Sale Model attribute that you **must** pass to indicate that a sale is fraudulent or not even if it's something that we're providing to you (as part of postback process).
 - ***sessions***: is an Event Model and 

### Best Practices & Tips
