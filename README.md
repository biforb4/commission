<p align="center">
  <img src="https://raw.githubusercontent.com/PKief/vscode-material-icon-theme/ec559a9f6bfd399b82bb44393651661b08aaf7ba/icons/folder-markdown-open.svg" width="100" />
</p>
<p align="center">
    <h1 align="center">Commision calculator</h1>
</p>
<p align="center">
	<img src="https://img.shields.io/github/last-commit/biforb4/commission?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
	<img src="https://img.shields.io/github/languages/top/biforb4/commission?style=flat&color=0080ff" alt="repo-top-language">
	<img src="https://img.shields.io/github/languages/count/biforb4/commission?style=flat&color=0080ff" alt="repo-language-count">
<p>
<p align="center">
		<em>Developed with the software and tools below.</em>
</p>
<p align="center">
	<img src="https://img.shields.io/badge/YAML-CB171E.svg?style=flat&logo=YAML&logoColor=white" alt="YAML">
	<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">
	<img src="https://img.shields.io/badge/JSON-000000.svg?style=flat&logo=JSON&logoColor=white" alt="JSON">
</p>
<hr>

##  Quick Links

> - [ Overview](#-overview)
> - [ Features](#-features)
> - [ Getting Started](#-getting-started)
    >   - [ Installation](#-installation)
>   - [Running commission](#-running-commission)
>   - [ Tests and Code Quality](#-tests-and-code-quality)
---

##  Overview

The **commission** project focuses on calculating commissions for financial transactions, enhancing the processing of operations within its architecture. Central to the repository is the **`CalculateCommissionCommand.php`** file, which orchestrates commission calculation strategies with modularity and clear logic. Leveraging Symfony's capabilities, the core functionalities involve processing transactions from a input file, converting currencies to EUR for consistency, and utilizing different calculation strategies based on transaction details, such as EU/non-EU country distinctions. By centralizing commission calculation logic and integrating services like CommissionCalculatorInterface and ExchangeRateProvider, **commission** offers a streamlined approach to managing transaction commissions, ultimately optimizing financial operations within its ecosystem.

---

##  Features

|    |   Feature         | Description |
|----|-------------------|---------------------------------------------------------------|
| ⚙️  | **Architecture**  | The project follows a modular architecture using Symfony components for efficient bootstrapping and core functionalities, enhancing reusability and maintainability within the commission calculation service. |
| 🔩 | **Code Quality**  | The codebase demonstrates good code quality and style, with clear indentation, meaningful variable names, and adherence to Symfony coding standards, enhancing readability and ease of maintenance. |
| 🔌 | **Integrations**  | Key integrations include Handy API for fetching country codes, Symfony HttpClient for API communication, and ExchangeRatesApi for fetching exchange rates, enhancing the functionality of commission calculation. |
| 🧩 | **Modularity**    | The codebase exhibits high modularity with clear separation of concerns, implementing interfaces and design patterns like Strategy Factory for flexibility, making it easy to extend and reuse components. |
| 🧪 | **Testing**       | The project uses PHPUnit for testing, ensuring code quality through unit and integration tests, validating the functionality of commission calculation and integration with external services. |
| 📦 | **Dependencies**  | Key dependencies include Symfony components, PHP libraries, and external APIs like Handy API and ExchangeRatesApi, crucial for commission calculation and currency exchange functionality. |


---

##  Getting Started

***Requirements***

Ensure you have the following dependencies installed on your system:

* **PHP**: `version 8.2`

###  Installation

1. Clone the commission repository:

```sh
git clone https://github.com/biforb4/commission
```

2. Change to the project directory:

```sh
cd commission
```

3. Install the dependencies:

```sh
composer install
```

###  Running `commission`

Use the following command to run commission:

```sh
bin/console app:calculate-commission <path to file>
```

Example input file:
```json
{"bin":"45717360","amount":"100.00","currency":"EUR"}
{"bin":"516793","amount":"50.00","currency":"USD"}
```
###  Tests and Code Quality

Use the following command to run tests and code quality tools:

```sh
vendor/bin/phpunit
vendor/bin/php-cs-fixer fix
vendor/bin/psalm
```

---

[**Return**](#-quick-links)

---
