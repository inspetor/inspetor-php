
<p>
  <img src="https://github.com/inspetor/slate/blob/master/source/images/logo-color.png" width="200" height="40" alt="Inspetor Logo"> </img>
</p>

## Description
Inspetor is a product developed to help your company to avoid fraudulent transactions. This repository contains the PHP SDK for you to integrate into your company's PHP services, which will allow Inspetor to analyze user patterns and prevent fraudulent transactions. This README file, along with our [generalized integration documentation](https://inspetor.github.io/docs-backend) are here to help you to integrate the Inspetor PHP library into your product with few easy steps.

## Setup Guide
This is the step-by-step Inspetor integration:

### Composer & Packagist
We recommend using [Composer](https://getcomposer.org/doc/00-intro.md) to add the Inspetor SDK to your PHP project's dependencies. The Inspetor SDK is available on [Packagist](https://packagist.org/packages/inspetor/inspetor-php), or directly on [GitHub](https://github.com/inspetor/inspetor-php).

You can add the Inspetor SDK to your Composer-managed PHP project as follows:

```composer require inspetor/inspetor-php:${VERSION}```

Following this command, the Inspetor SDK should be listed in your composer.json 'require' block and the package source files should be present in your vendor folder.

### SDK setup
To instantiate the Inspetor client object within your project, you'll need to perform some minimal configuration. We suggest adding a similar block to your application configuration:
```
'inspetor_config' => [
  'trackerName' => company.service_name // provided by Inspetor
  'appId'       => unique.number // provided by Inspetor
  'devEnv'      => false // whether or not the data sent from this tracker should be considered production or not.
]
```

We suggest creating an `Inspetor` class in which to instantiate you `InspetorClient`, then provide the instantiated client object to your various internal clients. This will ensure that your `InspetorClient` object has been properly configured prior to being called:

```
<?php

namespace NiceCompany\Inspetor;

use Inspetor\InspetorClient;

class Inspetor
{
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
}
?>
```

### Using the Inspetor client

Detailed method information and language-specific examples are all available in the [Inspetor integration documentation](https://inspetor.github.io/docs-backend). There you will find definitions, examples, and references for fundamental Inspetor entities. But just to get you started, we'll provide a practical example for interacting with our SDK below.

Let's imagine that you want to put a tracker in your *"create transaction"* flow to send analytic information to Inspetor at sale creation time. As you may have guessed (if you've read the docs), you'll be calling the `inspetorSaleCreation` method.

Naturally, the `inspetorSaleCreation` method requires certain characteristics of the sale creation to be send to Inspetor for analysis. Those attributes are captured in a **model** (specifically, the [InspetorSale](https://inspetor.github.io/docs-backend/#inspetorsale) model). You can find more general information on Inspetor's concept of **models** [here](https://inspetor.github.io/docs-backend/#models).

Here's an example of how you would integrate this into your code base:

```
<?php

namespace NiceCompany\SaleFolder;

use NiceCompany\Inspetor\InspetorClass;

class Sale {
  ...

  public function createSale() {
      // $company_sale is an example object of the company with sale data
      $inspetor_sale = $this->inspetorSaleBuilder($company_sale);

      $this->inspetor = new Inspetor();

      $inspetor->getClient()->trackSaleCreation($inspetor_sale);
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

?>
```
Note that we are using an auxiliar function *inspetorSaleBuilder* to build the *Sale Model*. This is not strictly necessary, but we imagine you will find such a practice preferable.

## Support

Feel free to reach out to the [Inspetor team](support@useinspetor.com) if you encounter any problems during your integration.