# AUTENTIQUE API v2

[![Latest Stable Version](https://img.shields.io/packagist/v/vinicinbgs/autentique-v2)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![Total Downloads](https://poser.pugx.org/vinicinbgs/autentique-v2/downloads)](https://packagist.org/packages/vinicinbgs/autentique-v2)
[![codecov](https://codecov.io/gh/vinicinbgs/autentique-v2/branch/master/graph/badge.svg)](https://codecov.io/gh/vinicinbgs/autentique-v2)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/vinicinbgs/autentique-v2/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License](https://poser.pugx.org/vinicinbgs/autentique-v2/license)](https://packagist.org/packages/vinicinbgs/autentique-v2)

# Getting Started

[:orange_book: Documentation](https://beadev.net/autentique-v2)

Install and check documentation at [beadev.net/autentique-v2](https://beadev.net/autentique-v2).

```bash
composer require vinicinbgs/autentique-v2
```

# Compatibility
- PHP 7.3+
- [Autentique API v2 (graphql)](https://docs.autentique.com.br/api/)

# Tests
The tests are _**integrated directly with Autentique API**_, so you need to set your `.env` file based on `.env.example` Make sure you have set the `AUTENTIQUE_TOKEN`, `AUTENTIQUE_URL` and `AUTENTIQUE_DEV_MODE` to `true` for `SANDBOX MODE` or `false` to `PRODUCTION MODE`.

```bash
composer test
composer test -- --filter ApiTest
```

